@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">List of Suppliers</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suppliers as $cc)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cc->first_name }}</td>
                    <td>{{ $cc->last_name }}</td>
                    <td>{{ $cc->email }}</td>
                    <td>{{ $cc->address }}</td>
                    <td>{{ $cc->phone }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection