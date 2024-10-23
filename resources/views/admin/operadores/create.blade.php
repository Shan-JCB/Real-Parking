@extends('layouts.admin')
@section('content')

    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-person-fill-add"></i> Nuevo Operador
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="bi bi-card-checklist"></i> Rellene los datos:
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/operadores/create') }}" method="post">
                        @csrf <!-- Para evitar inyecciones SQL -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">DNI</label><b>*</b>
                                    <input type="text" value="{{ old('dni') }}" name="dni" class="form-control"
                                        required>
                                    @error('dni')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombres</label><b>*</b>
                                    <input type="text" value="{{ old('nombres') }}" name="nombres" class="form-control"
                                        required>
                                    @error('nombres')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Apellidos</label><b>*</b>
                                    <input type="text" value="{{ old('apellidos') }}" name="apellidos"
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
                                    <label for="">Teléfono</label>
                                    <input type="text" value="{{ old('celular') }}" name="celular" class="form-control"
                                        required>
                                    @error('celular')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input type="text" value="{{ old('direccion') }}" name="direccion"
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
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                        required>
                                    @error('email')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Password</label><b>*</b>
                                    <input type="password" name="password" class="form-control" required>
                                    @error('password')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Repetir Password</label><b>*</b>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin/operadores') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-floppy2"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
