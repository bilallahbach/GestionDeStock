<div class="mb-3">
    <h3>Customer Orders</h3>
</div>
<div class="list-group">
    @foreach ($orders as $order)
        <a href="#" class="list-group-item list-group-item-action" onclick="loadOrderDetails({{ $order['id'] }})">
            Order #{{ $order['id'] }} - {{ $order['created_at'] }}
        </a>
    @endforeach
</div>
