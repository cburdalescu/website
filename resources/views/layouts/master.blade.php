<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.partials.header')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">

            @include('layouts.partials.side')

        </div>

        <!-- top navigation -->

            @include('layouts.partials.topnav')

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

            @yield('content')


        </div>

        <!-- /page content -->

        <!-- footer content -->
       @include('layouts.partials.footer')

    </div>
</div>

@include('layouts.partials.scripts')




</body>
</html>
