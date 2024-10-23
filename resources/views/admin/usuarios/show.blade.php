@extends('layouts.admin')

@section('content')

    <div class="row mb-6">
        <div class="col-md-12 text-center">
            <h1 class="display-6">
                <i class="bi bi-eye-fill"></i> Detalles del Usuario</h1>
        </div>
    </div>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-card-checklist"></i> Datos Registrados
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Nombre del Usuario:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{$usuario->name}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Correo Electrónico:</label>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{$usuario->email}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('/admin/usuarios') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-arrow-left-circle"></i> Regresar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
