@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Nombre de produits par dépôt</h3>
    <ul class="list-group">
        @foreach($stockCounts as $stock)
            <li class="list-group-item">
                <strong>Store ID:</strong> {{ $stock->name }} |
                <strong>Total Stocks:</strong> {{ $stock->total }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
