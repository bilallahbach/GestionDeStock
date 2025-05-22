@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Valeur de chaque dépôt</h3>
    <ul class="list-group">
        @foreach($values as $val)
            <li class="list-group-item">
                <strong>Store ID:</strong> {{ $val->store_id }} |
                <strong>Total Value:</strong> ${{ number_format($val->total_value, 2) }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
