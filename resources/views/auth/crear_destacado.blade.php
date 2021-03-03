@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">{{ __('Destacar producto') }}</h3>
                    <div strong>
                        <p>Nombre del producto: {{$producto->producto}}</p>
                        <p>Descripcion del producto: {{$producto->descripcion}}</p>
                        <p>Precio del producto sin iva: {{$producto->precio}}</p>
                        <p>Iva del producto: {{$producto->iva}}</p>
                        <p>Codigo del producto: {{$producto->codigo_producto}}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.destacar') }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('patch') }}

                            <div class="form-group row">
                                <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>

                                <div class="col-md-6">
                                    <input id="fecha_inicio" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror"
                                        name="fecha_inicio" value="{{ old('fecha_inicio')}}" required autocomplete="nif">

                                    @error('fecha_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_fin"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>

                                <div class="col-md-6">
                                    <input id="fecha_fin" type="date"
                                        class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin"
                                        value="{{ old('fecha_fin')}}" required autocomplete="fecha_fin">

                                    @error('fecha_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="producto_id" type="hidden" class="form-control"  name="producto_id" value="{{ $producto->id }}">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Destacar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
