@extends('layout.app')

@section('content')
    <div class="container my-4">
        <div class="card w-75 m-auto p-2">
            <h1 class="card-title">Todas las ordenes
                <a href="{{ url('/')}}"><button class="btn btn-success btn-sm">Crear orden</button></a>
            </h1>
            <table class="table table-borderless table-hover">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>description</th>
                    <th>reference</th>
                    <th>expiration</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><a class="btn" href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->status }}</td>
                        <td>${{ $order->amount }}</td>
                        <td>{{ $order->description }}</td>
                        <td>{{ $order->reference }}</td>
                        <td>{{ $order->expiration }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
