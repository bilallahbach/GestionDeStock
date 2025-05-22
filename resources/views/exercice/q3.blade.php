@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Produits stockés dans les mêmes dépôts que ceux fournis par 'Scottie Crona'</h3>
    <ul class="list-group">
        @foreach($stocks as $stock)
            <li class="list-group-item">
                <strong>Store ID:</strong> {{ $stock->store_id }} |
                <strong>Product:</strong> {{ $stock->product->name }} |
                <strong>Quantity:</strong> {{ $stock->quantity_stock }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
