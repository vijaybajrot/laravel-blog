<div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                  <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                  
                  <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pages <span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('admin-panel.page.create') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Page</a></li>
                    <li><a href="{{ route('admin-panel.page.index') }}"><i class="fa fa-th-list"></i>&nbsp;&nbsp;All Pages</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Posts <span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('admin-panel.post.create') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Post</a></li>
                    <li><a href="{{ route('admin-panel.post.index') }}"><i class="fa fa-th-list"></i>&nbsp;&nbsp;All Posts</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('admin-panel.category.create') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Category</a></li>
                    <li><a href="{{ route('admin-panel.category.index') }}"><i class="fa fa-th-list"></i>&nbsp;&nbsp;All Categories</a></li>
                    </ul>
                </li>

                 <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User Roles <span class="caret"></span></a>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('admin-panel.role.create') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Role</a></li>
                    <li><a href="{{ route('admin-panel.role.index') }}"><i class="fa fa-th-list"></i>&nbsp;&nbsp;Manage Roles</a></li>
                     <li><a href="{{ route('admin.assign-roles') }}"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Assign Roles</a></li>
                    </ul>
                </li>
                
                </ul>

                

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin-logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>