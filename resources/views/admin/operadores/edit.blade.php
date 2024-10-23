@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-pencil-fill"></i> Modificar Operador: {{ $operador->nombres }} {{ $operador->apellidos }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">
                        <i class="bi bi-card-checklist"></i> Rellene los datos:
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/operadores', $operador->id) }}" method="post">
                        @csrf <!-- Para evitar inyecciones SQL -->
                        @method('put')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombres</label><b>*</b>
                                    <input type="text" value="{{ $operador->nombres }}" name="nombres"
                                        class="form-control" required>
                                    @error('nombres')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellidos</label><b>*</b>
                                    <input type="text" value="{{ $operador->apellidos }}" name="apellidos"
                                        class="form-control" required>
                                    @error('apellidos')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">DNI</label><b>*</b>
                                    <input type="text" value="{{ $operador->dni }}" name="dni" class="form-control"
                                        required>
                                    @error('dni')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input type="text" value="{{ $operador->celular }}" name="celular"
                                        class="form-control" required>
                                    @error('celular')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input type="text" value="{{ $operador->direccion }}" name="direccion"
                                        class="form-control" required>
                                    @error('direccion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label><b>*</b>
                                    <input type="email" value="{{ $operador->user->email }}" name="email"
                                        class="form-control" required>
                                    @error('email')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Repetir Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin/operadores') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-pencil-square"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
