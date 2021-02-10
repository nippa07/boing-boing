<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item {{$active_url=='admin.index'?'active':''}}">
                    <a href="{{route('admin.index')}}">
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
                <li class="nav-item
                    {{in_array($active_url, ['admin.custom.offer.all', 'admin.custom.offer.view'])?'active':''}}">
                    <a href="{{route('admin.custom.offer.all')}}">
                        <i class="flaticon-coins"></i>
                        <p>Custom Offer Requests</p>
                    </a>
                </li>
                <li
                    class="nav-item
                    {{in_array($active_url, ['admin.offer.quote.all', 'admin.offer.quote.add', 'admin.offer.quote.view', 'admin.offer.quote.edit'])?'active':''}}">
                    <a href="{{route('admin.offer.quote.all')}}">
                        <i class="fas fa-receipt"></i>
                        <p>Offer Quotes</p>
                    </a>
                </li>
                <li
                    class="nav-item
                    {{in_array($active_url, ['admin.orders.all', 'admin.orders.add', 'admin.orders.view', 'admin.orders.edit'])?'active':''}}">
                    <a href="{{route('admin.orders.all')}}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
