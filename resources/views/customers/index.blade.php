@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">List of Customers</h2>
    <a href="{{route('customers.create')}}" class="btn btn-success" name="">Ajouter un Customer</a>
    <form action="{{ route('customers.search') }}" method="GET">
        <input type="text" name="search" id="search" class="form-control mt-3 mb-3" placeholder="Search by first name">
        <button type="submit" hidden>Search</button>
    </form>
</div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $cc)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cc->first_name }}</td>
                    <td>{{ $cc->last_name }}</td>
                    <td>{{ $cc->email }}</td>
                    <td>{{ $cc->address }}</td>
                    <td>{{ $cc->phone }}</td>
                    <td> <div>
                <a href="{{ route('customers.edit', $cc) }}" class="btn btn-primary">Modifier</a>
                <form action="{{ route('customers.destroy', $cc) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet customer?')">Supprimer</button>
                </form>
            </div></td>
                </tr>
                
                

        </div>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection