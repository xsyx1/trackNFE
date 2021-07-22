@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
				<div class="row">
					<div class="container">
						<div class="row">
						    @include('alerts.success')
                			@include('alerts.error')
						    <div class="col-md-4">
						    	@forelse ($data as $item)
					    		<div class="card mb">
					              <img class="card-img-top" src="http://www.placehold.it/286x180" alt="Card image cap">
					              <div class="card-body mb">
					              <table>
					                <h5 class="text-center card-title">{{$item->name }}</h5>
					                <hr>
					                <p class="text-center card-text">{{$item->total }}</p>
					                <hr>
					                	<a class="btn btn-primary mb" type="button" href="{{ route('nfe.create', $item) }}">Comprar</a>
					            	</table>
					              </div>
					            </div>
					            @empty
					            <div class=" col-md-12" style="display: flex; left: 100%">
					            	<div class="card-body mb">
                                		<h1 class="fas fa-ban"></h1>
                                		<h1 class="card-text" style="text-align: center; font-size: 1.1em;">
                                    		Nenhuma produto cadastrado.
                                		</h1>
                                	</div>
                            	</div>
                            @endforelse
					        </div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
