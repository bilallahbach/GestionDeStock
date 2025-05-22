<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customers Found</h3>
    <button class="btn btn-outline-secondary btn-sm" onclick="toggleCustomerList()">
        <i class="bi bi-list"></i> Toggle Customer List
    </button>
</div>
<div class="collapse show" id="customerListCollapse">
    <div class="list-group">
        @foreach ($customers as $customer)
            <a href="#" class="list-group-item list-group-item-action" onclick="loadCustomerOrders({{ $customer['id'] }})">
                {{ $customer['first_name'] }} {{ $customer['last_name'] }}
            </a>
        @endforeach
    </div>
</div>
