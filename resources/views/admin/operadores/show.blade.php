@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-eye-fill"></i> Operador: {{ $operador->nombres }} {{ $operador->apellidos }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="bi bi-card-checklist"></i> Datos Registrados:
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Nombres:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->nombres }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Apellidos:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->apellidos }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">DNI:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->dni }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Teléfono:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->celular }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Dirección:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->direccion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Correo:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $operador->user->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Fecha de Registro:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">
                                    {{ $operador->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Hora de Registro:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">
                                    {{ $operador->created_at->format('H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{ url('/admin/operadores') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left-circle"></i> Regresar
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
