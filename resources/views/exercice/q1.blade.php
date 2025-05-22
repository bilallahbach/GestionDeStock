@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Afficher le nom complet du client pour chaque commande</h3>
    <ul class="list-group">
        @foreach($orders as $order)
            <li class="list-group-item">
                <strong>Commande ID:</strong> {{ $order->id }} |
                <strong>Client:</strong> {{ $order->first_name }} {{ $order->last_name }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
