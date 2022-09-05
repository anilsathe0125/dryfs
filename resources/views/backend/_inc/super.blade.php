<!-- SidebarSearch Form -->
<div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
            <a href="{{ route('backend.dashboard') }}" class="nav-link {{ !request()->input('type') && request()->is('admin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>{{ __('Dashboard') }}</p>
            </a>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'category' || request()->segment(2) == 'subcategory' || request()->segment(2) == 'childcategory' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'category' || request()->segment(2) == 'subcategory' || request()->segment(2) == 'childcategory' ? 'active' : '' }}">
          <i class="nav-icon fas fa-list-alt"></i>
          <p>
            {{ __('Manage Categories') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.category.index') }}" class="nav-link {{ request()->segment(2) == 'category' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Categories') }}</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'brand' || (request()->segment(2) == 'item' && request()->segment(3) == 'add') || (request()->segment(2) == 'item' && request()->segment(3) == 'create') || (request()->segment(2) == 'item' && request()->segment(3) == '') || (request()->segment(2) == 'digital' && request()->segment(3) == 'create') || (request()->segment(2) == 'license' && request()->segment(3) == 'create') || request()->segment(2) == 'campaign' || request()->segment(2) == 'bulk' || request()->segment(2) == 'review' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'brand' || (request()->segment(2) == 'item' && request()->segment(3) == 'add') || (request()->segment(2) == 'item' && request()->segment(3) == 'create') || (request()->segment(2) == 'item' && request()->segment(3) == '') || (request()->segment(2) == 'digital' && request()->segment(3) == 'create') || (request()->segment(2) == 'license' && request()->segment(3) == 'create') || request()->segment(2) == 'campaign' || request()->segment(2) == 'bulk' || request()->segment(2) == 'review' ? 'active' : '' }}">
          <i class="nav-icon fab fa-product-hunt"></i>
          <p>
            {{ __('Manage Products') }}
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.item.add') }}" class="nav-link {{ (request()->segment(2) == 'item' && request()->segment(3) == 'add') || (request()->segment(2) == 'item' && request()->segment(3) == 'create') || (request()->segment(2) == 'digital' && request()->segment(3) == 'create') || (request()->segment(2) == 'license' && request()->segment(3) == 'create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Add Product') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.item.index') }}" class="nav-link {{ request()->segment(2) == 'item' && request()->segment(3) == '' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('All Products') }}</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'orders' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'orders' ? 'active' : '' }}">
          <i class="nav-icon fab fa-first-order"></i>
          <p>
            {{ __('Manage Orders') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.order.index') }}" class="nav-link {{ !request()->input('type') && request()->is('admin/orders') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('All Orders') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.order.index', 'type=Pending') }}" class="nav-link {{ request()->input('type') == 'Pending' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Pending Orders') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.order.index', 'type=In Progress') }}" class="nav-link {{ request()->input('type') == 'In Progress' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Progress Orders') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.order.index', 'type=Delivered') }}" class="nav-link {{ request()->input('type') == 'Delivered' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Delivered Orders') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("backend.order.index", 'type=Canceled') }}" class="nav-link {{ request()->input('type') == 'Canceled' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Canceled Orders') }}</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ route('backend.transaction.index') }}" class="nav-link {{ request()->segment(2) == 'transaction' ? 'active' : '' }}">
        <i class="nav-icon fas fa-random"></i>
        <p>{{ __('Transactions') }}</p>
        </a>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'code' || request()->segment(2) == 'shipping' || request()->segment(2) == 'tax' || request()->segment(2) == 'currency' || (request()->segment(2) == 'setting' && request()->segment(3) == 'payment') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'code' || request()->segment(2) == 'shipping' || request()->segment(2) == 'tax' || request()->segment(2) == 'currency' || (request()->segment(2) == 'setting' && request()->segment(3) == 'payment') ? 'active' : '' }}">
          <i class="nav-icon fas fa-newspaper"></i>
          <p>
            {{ __('Ecommerce') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.shipping.index') }}" class="nav-link {{ request()->segment(2) == 'shipping' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Shipping') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.tax.index') }}" class="nav-link {{ request()->segment(2) == 'tax' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Tax') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.setting.payment') }}" class="nav-link {{ (request()->segment(2) == 'setting' && request()->segment(3) == 'payment') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Payment') }}</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ route('backend.user.index') }}" class="nav-link {{ request()->segment(2) == 'user' ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>{{ __('Customer List') }}</p>
        </a>
      </li>


      <li class="nav-item  {{ request()->segment(3) == 'system' || request()->segment(2) == 'homepage' || request()->segment(2) == 'slider' || request()->segment(2) == 'service' || request()->segment(3) == 'section' || request()->segment(3) == 'social' || request()->segment(3) == 'email'  || request()->segment(3) == 'configuration' || request()->segment(2) == 'announcement' || request()->segment(2) == 'maintenance' || request()->segment(2) == 'sitemap' || request()->segment(2) == 'language' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(3) == 'system' || request()->segment(2) == 'homepage' || request()->segment(2) == 'slider' || request()->segment(2) == 'service' || request()->segment(3) == 'section' || request()->segment(3) == 'social' || request()->segment(3) == 'email'  || request()->segment(3) == 'configuration' || request()->segment(2) == 'announcement' || request()->segment(2) == 'maintenance' || request()->segment(2) == 'sitemap' || request()->segment(2) == 'language' ? 'active' : '' }}">
          <i class="nav-icon fas fa-tasks"></i>
          <p>
            {{ __('Manage Site') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.slider.index') }}" class="nav-link {{ request()->segment(2) == 'slider' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Sliders') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.service.index') }}" class="nav-link {{ request()->segment(2) == 'service' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Services') }}</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('backend.setting.email') }}" class="nav-link {{ request()->segment(3) == 'email' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Email Settings') }}</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('backend.setting.announcement') }}" class="nav-link {{ request()->segment(2) == 'announcement' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Announcement') }}</p>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'fcategory' || request()->segment(2) == 'faq' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'fcategory' || request()->segment(2) == 'faq' ? 'active' : '' }}">
          <i class="nav-icon fas fa-question-circle"></i>
          <p>
            {{ __('Manage Faqs') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.fcategory.index') }}" class="nav-link {{ request()->segment(2) == 'fcategory' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Categories') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.faq.index') }}" class="nav-link {{ request()->segment(2) == 'faq' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Faqs') }}</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ request()->segment(2) == 'role' || request()->segment(2) == 'staff' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'role' || request()->segment(2) == 'staff' ? 'active' : '' }}">
          <i class="nav-icon far fa-user"></i>
          <p>
            {{ __('System User') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend.role.index') }}" class="nav-link {{ request()->segment(2) == 'role' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('Role') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.staff.index') }}" class="nav-link {{ request()->segment(2) == 'staff' ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>{{ __('System User') }}</p>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
