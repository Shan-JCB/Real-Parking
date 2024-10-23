@extends('layouts.plantilla')

@section('content')

<div class="row">
<h1>Bienvenido!!</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Mapeo Actual del parqueo</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($parqueos->count())
                        @foreach ($parqueos as $parqueo)
                            <div class="col">
                                <center>
                                    <h2>{{ $parqueo->numero }}</h2>
                                    <!-- Condición para mostrar la imagen del auto solo si el estado es "OCUPADO" -->
                                    @if ($parqueo->estado === 'OCUPADO')
                                        <button class="btn btn-info">
                                            <img src="{{asset('imagenes/auto1.png')}}" style="width: 60px;" alt="Auto">
                                        </button>
                                        <p>{{ $parqueo->estado }}</p>
                                    @else
                                    <button class="btn btn-success" style="width: 80px; height: 135px">
                                        <p>{{ $parqueo->estado }}</p>
                                    </button>    
                                    @endif
                                    
                                </center>
                            </div>
                        @endforeach
                    @else
                        <p>No hay vehículos en este piso.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function filtrarPorPiso() {
    let pisoSeleccionado = document.getElementById('piso').value;
    window.location.href = `{{ url('/home') }}?piso=${pisoSeleccionado}`;
}
</script>

@endsection