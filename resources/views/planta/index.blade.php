@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png" />
@section('content_header')

@stop

@section('content')
<!--Mensaje Creado -->
@if (session('fincaGuardado'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('fincaGuardado') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!--Mensaje Modificado-->
@if (session('fincaModificado'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('fincaModificado') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!--Mensaje Eliminado -->
@if (session('fincaEliminado'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('fincaEliminado') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card">
    <div class="justify-content-center">
        <div class="card-header align-items-center">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h1>Planta</h1>
                </div>
                <div class="container col-md-2">
                    <div class="text-center justify-content-center">
                        <a href="plantas/create" class="btn btn-success">Nuevo Registro</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="table"
                class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                cellspacing="0" width="100%">
                @php
                $count=1;
                @endphp
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CÓDIGO</th>
                        <th>ESTUDIO</>
                        <th>COORDENADAS</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plantas as $planta)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $planta->codigo }}</td>
                        @foreach ($estudios as $estudio)
                        @if($planta->idEstudio==$estudio->id)
                        <td>{{ $estudio->codigo }}</td>
                        @endif
                        @endforeach
                        <td>X:{{ $planta->x }} Y:{{ $planta->y }}</td>
                        <td>
                            <form action="{{route('plantas.destroy', $planta->id)}}" method="POST">
                                <a href="{{route('plantas.edit',$planta->id)}}" class="btn btn-secondary"><i
                                        class="fas fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Desea eliminar esto?')"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

<link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet"
    type="text/css">
@stop

@section('js')
@include('js.datatables')
@stop