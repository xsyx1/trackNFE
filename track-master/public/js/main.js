function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}

(function ($) {
    $.fn.select2.defaults.set("theme", "bootstrap");
    $.fn.select2.defaults.set("language", "pt-BR");

    ("use strict");

    let url = window.location;

    activeMenu(url);

    $body = $("body");
    var $sidebar = $(".sidebar");

    $sidebar.on("show.bs.collapse", ".collapse", function () {
        if (!$(this).hasClass("show")) {
            var $li = $(this).parent();
            var $openNav = $li.siblings().find(".collapse.show");
            $openNav.collapse("hide");
        }
    });

    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        },
    });

    $("input[required], select[required], textarea[required]")
        .siblings("label")
        .addClass("required");

    $(".cep").mask("00000-000");

    $(".cpf").mask("000.000.000-00", {
        reverse: true,
    });
    $(".cnpj").mask("00.000.000/0000-00", {
        reverse: true,
    });

    $(".money").maskMoney({ thousands: ".", decimal: ",", allowZero: true });
    $(".money").attr("maxlength", "14");

    $(".quantity").mask("0000,00", {
        reverse: true,
    });

    $("form").on("submit", function () {
        $(this).find(":submit").prop("disabled", true);
    });

    var cpfMascara = function (val) {
            return val.replace(/\D/g, "").length > 11
                ? "00.000.000/0000-00"
                : "000.000.000-009";
        },
        cpfOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(cpfMascara.apply({}, arguments), options);
            },
        };

    $(".cpf_cnpj").mask(cpfMascara, cpfOptions);

    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, "").length === 11
                ? "(00) 00000-0000"
                : "(00) 0000-00009";
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            },
        };

    $(".phone").mask(SPMaskBehavior, spOptions);

    $("#image").on("change", function () {
        var imgPath = $(this)[0].value;
        var ext = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
            window.utilities.readUrl(this);
        else
            alert("Por favor, selecione o arquivo de imagem (jpg, jpeg, png).");
    });

    $(".select2").select2({
        language: "pt-BR",
        width: "100%",
    });

    $("#inp-city_id").select2({
        minimumInputLength: 3,
        language: "pt-BR",
        placeholder: "Selecione a Cidade",
        width: "100%",
        ajax: {
            cache: true,
            url: getUrl() + "/api/v1/cities",
            dataType: "json",
            data: function (params) {
                var query = {
                    search: params.term,
                };
                return query;
            },
            processResults: function (response) {
                var results = [];

                $.each(response.data, function (i, v) {
                    var o = {};
                    o.id = v.id;
                    o.text = v.title + " - " + v.letter;
                    o.value = v.id;
                    results.push(o);
                });
                return {
                    results: results,
                };
            },
        },
    });

    $("#inp-nif").on("change", function () {
        var nif = $(this).val();

        $.get(getUrl() + "/api/v1/get-person-by-nif?nif=" + nif).done(function (
            response
        ) {
            var person = response.data;

            if (person) {
                $("input")
                    .not($(this))
                    .each(function () {
                        if (person[$(this).attr("name")])
                            $(this).val(person[$(this).attr("name")]);
                    });

                $("#inp-city_id").append(
                    new Option(
                        person.city.title + "- " + person.city.state,
                        person.city_id
                    )
                );
                $("#inp-city_id").val(person.city_id);
            }
        });
    });

    $(".btn-delete").on("click", function (e) {
        var form = $(this).parents("form").attr("id");
        swal({
            title: "Você está certo?",
            text: "Uma vez deletado, você não poderá recuperar esse item novamente!",
            icon: "warning",
            buttons: true,
            buttons: ["Cancelar", "Excluir"],
            dangerMode: true,
        }).then((isConfirm) => {
            if (isConfirm) {
                document.getElementById(form).submit();
            }
        });
    });

    $(".btn-add").on("click", function () {
        $("tbody select.select2").select2("destroy");
        var $table = $(this).closest(".row").prev().find(".table-dynamic");
        var $tr = $table.find(".dynamic-form").first();
        var $clone = $tr.clone();
        $clone.show();
        $clone.find("input,select").not(".ignore").val("");
        $table.append($clone);
        setTimeout(function () {
            $("tbody select.select2").select2({
                language: "pt-BR",
                width: "100%",
            });
        }, 100);
    });

    $(".multi-select").bootstrapDualListbox({
        nonSelectedListLabel: "Disponíveis",
        selectedListLabel: "Selecionados",
        filterPlaceHolder: "Filtrar",
        filterTextClear: "Mostrar Todos",
        moveSelectedLabel: "Mover Selecionados",
        moveAllLabel: "Mover Todos",
        removeSelectedLabel: "Remover Selecionado",
        removeAllLabel: "Remover Todos",
        infoText: "Mostrando Todos - {0}",
        infoTextFiltered:
            '<span class="label label-warning">Filtrado</span> {0} DE {1}',
        infoTextEmpty: "Sem Dados",
        moveOnSelect: false,
    });

    $("body").on("click", ".btn-remove", "click", function (e) {
        e.preventDefault();
        swal({
            title: "Você esta certo?",
            text: "Deseja remover esse item mesmo?",
            icon: "warning",
            buttons: true,
        }).then((willDelete) => {
            if (willDelete) {
                var trLength = $(this)
                    .closest("tr")
                    .closest("tbody")
                    .find("tr").length;
                if (trLength > 1) {
                    $(this).closest("tr").remove();
                } else {
                    swal(
                        "Atenção",
                        "Você deve ter ao menos um item na lista",
                        "warning"
                    );
                }
            }
        });
    });

    $(".btn-print").on("click", printPage);
})(jQuery);

window.utilities = {
    changeImage: function () {
        $("#image").click();
    },
    readUrl: function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $("#preview-image").attr("src", e.target.result);
                $("#remove-image").val(0);
            };
        }
    },
    removeImage: function () {
        $("#preview-image").attr("src", "/img/noimage.png");
        $("#remove-image").val(1);
    },
};

function getUrl() {
    return document.getElementById("baseurl").value;
}

function convertMoedaToFloat(value) {
    if (!value) {
        return 0;
    }

    var number_without_mask = value.replace(".", "").replace(",", ".");
    return parseFloat(number_without_mask.replace(/[^0-9\.]+/g, ""));
}

function convertFloatToMoeda(value) {
    return value.toLocaleString("pt-BR", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
}

function activeMenu(url) {
    var element = $("ul.nav li a").filter(function () {
        return this.href == url.href || url.href.indexOf(this.href) == 0;
    });

    if (element.hasClass("collapse-item")) {
        element.addClass("active");
    }

    $(element)
        .parents()
        .each(function (index) {
            if (index == 0 && $(this).is("li")) {
                $(this).addClass("active");
            }
            if (this.className.indexOf("collapse") != -1) {
                $(this).addClass("show");
            }
        });
}

function printPage() {
    var divPrint = document.querySelector(".print");

    var myWindow = window.open("", "PRINT", "height=800,width=1200");

    myWindow.document.write(
        "<html><head><title>" + document.title + "</title>"
    );
    myWindow.document.write(
        "<style>@media print{.print{background-color:#fff;height:100%;width:100%;position:fixed;top:0;left:0;margin:0;padding:15px;font-size:14px;line-height:18px}.no-print{visibility:hidden;height:0}}@page{size:25cm 35.7cm;margin:5mm 8mm 5mm 8mm}footer{position:fixed;bottom:0;left:0;right:0}footer img{max-width:3.5rem}table{border-collapse:collapse}.table{width:100%;margin-bottom:1rem;color:#212529}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table-sm td,.table-sm th{padding:.3rem}.table-borderless tbody+tbody,.table-borderless td,.table-borderless th,.table-borderless thead th{border:0}.text-right{text-align:right!important}.img-fluid{max-width:100%;height:auto}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.5rem;font-weight:500;line-height:1.2}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}small{font-size:80%}.float-right{float:right!important}.border-bottom{border-bottom:1px solid #dee2e6!important}.border-top{border-top:1px solid #dee2e6!important}.text-left{text-align:left!important}.table-active,.table-active>td,.table-active>th{background-color:rgba(0,0,0,.075)}.table-active, .table-active > th, .table-active > td {   background-color: rgba(0, 0, 0, 0.075); } th { text-align: left;}.form-control {   display: block;   width: 100%;   height: calc(1.5em + 0.75rem + 2px);   padding: 0.375rem 0.75rem;   font-size: 1rem;   font-weight: 400;   line-height: 1.5;   color: #495057;   background-color: #fff;   background-clip: padding-box;   border: 1px solid #ced4da;   border-radius: 0.25rem;   transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }   </style>"
    );
    myWindow.document.write("</head><body >");
    myWindow.document.write(divPrint.innerHTML);
    myWindow.document.write("</body></html>");

    myWindow.document.close(); // necessary for IE >= 10
    myWindow.focus(); // necessary for IE >= 10*/

    myWindow.print();

    myWindow.onafterprint = function () {
        myWindow.close();
    };
}
