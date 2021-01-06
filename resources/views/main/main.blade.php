@extends('layout.app')

@section('content')
    <div class="card">
        <div class="btn-group">
            <a href="{{ route('orders.index')}}"><button class="btn btn-outline-info btn-sm">Todas las ordenes</button></a>
            <a href="{{ url('/')}}"><button class="btn btn-outline-dark btn-sm">Crear orden</button></a>
        </div>
    </div>
    <div class="row ">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
<form-component/>
@endsection
