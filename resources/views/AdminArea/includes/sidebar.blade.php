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
                    {{in_array($active_url, ['admin.custom.offer.all'])?'active':''}}">
                    <a href="{{route('admin.custom.offer.all')}}">
                        <i class="fas fa-user"></i>
                        <p>Custom Offer Requests</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
