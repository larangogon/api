@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 p-4 border rounded-lg">
            <div class="row">
                <h1>Todas las ordenes
                    <a href="{{ url('/')}}"><button class="btn btn-success btn-sm">Crear orden</button></a>
                </h1>
                <table class="table">
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
                            <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
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
    </div>
@endsection
