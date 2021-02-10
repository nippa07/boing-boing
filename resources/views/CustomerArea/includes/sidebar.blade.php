<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item {{$active_url=='customer.index'?'active':''}}">
                    <a href="{{route('customer.index')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Functions</h4>
                </li>
                <li
                    class="nav-item
                    {{in_array($active_url, ['customer.orders.all', 'customer.orders.add', 'customer.orders.view', 'customer.orders.edit'])?'active':''}}">
                    <a href="{{route('customer.orders.all')}}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
