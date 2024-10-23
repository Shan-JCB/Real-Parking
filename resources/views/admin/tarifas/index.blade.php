@extends('layouts.admin')
@section('content')
    <div class="row mb-6">
        <div class="col-md-12 text-left">
            <h1 class="display-6">
                <i class="bi bi-currency-dollar"></i> Listado de Tarifas
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-card-checklist"></i> Registrar Nueva Tarifa:
                    </h3>
                    <div class="card-tools ml-auto">
                        <a href="{{ url('/admin/tarifas/create') }}" class="btn btn-primary">
                            <i class="bi bi-currency-dollar"></i> Nueva Tarifa
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
                                    <center>Nombre</center>
                                </th>
                                <th>
                                    <center>Monto</center>
                                </th>
                                <th>
                                    <center>Periodo</center>
                                </th>
                                <th>
                                    <center>Descripción</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @php  $contador = 0; @endphp

                            @foreach ($tarifas as $tarifa)
                                @php
                                    $contador = $contador + 1;
                                    $id = $tarifa->id;
                                @endphp
                                <tr>
                                    <td style="text-align: center">{{ $contador }}</td>
                                    <td style="text-align: center">{{ $tarifa->nombre }}</td>
                                    <td style="text-align: center">{{ $tarifa->monto }}</td>
                                    <td style="text-align: center">{{ $tarifa->periodo }}</td>
                                    <td style="text-align: center">{{ $tarifa->descripcion }}</td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <a href="{{ url('admin/tarifas/' . $tarifa->id . '/edit') }}" type="button"
                                                class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                
                                            <form action="{{ url('/admin/tarifas', $tarifa->id) }}"
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
                                                    }).then((result) => { // Corregir los paréntesis
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{ $id }}'); // Uso correcto de la variable Blade
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
