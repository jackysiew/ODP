<div class="sidebar" data-color="yellow">
    <div class="logo text-center">
      <a href="{{url('designer')}}" class="simple-text logo-normal">
        Online Designer Platform
      </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
      <li class="{{ 'designer' == request()->path() ? 'active' : ''}}">
          <a href="{{url('designer')}}">
            <i class="now-ui-icons design_app"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="{{ 'orders' == request()->path() ? 'active' : ''}}">
          <a href="{{url('orders')}}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>My Orders</p>
          </a>
        </li>
        <li class="{{ 'tasks' == request()->path() ? 'active' : ''}}">
          <a href="{{url('tasks')}}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>My Request Tasks</p>
          </a>
        </li>
        <li class="{{ 'products' == request()->path() ? 'active' : ''}}">
          <a href="{{url('products')}}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>My Portfolio</p>
          </a>
        </li>        
        <li class="{{ 'profile' == request()->path() ? 'active' : ''}}">
          <a href="{{url('profile')}}">
            <i class="now-ui-icons users_single-02"></i>
            <p>My Profile</p>
          </a>
        </li>
        <li class="{{ 'users' == request()->path() ? 'active' : ''}}">
          <a href="{{url('users')}}">
            <i class="fa fa-users"></i>
            <p>Chatting Room</p>
          </a>
        </li>
        <li class="active-pro">
          <a href="./upgrade.html">
            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
            <p>Upgrade to PRO</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
