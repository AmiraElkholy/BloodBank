 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link text-center" >
           <i class="fas fa-tint"></i> 
      <span class="brand-text font-weight-light">BloodBank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      @if (Auth::user())
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
                {{Auth::user()->name}}
          </a>
        </div>
      </div>
      @endif


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('governorates.index')}}" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>Governorates</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('cities.index')}}" class="nav-link">
              <i class="nav-icon fas fa-flag"></i>
              <p>Cities</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('posts.index')}}" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>Posts</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('clients.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Clients</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('contact-messages.index')}}" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Contact Messages</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('donation-requests.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tint"></i>
              <p>Donation Requests</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('settings.index')}}" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>App Settings</p>
            </a>
          </li>
      
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Users & Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('roles.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>Roles</p>
                  </a>
                </li>
            </ul>
          </li>    

          <li class="nav-item">
            <a href="{{route('users.editPassword')}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>Reset Password</p>
            </a>
          </li>
      


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>