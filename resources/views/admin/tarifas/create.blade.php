@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-card-checklist"></i> Nueva Tarifa
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="bi bi-card-checklist"></i> Rellene los datos:
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/tarifas/create') }}" method="post">
                        @csrf <!-- Para evitar inyecciones SQL -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre</label><b>*</b>
                                    <input type="text" value="{{ old('nombre') }}" name="nombre" class="form-control"
                                        required>
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Monto</label><b>*</b>
                                    <input type="number" value="{{ old('monto') }}" name="monto" class="form-control"
                                        required step="0.01" min="0">
                                    @error('monto')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Periodo:</label><b>*</b>
                                    <input type="number" value="{{ old('periodo') }}" name="periodo" class="form-control"
                                        required step="0.01" min="0">
                                    @error('periodo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Minutos</label>
                                    <input type="text" value="MM" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea name="descripcion" id="" cols="30" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/admin/tarifas') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left-circle"></i> Regresar
                                </a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-floppy2"></i>
                                    Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
