<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ url('/') }}/images/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      <small>@if(Auth::user()->level == 1)
        Administrator
      @elseif(Auth::user()->level == 2)
        Manager
      @elseif(Auth::user()->level == 3)
        Reservation
      @elseif(Auth::user()->level == 4)
        Reservation Admin
      @elseif(Auth::user()->level == 5)
        Kitchen
      @endif</small>
    </div>
  </div>
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ Route::currentRouteNamed('dashboard') ? 'active' : ''}}">
      <a href="{{ url('hurricanesmenu/dashboard')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    @if ((Auth::user()->level == 1) || (Auth::user()->level == 2) || (Auth::user()->level == 5))
    <li class="treeview {{ Route::currentRouteNamed('menu.category') ? 'active' : '' }}{{ Route::currentRouteNamed('menu.ingredients') ? 'active' : '' }}{{ Route::currentRouteNamed('menu.menus') ? 'active' : '' }}{{ Route::currentRouteNamed('menu.menusShow') ? 'active' : ''}}">
      <a href="#">
        <i class="fa fa-spoon"></i>
        <span>Menu Management</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="{{ Route::currentRouteNamed('menu.category') ? 'active' : '' }}"><a href="{{ route('menu.category') }}"><i class="fa fa-circle-o"></i> Category</a></li>
        <li class="{{ Route::currentRouteNamed('menu.menus') ? 'active' : '' }}{{ Route::currentRouteNamed('menu.menusShow') ? 'active' : ''}}"><a href="{{ route('menu.menus') }}"><i class="fa fa-circle-o"></i> Menu</a></li>
        <li class="{{ Route::currentRouteNamed('menu.ingredients') ? 'active' : ''}}"><a href="{{ route('menu.ingredients') }}"><i class="fa fa-circle-o"></i> Ingredients</a></li>
      </ul>
    </li>
    @endif
    @if ((Auth::user()->level == 1) || (Auth::user()->level == 2) || (Auth::user()->level == 3) || (Auth::user()->level == 4))
    <li class="treeview {{ Route::currentRouteNamed('reservation.payment') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.block') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.cancel') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.create') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.bind') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.paymentsearch') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.search') ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-edit"></i>
        <span>Reservation Management</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="{{ Route::currentRouteNamed('reservation') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.search') ? 'active' : '' }}"><a href="{{ route('reservation') }}"><i class="fa fa-circle-o"></i> Reservation List</a></li>
        <li class="{{ Route::currentRouteNamed('reservation.cancel') ? 'active' : '' }}"><a href="{{ route('reservation.cancel') }}"><i class="fa fa-circle-o"></i> Reservation Cancelled</a></li>
        <li class="{{ Route::currentRouteNamed('reservation.block') ? 'active' : '' }}"><a href="{{ route('reservation.block') }}"><i class="fa fa-circle-o"></i> Reservation Block</a></li>
        <li class="{{ Route::currentRouteNamed('reservation.payment') ? 'active' : '' }}{{ Route::currentRouteNamed('reservation.paymentsearch') ? 'active' : '' }}"><a href="{{ route('reservation.payment') }}"><i class="fa fa-circle-o"></i> Group Booking Payment</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> Reservation Report</a></li>
      </ul>
    </li>
    @endif
    @if ((Auth::user()->level == 1) || (Auth::user()->level == 2))
    <li class="{{ Route::currentRouteNamed('branch') ? 'active' : '' }}{{ Route::currentRouteNamed('branch.view') ? 'active' : '' }}">
      <a href="{{ route('branch') }}">
        <i class="fa fa-laptop"></i><span>Branch Management</span>
      </a>
    </li>
    @endif
    @if ((Auth::user()->level == 1) || (Auth::user()->level == 2))
    <li class="treeview {{ Route::currentRouteNamed('account') ? 'active' : '' }}{{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Account Management</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="{{ Route::currentRouteNamed('account') ? 'active' : '' }}"><a href="{{ route('account') }}"><i class="fa fa-circle-o"></i> <span>Create Account</span></a></li>
        <li class="{{ Route::currentRouteNamed('profile') ? 'active' : '' }}"><a href="{{ route('profile') }}"><i class="fa fa-circle-o"></i> <span>Profile</span></a></li>
      </ul>
    </li>
    @endif
  </ul>
</section>
