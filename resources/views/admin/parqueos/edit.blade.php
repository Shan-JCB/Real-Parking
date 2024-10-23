@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-center">
            <h1 class="display-6">
                <i class="bi bi-car-front-fill"></i> Modificar Espacio: {{ $parqueo->numero }}
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Rellene los datos:</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/parqueos', $parqueo->id) }}" method="post">
                        @csrf <!-- Para evitar inyecciones SQL -->
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nro espacio</label><b>*</b>
                                    <input type="text" value="{{ old('numero', $parqueo->numero) }}" name="numero"
                                        class="form-control" required>
                                    @error('numero')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <select name="estado" class="form-control">
                                        <option value="LIBRE"
                                            {{ old('estado', $parqueo->estado) == 'LIBRE' ? 'selected' : '' }}>LIBRE
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Piso</label>
                                    <select name="piso" class="form-control">
                                        <option value="PISO 1"
                                            {{ old('piso', $parqueo->piso) == 'PISO 1' ? 'selected' : '' }}>PISO 1</option>
                                        <option value="PISO 2"
                                            {{ old('piso', $parqueo->piso) == 'PISO 2' ? 'selected' : '' }}>PISO 2</option>
                                        <option value="PISO 3"
                                            {{ old('piso', $parqueo->piso) == 'PISO 3' ? 'selected' : '' }}>PISO 3</option>
                                        <option value="PISO EXTERIOR"
                                            {{ old('piso', $parqueo->piso) == 'PISO EXTERIOR' ? 'selected' : '' }}>PISO
                                            EXTERIOR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observacion" cols="30" class="form-control" rows="5">{{ old('observacion', $parqueo->descripcion) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin/parqueos') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-floppy2"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
