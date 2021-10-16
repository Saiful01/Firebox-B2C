<div class="dropdown-menu" style="">
    @if($product->status == 'Pending')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/1">Accepted
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/2">Ready
            For Pick
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/5">Returned
        </a>
    @elseif($product->status == 'Accepted')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/2">Ready
            For Pick
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/5">Returned
        </a>
    @elseif($product->status == 'Ready For Pickup')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/5">Returned
        </a>
    @elseif($product->status == 'On The Way')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/5">Returned
        </a>
 {{--   @elseif($product->status == 'Delivered')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/4">Delivered
        </a>

    @else
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$product->order_item_id}}/5">Returned
        </a>--}}
    @endif
</div>
