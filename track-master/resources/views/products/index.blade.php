@extends('layouts.app', ['page' => 'Produtos', 'pageSlug' => 'products'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Produtos</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Adicionar Novo</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')
                @include('alerts.error')
                <form class=" my-2 my-lg-0 justify-content-end"
					method="GET">
					<div class="row">
						<div class="col-md-8">
						<input class="form-control " type="text"
							name="criterio" maxlength="64"
							placeholder="Pesquisar" aria-label="Pesquisar">
						</div>
						<div class="col-md-4 d-flex justify-content-end">
							<br>
							<button class="btn btn-sm  btn-primary" type="submit">Filtrar</button>
							<a id="clear-filter" class="btn btn-sm  btn-default"
								href="{{ route('products.index') }}"><ir class="fa fa-eraser"></i>Limpar</a>
						</div>
					</div>
				</form>

                <div class="table-responsive">
                    <table class="table tablesorter table-striped" id="">
                        <thead class=" text-primary">
                            <th scope="col">Nome</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Origem</th>
                            <th scope="col">Valor</th>
                            <th scope="col" class="text-right">Ação</th>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->origin }}</td>
                                <td>{{ $item->total }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <form action="{{ route('products.destroy', $item->id) }}" method="post"
                                                id="form-{{$item->id}}">
                                                @csrf
                                                @method('delete')
                                                <a class="dropdown-item"
                                                    href="{{ route('products.show', $item) }}">Visualizar</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('products.edit', $item) }}">Editar</a>
                                                <button type="button" class="dropdown-item btn-delete">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="20" style="text-align: center; font-size: 1.1em;">
                                    Nenhuma informação cadastrada.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $data->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
