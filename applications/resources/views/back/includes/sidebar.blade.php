<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ url('/') }}/images/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>
        {{ Auth::user()->name }}
      </p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{ url('hurricanesmenu/dashboard')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Menu 1</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> -----</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> -----</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-edit"></i>
        <span>Reservation Management</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('reservation') }}"><i class="fa fa-circle-o"></i> Reservation List</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> Reservation Cancelled</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> Reservation Block</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> Group Booking Payment</a></li>
        <li><a href="{{ url('hurricanesmenu/dashboard')}}"><i class="fa fa-circle-o"></i> Reservation Report</a></li>
      </ul>
    </li>
    <li class="{{ Route::currentRouteNamed('branch') ? 'active' : '' }}{{ Route::currentRouteNamed('branch.view') ? 'active' : '' }}">
      <a href="{{ route('branch') }}">
        <i class="fa fa-laptop"></i><span>Branch Management</span>
      </a>
    </li>
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
  </ul>
</section>
