@extends('layouts.admin')

@section('title', 'Contáctanos')

@section('content')

<div class="row mb-6">
    <div class="col-md-12 text-center">
        <h1 class="display-6">
            <i class="bi bi-chat-heart-fill"></i> ¡Déjanos un Comentario!
        </h1>
    </div>
</div>
<hr>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">
                    <i class="bi bi-check-lg"></i> Ingrese su mensaje.
                </h3>
            </div>
                <div class="card-body">
                    <form action="{{ route('contactanos.store') }}" method="POST">
                        {{-- TOKEN DE SEGURIDAD --}}
                        @csrf
            
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $user->name ?? '') }}" readonly>
                        </div>
            
                        @error('nombre')
                            <p class="text-danger"><strong>{{ $message }}</strong></p>
                        @enderror
            
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" class="form-control" value="{{ old('correo', $user->email ?? '') }}" readonly>
                        </div>
            
                        @error('correo')
                            <p class="text-danger"><strong>{{ $message }}</strong></p>
                        @enderror
            
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea name="mensaje" rows="5" class="form-control">{{ old('mensaje') }}</textarea>
                        </div>
                        @error('mensaje')
                            <p class="text-danger"><strong>{{ $message }}</strong></p>
                        @enderror
            
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-send-fill"></i> Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

@if (session('info'))
    <script>
        Swal.fire({
            title: 'Mensaje enviado',
            text: "{{ session('info') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@endsection
