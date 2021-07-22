<div class="row">
    <div class="col-md-5">
        {!!Form::text('name', 'Nome do Produto')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('cod', 'Codigo do Produto')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('ncm', 'Codigo NCM')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('cest', 'Codigo CEST')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('amount', 'Quantidade')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('unit', 'Unidade de medida')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('weight', 'Peso do Produto')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('origin', 'Origem do Produto')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('subtotal', 'Subtotal')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('total', 'Total')
        ->required()
        !!}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-success float-right mt-4">Salvar</button>
    </div>
</div>
