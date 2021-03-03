@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">{{ __('Modificar informacion del producto') }}</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.modificar') }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('patch') }}
                            <div class="form-group row">
                                <label for="producto" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>
                                <div class="col-md-6">
                                    <input id="producto" type="text" class="form-control @error('producto') is-invalid @enderror"
                                        name="producto" value="{{ $producto->producto}}" required autocomplete="producto">
                                    @error('producto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>
                                <div class="col-md-6">
                                    <input id="precio" type="text" class="form-control @error('precio') is-invalid @enderror" 
                                        name="precio" value="{{ $producto->precio}}" required autocomplete="precio">
                                    @error('precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="iva" class="col-md-4 col-form-label text-md-right">{{ __('IVA') }}</label>
                                <div class="col-md-6">
                                    <input id="iva" type="text" class="form-control @error('iva') is-invalid @enderror"
                                        name="iva" value="{{ $producto->iva}}" required autocomplete="iva">
                                    @error('iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                <div class="col-md-6">
                                    <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                        name="descripcion" required autocomplete="descripcion">{{ $producto->descripcion}}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                                <div class="col-md-6">
                                    <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror"
                                        name="stock" value="{{ $producto->stock}}" required autocomplete="stock">
                                    @error('stock')
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
                                        {{ __('Modificar') }}
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
