<div  style="">
{{--    @if($result->status == null )
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/1">Accepted
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/2">Ready
            For Pick
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
        </a>
    @else--}}@if($result->status == 'Pending' )
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/1">Accepted
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/2">Ready
            For Pick
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
        </a>
    @elseif($result->status == 'Accepted')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/2">Ready
            For Pick
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
        </a>
    @elseif($result->status == 'Ready For Pickup')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/3">On
            The Way
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
        </a>
    @elseif($result->status == 'On The Way')
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
        </a>
        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
           href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
        </a>
        {{--   @elseif($result->status == 'Delivered')
               <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                  href="/admin/order-status/update/{{$result->order_invoice}}/4">Delivered
               </a>

           @else
               <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                  href="/admin/order-status/update/{{$result->order_invoice}}/5">Returned
               </a>--}}
    @endif
</div>
