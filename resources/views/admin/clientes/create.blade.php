@extends('layouts.admin')
@section('content')

<div class="row mb-6">
    <div class="col-md-12 text-left">
        <h1 class="display-6">
            <i class="bi bi-person-fill-add"></i> Nuevo Cliente
        </h1>
    </div>
</div>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="bi bi-card-checklist"></i> Rellene los datos:
                    </h3>        
                </div>
                    <div class="card-body">
                        <form action="{{url('/admin/clientes/create')}}" method="post">
                            @csrf <!-- Para evitar inyecciones SQL -->
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">DNI</label><b>*</b>
                                        <input type="text" value="{{old('dni')}}" name="dni" class="form-control" required>
                                        @error('dni')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Placa</label><b>*</b>
                                        <input type="text" value="{{old('placa')}}" name="placa" class="form-control" required>
                                        @error('placa')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nombres</label><b>*</b>
                                        <input type="text" value="{{old('nombres')}}" name="nombres" class="form-control" required>
                                        @error('nombres')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Apellidos</label><b>*</b>
                                        <input type="text" value="{{old('apellidos')}}" name="apellidos" class="form-control" required>
                                        @error('apellidos')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Teléfono</label><b>*</b>
                                    <input type="text" value="{{old('celular')}}" name="celular" class="form-control" required>
                                    @error('celular')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Dirección</label><b>*</b>
                                        <input type="text" value="{{old('direccion')}}" name="direccion" class="form-control" required>
                                        @error('direccion')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Correo</label><b>*</b>
                                        <input type="email" value="{{old('correo')}}" name="correo" class="form-control" required>
                                        @error('email')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row mt-3">
                                <div class="col-md-12 text-right">
                                    <a href="{{ url('/admin/parqueos') }}" class="btn btn-warning">
                                        <i class="bi bi-arrow-left-circle"></i> Parking
                                    </a>

                                    <a href="{{ url('/admin/clientes') }}" class="btn btn-primary">
                                        <i class="bi bi-arrow-left-circle"></i> Regresar
                                    </a>
                                    <button type="submit" class="btn btn-success"><i class="bi bi-floppy2"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
@endsection