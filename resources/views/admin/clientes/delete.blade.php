@extends('layouts.admin')
@section('content')

    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-trash-fill"></i> Borrar Cliente: {{ $cliente->nombres }} {{ $cliente->apellidos }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-exclamation-triangle-fill "></i> ¿Está seguro de eliminar este registro?
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post">
                        @csrf <!-- Para evitar inyecciones SQL -->
                        @method('delete')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">DNI:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->dni }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Placa:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->placa }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nombres:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->nombres }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Apellidos:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->apellidos }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Teléfono:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->celular }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Dirección:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->direccion }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Correo:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $cliente->correo }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha y Hora de registro:</label>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">
                                        {{ $cliente->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-danger"><i class="bi bi-dash-circle"></i>
                                    Borrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
