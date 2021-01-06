@extends('layout.app')

@section('content')
    <div class="container mt-4 text-center">
        <a class="btn btn-primary" href="{{ route('orders.index')}}">Todas las ordenes</a>
        <a class="btn btn-danger" href="{{ url('/')}}">Crear orden</a>
    </div>
    @if('success')
        <div class="alert-warning">{{session('success')}}</div>
    @endif
    <show-order-component :order="{{$order}}"/>

@endsection
