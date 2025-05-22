@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Liste des fournisseurs ayant livré les produits commandés par 'Annabel Stehr'</h3>
    <ul class="list-group">
        @foreach($suppliers as $supplier)
            <li class="list-group-item">
                <strong>Supplier:</strong> {{ $supplier->first_name }} {{ $supplier->last_name }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
