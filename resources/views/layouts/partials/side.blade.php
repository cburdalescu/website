<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href=" {{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>{{ config('app.name', 'Laravel') }}</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ url('images')  }}/img.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>{{ Auth::user()->name }}</h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Calendar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href=" {{ route('calendar.index')  }} ">List Events</a></li>
                        <li><a href="{{ route('calendar.create')  }}">Add new event</a></li>
                        <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="right" title="Logout" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">Logout
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <!-- /menu footer buttons -->
</div>