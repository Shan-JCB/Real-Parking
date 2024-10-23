@extends('layouts.admin')
@section('content')

    <div class="row mb-6">
        <div class="col-md-12 text-center">
            <h1 class="display-6">
                <i class="bi bi-pencil-fill"></i> Modificar Usuario: {{$usuario->name}}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                        <h3 class="card-title">
                            <i class="bi bi-card-checklist"></i> Rellene los datos:
                        </h3>   
                    </div>
                    <div class="card-body">
                        <form action="{{url('/admin/usuarios', $usuario->id)}}" method="post">
                            @csrf <!-- Para evitar inyecciones SQL -->
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre del Usuario</label>
                                        <input type="text" value="{{$usuario->name}}" name="name" class="form-control" required>
                                        @error('name')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" value="{{$usuario->email}}" name="email" class="form-control" required>
                                        @error('email')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                        @error('password')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Repetir Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-12 text-right">
                                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-arrow-left-circle"></i> Regresar
                                    </a>
                                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-pencil-square"></i> Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection