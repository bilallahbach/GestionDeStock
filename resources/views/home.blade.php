@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="mb-4">@lang('Welcome to Stock Management System')</h1>
    <p>@lang('Manage your inventory and customers efficiently')</p>
    <a href="{{ route('customers.index') }}" class="btn btn-primary">List of Customers</a>
    <a href="{{ route('suppliers.index') }}" class="btn btn-success">List of Suppliers</a>
    <a href="{{ route('products.index') }}" class="btn btn-info">List of Products</a>
    <a href="/products-by-category" class="btn btn-warning">Products by Category</a>
    <a href="/supplierB" class="btn btn-secondary">Products by Supplier</a>
    <a href="/products-by-store" class="btn btn-dark">Products by Store</a>
    <a href="{{ route('orders.index') }}" class="btn btn-danger">Orders by Customer (JS) method</a>
    <a href="{{ route('orders.index2') }}" class="btn btn-danger">Orders by Customer (views) method</a>
    
</div>
<div class="container mt-5 text-center">
    <h1>Requetes elequoents</h1>
    <div>
        <a href="{{ route('q1') }}" class="btn btn-danger">Q1</a>
    <a href="{{ route('q2') }}" class="btn btn-danger">Q2</a>
    <a href="{{ route('q3') }}" class="btn btn-danger">Q3</a>
    <a href="{{ route('q4') }}" class="btn btn-danger">Q4</a>
    <a href="{{ route('q5') }}" class="btn btn-danger">Q5</a>
    <a href="{{ route('q6') }}" class="btn btn-danger">Q6</a>
    </div>
</div>
<div class="container mt-5 text-center">
    <h1>Cookies et Sessions et Image upload</h1><br><br>
    <form method="POST" action="saveCookie">
        @csrf
        <h1> Hello @if(Cookie::has("UserName")) {{Cookie::get("UserName")}} @endif
        </h1>
        <input type="text" id = "txtCookie" name = "txtCookie"><button> {{__('Save Cookie') }}</button>
    </form>
     <div>            <br><br>
            <div>
                <h1>
                    Hello
                    @if(Session::has("SessionName"))
                            {{Session("SessionName")}}
                    @endif
                </h1>
            </div>

            <div>
                <form method="POST" action="saveSession">
                    @csrf
                    <label for="txtSession">{{__('Type your name')}}</label>
                    <input type="text" id = "txSession" name = "txtSession" />
                    <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{__('Save Session') }}
                    </button>
                </form>
            </div>
    </div>
    <div><br><br>
        <form method="POST" action="saveAvatar"  enctype="multipart/form-data" >
            @csrf
            <label for="avatarFile">@lang('Choose your picture')</label>
            <input type="file" id = "avatarFile"  name = "avatarFile" />
            <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{__('Save picture') }} {{ trans("for your account") }}
            </button>

            <img style = "width:200px; border-radius:50%" src="{{"storage/avatars/".$pic}}" alt="img">
        </form>
    </div>
    </div>
</div>
@endsection
