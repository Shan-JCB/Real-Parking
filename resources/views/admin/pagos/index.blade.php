@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-credit-card-2-back-fill"></i> Listado de Pagos Realizados
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-card-checklist"></i> Datos:
                    </h3>
                </div>

                <script>
                    document.getElementById('tarifaButton').addEventListener('click', function() {
                        // Mostrar SweetAlert para ingresar la tarifa
                        Swal.fire({
                            title: 'Ingresar Tarifa',
                            input: 'text',
                            inputLabel: 'Ingrese el valor de la tarifa:',
                            inputPlaceholder: 'Ejemplo: 5.00',
                            inputAttributes: {
                                'aria-label': 'Ingrese el valor de la tarifa'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Confirmar',
                            cancelButtonText: 'Cancelar',
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Por favor ingrese un valor válido';
                                }
                                if (isNaN(value) || value <= 0) {
                                    return 'Por favor ingrese un valor numérico mayor que 0';
                                }
                                return null; // Si todo es correcto
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Aquí se maneja la lógica después de confirmar el valor de la tarifa
                                let tarifa = result.value;

                                // Puedes enviar la tarifa al servidor o hacer cualquier otra acción
                                console.log("Tarifa ingresada:", tarifa);

                                // Mostrar un mensaje de éxito
                                Swal.fire(
                                    'Tarifa Registrada',
                                    `La tarifa de S/. ${tarifa} ha sido registrada con éxito.`,
                                    'success'
                                );
                            }
                        });
                    });
                </script>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <center>Nro</center>
                                </th>
                                <th>
                                    <center>Placa</center>
                                </th>
                                <th>
                                    <center>Cliente</center>
                                </th>
                                <th>
                                    <center>Fecha</center>
                                </th>
                                <th>
                                    <center>Hora de ingreso</center>
                                </th>
                                <th>
                                    <center>Hora de salida</center>
                                </th>
                                <th>
                                    <center>Tarifa s/.</center>
                                </th>
                                <th>
                                    <center>Total s/.</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  $contador = 0; @endphp
                            @foreach ($pagos as $pago)
                                @php
                                    $contador = $contador + 1;
                                    $id = $pago->id;
                                    $evento = $pago->evento;
                                    $cliente = $evento ? $evento->cliente : null;
                                @endphp
                                <tr>
                                    <td style="text-align: center">{{ $contador }}</td>
                                    <td style="text-align: center">{{ $cliente ? $cliente->placa : 'No disponible' }}</td>
                                    <td style="text-align: center">
                                        {{ $cliente ? $cliente->nombres . ' ' . $cliente->apellidos : 'No disponible' }}
                                    </td>
                                    <td style="text-align: center">
                                        {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                    <td style="text-align: center">
                                        {{ \Carbon\Carbon::parse($evento->created_at)->format('H:i:s') }}</td>
                                    <td style="text-align: center">
                                        {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('H:i:s') }}</td>
                                    <td style="text-align: center">{{ $pago->tarifa }}</td>
                                    <td style="text-align: center">{{ $pago->total }}</td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ url('/admin/pagos', $pago->id) }}"
                                                onclick="preguntar{{ $id }}(event)" method="POST"
                                                id="miFormulario{{ $id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    style="border-radius: 0px 5px 5px 0px"><i
                                                        class="bi bi-trash3"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: 'Eliminar Registro',
                                                        text: 'Deseas eliminar registro?',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{ $id }}');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
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
                                    "lengthMenu": "Mostrar _MENU_ Operadores",
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
