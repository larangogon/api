@extends('layout.app')

@section('content')
    <div class="container mt-4 text-center">
        <a class="btn btn-primary" href="{{ route('orders.index')}}">Todas las ordenes</a>
        <a class="btn btn-danger" href="{{ url('/')}}">Crear orden</a>
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
