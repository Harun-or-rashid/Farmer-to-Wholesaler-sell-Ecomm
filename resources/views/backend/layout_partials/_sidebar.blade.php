<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!! route('backend.admin.dashboard') !!}" class="brand-link">
        <img src="{{ asset($system_website_information->favicon) }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $system_website_information->website_title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{!! asset('assets/backend/dist') !!}/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{!! route('backend.admin.profile.show') !!}" class="d-block">{!! \App\Helpers\CommonHelper::getAdminUserName() !!}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{!! route('backend.admin.dashboard') !!}" class="nav-link {!! ($common_data->main_menu == 'dashboard')?'active':'' !!}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Product</li>
                <li class="nav-item">
                    <a href="{!! route('backend.admin.product.category.index') !!}" class="nav-link {!! ($common_data->main_menu == 'product_category')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('backend.admin.product.color.index') !!}" class="nav-link  {!! ($common_data->main_menu == 'product_color')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Color</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('backend.admin.products.index') !!}" class="nav-link {!! ($common_data->main_menu == 'product')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('backend.admin.product.stock.create') !!}" class="nav-link {!! ($common_data->main_menu == 'product_quantity')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Product Stock</p>
                    </a>
                </li>

                <li class="nav-header">Orders</li>
                <li class="nav-item">
                    <a href="{{ route('backend.admin.order.pending-list') }}" class="nav-link {!! ($common_data->main_menu == 'pending_orders')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Pending Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.admin.order.accepted-list') }}" class="nav-link {!! ($common_data->main_menu == 'accepted_orders')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Accepted Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.admin.order.completed-list') }}" class="nav-link {!! ($common_data->main_menu == 'completed_orders')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Completed Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.admin.order.rejected-list') }}" class="nav-link {!! ($common_data->main_menu == 'rejected_orders')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Rejected Orders</p>
                    </a>
                </li>

                <li class="nav-header">Website Settings</li>
                <li class="nav-item">
                    <a href="{!! route('backend.admin.system-settings.show') !!}" class="nav-link {!! ($common_data->main_menu == 'system_settings')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>System Settings</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{!! route('backend.admin.page.about-us.show') !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{!! route('backend.admin.page.contact-us.show') !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">Users</li>

                <li class="nav-item">
                    <a href="{!! route('backend.admin.customer.list') !!}" class="nav-link {!! ($common_data->main_menu == 'customers')?'active':'' !!}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Customers</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
