@extends('layouts.admin')
@section('content')

    <!-- Titulo de Sección -->
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-car-front-fill"></i> Listado de Espacios
            </h1>
        </div>
    </div>
    <hr>
    <!----------------- Configuraciones de Mapeo ------------->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-black d-flex align-items-center">
                    <h3 class="card-title"> <i class="bi bi-map"></i> Mapeo actual del parqueo:</h3>

                    <!-- Scrollbar para selección de piso a la derecha -->
                    <div class="col-md-4 ml-auto">
                        <select id="piso" name="piso" class="form-control" onchange="filtrarPorPiso()">
                            @foreach ($pisos as $piso)
                                <option value="{{ $piso }}" {{ $pisoSeleccionado == $piso ? 'selected' : '' }}>
                                    {{ $piso }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($parqueos->count())
                            @foreach ($parqueos as $parqueo)
                                <div class="col">
                                    <center>
                                        <h2>{{ $parqueo->numero }}</h2>
                                        <!-- Condición para mostrar la imagen del auto solo si el estado es "OCUPADO" -->
                                        @if ($parqueo->estado === 'OCUPADO')
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#cancelarModal{{ $parqueo->id }}">
                                                <img src="{{ asset('imagenes/auto1.png') }}" style="width: 60px;"
                                                    alt="Auto">
                                            </button>
                                            <p>{{ $parqueo->estado }}</p>
                                            <!-- Modal para cancelar ingreso y procesar pago -->
                                            <div class="modal fade" id="cancelarModal{{ $parqueo->id }}" tabindex="-1"
                                                aria-labelledby="cancelarModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="cancelarModalLabel">Cancelar Pago
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                // Obtener la información del evento y cliente
                                                                $evento = \App\Models\Event::where(
                                                                    'parqueo_id',
                                                                    $parqueo->id,
                                                                )
                                                                    ->where('proceso', 'En curso')
                                                                    ->first();

                                                                $cliente = $evento ? $evento->cliente : null;
                                                                $tarifas = \App\Models\Tarifa::all(); // Obtener todas las tarifas
                                                            @endphp

                                                            @if ($evento && $cliente)
                                                                <!-- Mostrar la información del cliente -->
                                                                <div class="form-group row">
                                                                    <label for="dniCliente"
                                                                        class="col-sm-4 col-form-label">DNI Cliente:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            id="dniCliente" value="{{ $cliente->dni }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="nombreCliente"
                                                                        class="col-sm-4 col-form-label">Nombre
                                                                        Cliente:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            id="nombreCliente"
                                                                            value="{{ $cliente->nombres }} {{ $cliente->apellidos }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="placaCliente"
                                                                        class="col-sm-4 col-form-label">Placa del
                                                                        Vehículo:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            id="placaCliente" value="{{ $cliente->placa }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <!-- Numero de espacio -->
                                                                <div class="form-group row">
                                                                    <label for="numero"
                                                                        class="col-sm-4 col-form-label">Número
                                                                        Cubículo:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            id="numero" name="parqueo_id"
                                                                            value="{{ $parqueo->id }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <!-- Fecha y hora de ingreso -->
                                                                <div class="form-group row">
                                                                    <label for="fechaIngreso"
                                                                        class="col-sm-4 col-form-label">Fecha de
                                                                        Ingreso:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="date" class="form-control"
                                                                            id="fechaIngreso" name="fecha_ingreso"
                                                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="horaIngreso"
                                                                        class="col-sm-4 col-form-label">Hora de
                                                                        Ingreso:</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="time" class="form-control"
                                                                            id="horaIngreso" name="hora_ingreso"
                                                                            value="{{ \Carbon\Carbon::now()->format('H:i') }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <!-- Selección de tarifa -->
                                                                <div class="form-group row">
                                                                    <label for="tarifa"
                                                                        class="col-sm-4 col-form-label">Tarifa:</label>
                                                                    <div class="col-sm-8">

                                                                        <select id="tarifa" name="tarifa_id"
                                                                            class="form-control">
                                                                            <option value="" selected disabled>
                                                                                Seleccione una tarifa</option>
                                                                            @foreach ($tarifas as $tarifa)
                                                                                <option value="{{ $tarifa->id }}">
                                                                                    {{ $tarifa->nombre }} -
                                                                                    ${{ $tarifa->monto }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            @else
                                                                <p>No hay información de evento o cliente disponible.</p>
                                                            @endif
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ url('/admin/eventos/' . $parqueo->id . '/delete') }}"
                                                                method="post" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    Anular</button>
                                                            </form>

                                                            <!-- Nuevo botón combinado -->
                                                            <button id="btnPagoImprimir" class="btn btn-success">
                                                                <i class="bi bi-printer-fill"></i> Imprimir
                                                                Factura</button>

                                                            <!-- Formulario oculto para procesar el pago -->
                                                            <form id="pagoForm"
                                                                action="{{ url('/admin/pagos/procesar') }}"
                                                                method="post" style="display: none;">
                                                                @csrf
                                                                <input type="hidden" name="parqueo_id"
                                                                    value="{{ $parqueo->id }}">
                                                                <input type="hidden" name="evento_id"
                                                                    value="{{ $evento->id }}">
                                                                <input type="hidden" name="tarifa_id"
                                                                    id="tarifa_hidden">
                                                            </form>

                                                            @if ($pagos->count() > 0)
                                                                <!-- Esto es opcional si solo quieres imprimir el último pago -->
                                                                <a id="imprimirFactura"
                                                                    href="{{ route('admin.pagos.imprimirFactura', $pagos->last()->id) }}"
                                                                    target="_blank" style="display: none;"></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button class="btn btn-success" style="width: 80px; height: 135px"
                                                data-toggle="modal" data-target="#modal{{ $parqueo->id }}">
                                                <p>{{ $parqueo->estado }}</p>
                                            </button>

                                            <!-- Modal -->
                                            <form id="eventoForm{{ $parqueo->id }}"
                                                action="{{ url('/admin/eventos/create') }}" method="post">
                                                @csrf
                                                <div class="modal fade" id="modal{{ $parqueo->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">INGRESO DEL
                                                                    VEHÍCULO</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>

                                                                    <!-- Lista de Clientes con Placas y Nombres -->
                                                                    <div class="form-group row align-items-center">
                                                                        <label for="clienteSelect{{ $parqueo->id }}"
                                                                            class="col-sm-3 col-form-label">Cliente:</label>
                                                                        <div class="col-md-6">
                                                                            <select name="cliente_id"
                                                                                id="clienteSelect{{ $parqueo->id }}"
                                                                                onchange="llenarPlaca({{ $parqueo->id }})"
                                                                                class="form-control">
                                                                                @foreach ($clientes as $cliente)
                                                                                    <option value="{{ $cliente->placa }}">
                                                                                        {{ $cliente->placa }} -
                                                                                        {{ $cliente->nombres }}
                                                                                        {{ $cliente->apellidos }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 text-center">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-sm"
                                                                                onclick="buscarCliente({{ $parqueo->id }})">
                                                                                <i class="bi bi-search"></i> Detalle
                                                                            </button>
                                                                        </div>
                                                                    </div>


                                                                    <!-- Placa -->
                                                                    <div class="form-group row">
                                                                        <label for="placaInput{{ $parqueo->id }}"
                                                                            class="col-sm-3 col-form-label">Placa:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="placaInput{{ $parqueo->id }}"
                                                                                name="placa" required>
                                                                        </div>
                                                                    </div>



                                                                    <!-- Mostrar resultados -->
                                                                    <div id="resultadoBusqueda{{ $parqueo->id }}"></div>
                                                                    <!-- Mensajes de error -->
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif

                                                                    <!-- Numero de Espacio -->
                                                                    <div class="form-group row">
                                                                        <label for="numero"
                                                                            class="col-sm-3 col-form-label">Número
                                                                            Espacio:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                id="numero" name="parqueo_id"
                                                                                value="{{ $parqueo->id }}" readonly>
                                                                        </div>
                                                                    </div>


                                                                    <!-- Operador -->
                                                                    <div class="form-group row">
                                                                        <label for="operador" class="col-sm-3 col-form-label">Operador:</label>
                                                                        <div class="col-sm-9">
                                                                            <select name="operador_id" id="operador" class="form-control">
                                                                                @foreach ($operadors as $operador)
                                                                                    <option value="{{ $operador->id }}" 
                                                                                        @if (Auth::check() && Auth::user()->id == $operador->user_id) selected @endif>
                                                                                        {{ $operador->nombres }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    


                                                                    <!-- Fecha de Ingreso -->
                                                                    <div class="form-group row">
                                                                        <label for="fechaIngreso"
                                                                            class="col-sm-3 col-form-label">Fecha y Hora de
                                                                            Ingreso:</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="date" class="form-control"
                                                                                id="fechaIngreso" name="fecha_ingreso"
                                                                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <input type="time" class="form-control"
                                                                                id="horaIngreso" name="hora_ingreso"
                                                                                value="{{ \Carbon\Carbon::now()->format('H:i') }}">
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Botón para dirigir a la ruta de crear un nuevo cliente -->
                                                                <a href="{{ url('/admin/clientes/create') }}"
                                                                    class="btn btn-success">
                                                                    <i class="bi bi-person-plus-fill"></i> Nuevo Cliente
                                                                </a>

                                                                <button type="button" class="btn btn-info"
                                                                    onclick="registrarEvento({{ $parqueo->id }})">
                                                                    <i class="bi bi-printer-fill"></i> Imprimir Ticket
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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

    <!------------- SCRIPTS -------------->

    <script>
        // Asignar la tarifa seleccionada al campo oculto del formulario:
        document.querySelectorAll('select[name="tarifa_id"]').forEach(function(select) {
            select.addEventListener('change', function() {
                let modal = select.closest('.modal');
                modal.querySelector('#tarifa_hidden').value = this.value;
            });
        });
    </script>

    <script>
        function llenarPlaca(parqueoId) {
            // Obtener el valor seleccionado (placa) del select
            const select = document.getElementById(`clienteSelect${parqueoId}`);
            const placa = select.value;

            // Asignar la placa al input de placa correspondiente
            const placaInput = document.getElementById(`placaInput${parqueoId}`);
            placaInput.value = placa;
        }
    </script>

    <script>
        // Funcion para buscar placa de clientes registrados:
        function buscarCliente(id) {
            let placa = document.getElementById('placaInput' + id).value;

            fetch('{{ route('buscar.cliente') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        placa: placa
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let resultadoDiv = document.getElementById('resultadoBusqueda' + id);
                    if (data.status === 'success') {
                        let cliente = data.cliente;
                        resultadoDiv.innerHTML = `
                        <!-- DNI -->
                        <div class="form-group row">
                            <label for="dniCliente" class="col-sm-3 col-form-label"><strong>DNI:</strong></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dniCliente" value="${cliente.dni}" readonly>
                            </div>
                        </div>

                        <!-- Nombres -->
                        <div class="form-group row">
                            <label for="nombreCliente" class="col-sm-3 col-form-label"><strong>Nombres:</strong></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombreCliente" value="${cliente.nombres} ${cliente.apellidos}" readonly>
                            </div>
                        </div>
                        `;
                    } else {
                        resultadoDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        // Funcion para registrar evento e imprimir ticket:
        function registrarEvento(parqueoId) {
            let formData = new FormData(document.getElementById('eventoForm' + parqueoId));

            fetch('{{ url('/admin/eventos/create') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Mostrar mensaje de éxito con SweetAlert
                        Swal.fire({
                            title: '¡Éxito!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Abrir el PDF en una nueva ventana
                                window.open('{{ url('/admin/eventos') }}/' + data.evento_id + '/print',
                                    '_blank');

                                // Refrescar la página
                                location.reload();
                            }
                        });
                    } else {
                        // Mostrar mensaje de error con SweetAlert
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al registrar el evento:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al registrar el evento. Inténtalo nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>

    <script>
        // Funcion para registrar pago e imprimir factura:
        document.getElementById('btnPagoImprimir').addEventListener('click', function() {
            // Obtener el formulario
            let form = document.getElementById('pagoForm');

            // Crear objeto FormData a partir del formulario
            let formData = new FormData(form);

            // Enviar la solicitud AJAX para procesar el pago
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Mostrar mensaje de éxito con SweetAlert
                        Swal.fire({
                            title: data.titulo,
                            text: data.message,
                            icon: data.icono,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Abrir la factura en una nueva pestaña
                            let facturaUrl = document.getElementById('imprimirFactura').href;
                            window.open(facturaUrl, '_blank');

                            // Refrescar la página después de mostrar la alerta
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })

        });
    </script>

    <script>
        function filtrarPorPiso() {
            let pisoSeleccionado = document.getElementById('piso').value;
            window.location.href = `{{ url('admin/parqueos') }}?piso=${pisoSeleccionado}`;
        }
    </script>

    <hr>

    <!------------- CRUD VEHICULOS -------------->

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-card-checklist"></i> Registrar Nuevo Cubículo:
                    </h3>
                    <div class="card-tools ml-auto">
                        <a href="{{ url('/admin/parqueos/create') }}" class="btn btn-primary">
                            <i class="bi bi-car-front-fill"></i> Nuevo Cubículo
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <center>Nro</center>
                                </th>
                                <th>
                                    <center>Cubículo</center>
                                </th>
                                <th>
                                    <center>Estado</center>
                                </th>
                                <th>
                                    <center>Piso</center>
                                </th>
                                <th>
                                    <center>Observación/Detalle</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  $contador = 0; @endphp
                            @foreach ($parqueos as $parqueo)
                                @php
                                    $contador = $contador + 1;
                                    $id = $parqueo->id;
                                @endphp
                                <tr>
                                    <td style="text-align: center">{{ $contador }}</td>
                                    <td style="text-align: center">{{ $parqueo->numero }}</td>
                                    <td style="text-align: center">{{ $parqueo->estado }}</td>
                                    <td style="text-align: center">{{ $parqueo->piso }}</td>
                                    <td style="text-align: center">{{ $parqueo->observacion }}</td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('admin/parqueos/' . $parqueo->id . '/edit') }}"
                                                type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                            <a href="{{ url('admin/parqueos/' . $parqueo->id . '/confirm-delete') }}"
                                                type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Operadores",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Operadores",
                                    "infoFiltered": "(Filtrado de _MAX_ total Operadores)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar MENU Operadores",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                buttons: [{
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [{
                                            text: 'Copiar',
                                            extend: 'copy',
                                        }, {
                                            extend: 'pdf'
                                        }, {
                                            extend: 'csv'
                                        }, {
                                            extend: 'excel'
                                        }, {
                                            text: 'Imprimir',
                                            extend: 'print'
                                        }]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
