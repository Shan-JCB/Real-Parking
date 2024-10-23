@extends('layouts.admin')

@section('content')

<p><b>User:</b> {{ Auth::user()->name }} / <b>Rol: </b> {{Auth::user()->roles->pluck('name')->first()}}</p>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card" style="background-color: #52006b; color: white;">
                    <div class="card-body text-center">
                        <h1> <i class="bi bi-bookmark-star-fill"></i> Bienvenido {{ Auth::user()->name }} al Sistema de Parqueo <i class="bi bi-bookmark-star-fill"></i></h1>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-12">
                <div class="card" style="background-image: url('{{ asset('imagenes/estacionamiento.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="card-body text-white" style="background-color: rgba(0, 0, 0, 0.5);">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_clientes }}</h3>
                                        <p>Clientes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-person-fill"></i>
                                    </div>
                                    <a href="{{ url('admin/clientes') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>

                            @can('usuarios.index')
                                
                            
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_operadores }}</h3>
                                        <p>Operadores</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-person-gear"></i>
                                    </div>
                                    <a href="{{ url('admin/operadores') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>

                            @endcan

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_parqueos }}</h3>
                                        <p>Parkings</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-car-front-fill"></i>
                                    </div>
                                    <a href="{{ url('admin/parqueos') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_pagos }}</h3>
                                        <p>Pagos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-credit-card-2-back-fill"></i>
                                    </div>
                                    <a href="{{ url('admin/pagos') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>

                            @can('usuarios.index')
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_tarifas }}</h3>
                                        <p>Tarifas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-currency-dollar"></i>
                                    </div>
                                    <a href="{{ url('admin/tarifas') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 class="display-4">{{ $total_usuarios }}</h3>
                                        <p>Usuarios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion fas bi bi-people-fill"></i>
                                    </div>
                                    <a href="{{ url('admin/usuarios') }}" class="small-box-footer">
                                        Más información <i class="bi bi-info-circle"></i>
                                    </a>
                                </div>
                            </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
