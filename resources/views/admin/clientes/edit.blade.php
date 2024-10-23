@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-pencil-fill"></i> Modificar Cliente: {{ $cliente->nombres . ' ' . $cliente->apellidos }}
            </h1>
        </div>
    </div>
    <hr>

    <!-- Formulario para Información Básica -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">
                        <i class="bi bi-check-circle"></i> Editar Información Básica:
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/clientes/basica/' . $cliente->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label><b>*</b>
                                    <input type="text" value="{{ $cliente->nombres }}" name="nombres"
                                        class="form-control" required>
                                    @error('nombres')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label><b>*</b>
                                    <input type="text" value="{{ $cliente->apellidos }}" name="apellidos"
                                        class="form-control" required>
                                    @error('apellidos')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Teléfono</label><b>*</b>
                                    <input type="text" value="{{ $cliente->celular }}" name="celular"
                                        class="form-control" required>
                                    @error('celular')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label><b>*</b>
                                    <input type="text" value="{{ $cliente->direccion }}" name="direccion"
                                        class="form-control" required>
                                    @error('direccion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right" >
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-floppy2"></i> Actualizar Información Básica
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario para Información Relevante -->
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Editar Información Relevante:
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/clientes/relevante/' . $cliente->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni">DNI</label><b>*</b>
                                    <input type="text" value="{{ $cliente->dni }}" name="dni" class="form-control"
                                        required>
                                    @error('dni')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="placa">Placa</label><b>*</b>
                                    <input type="text" value="{{ $cliente->placa }}" name="placa" class="form-control"
                                        required>
                                    @error('placa')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="correo">Correo</label><b>*</b>
                                    <input type="email" value="{{ $cliente->correo }}" name="correo"
                                        class="form-control" required>
                                    @error('correo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-floppy2"></i> Actualizar Información Relevante</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-right">
            <a href="{{ url('/admin/clientes') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i> Regresar
            </a>
        </div>
    </div>
@endsection
