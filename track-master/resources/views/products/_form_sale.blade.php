<div class="row">
    <div class="col-md-12">
        <h1>Cliente</h1>
    </div>
    <hr>
    <div class="col-md-5">
        {!!Form::text('name', 'Nome do Cliente')
        ->required()
        !!}
    </div>
    <div class="col-md-3">
        {!!Form::text('nif', 'Cpf')
        ->required()!!}
    </div>
    <div class="col-md-5">
        {!!Form::text('address', 'Endereço')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('number', 'Numero')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('district', 'Bairro')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('complement', 'Complemento')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('city', 'Cidade')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('state', 'Estado')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('zip_code', 'Cep')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('phone', 'Telefone')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('email', 'Email')
        ->required()!!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1>Produto</h1>
    </div>
    <hr>
    <div class="col-md-3">
        {!!Form::text('name', 'Nome do Produto')
        ->value(isset($item) ? $item->name : '')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('cod', 'Codigo do Produto')
        ->value(isset($item) ? $item->cod : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('ncm', 'Codigo NCM')
        ->value(isset($item) ? $item->ncm : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('cest', 'Codigo CEST')
        ->value(isset($item) ? $item->cest : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('amount', 'Quantidade')
        ->value(isset($item) ? $item->amount : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('unit', 'Unidade de medida')
        ->value(isset($item) ? $item->unit : '')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('weight', 'Peso do Produto')
        ->value(isset($item) ? $item->weight : '')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('origin', 'Origem do Produto')
        ->value(isset($item) ? $item->origin : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('subtotal', 'Subtotal')
        ->value(isset($item) ? $item->subtotal : '')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('total', 'Total')
        ->value(isset($item) ? $item->total : '')
        ->required()!!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1>Pedido</h1>
    </div>
    <hr>
    <div class="col-md-3">
        {!!Form::text('form_pay', 'Forma de pagamento')
        ->required()!!}
    </div>
    <div class="col-md-3">
        {!!Form::text('pay', 'pagamento')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('shipping', 'Frete')
        ->required()!!}
    </div>
    <div class="col-md-2">
        {!!Form::text('discount', 'Desconto')
        ->required()!!}
    </div>
        <div class="col-md-2">
        {!!Form::text('total', 'Total')
        ->required()!!}
    </div>

    
</div>
<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-success float-right mt-4">Salvar</button>
    </div>
</div>
