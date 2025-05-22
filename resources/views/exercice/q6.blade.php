@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Dépôts ayant une valeur supérieure à celle du dépôt de 'Lind-Gislason' total : {{ $totalS }}</h3>
    <ul class="list-group">
        @foreach($stores as $store)
            <li class="list-group-item">
                <strong>Store ID:</strong> {{ $store->store_id }} |
                <strong>Total Value:</strong> ${{ number_format($store->total_value, 2) }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
