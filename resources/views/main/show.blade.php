@extends('layout.app')

@section('content')
    <div class="card">
        <div class="btn-group">
            <a href="{{ route('orders.index')}}"><button class="btn btn-outline-info btn-sm">Todas las ordenes</button></a>
            <a href="{{ url('/')}}"><button class="btn btn-outline-dark btn-sm">Crear orden</button></a>
        </div>
    </div>
    @if('success')
        <div class="alert-warning">{{session('success')}}</div>
    @endif
    <show-order-component :order="{{$order}}"/>

@endsection
