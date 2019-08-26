<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="{{'https://code.jquery.com/jquery.js'}}"></script>
    <script src="{{'https://code.jquery.com/jquery-3.3.1.min.js'}}"></script>
    <script src="{{'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js'}}"></script>
    <script src="{{'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'}}"></script>
  
  <link href="{{ asset('gentella/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('gentella/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('gentella/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ asset('gentella/css/sweetalert2.min.css') }}" rel="stylesheet">

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Penitipan Barang</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('gentella/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{Auth::user()->role}}</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('dashboard1')}}"><span><i class="fa fa-laptop"></i> Dashboard</span></a>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Data Barang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('items')}}">Penitipan</a></li>
                      <li><a href="{{route('histories')}}">Riwayat Penitipan</a></li>
                    </ul>
                  </li>

                  <li><a href="{{route('user.index')}}"><span><i class="fa fa-users"></i> Users</span></a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('gentella/images/img.jpg')}}" alt="">{{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
          <!-- /page content -->
        </div>
        

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Admin Pages <a href="https://colorlib.com">example</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  </body>

   @yield('script')
    <!-- jQuery -->
    <script type="text/javascript">
      function berhasil(status, pesan) {
      Swal.fire({
        type: status,
        title: pesan,
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
  }

  function gagal(key, pesan) {
      Swal.fire({
        type: 'error',
        title:  key + ' : ' + pesan,
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
  }
  </script>
  <!-- <script src="{{ asset('gentella/js/jquery.min.js') }}"></script> -->
  <script src="{{ asset('gentella/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('gentella/js/date.js') }}"></script>
  <script src="{{ asset('gentella/js/custom.min.js') }}"></script>
  <script src="{{ asset('gentella/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('gentella/js/dataTables.bootstrap.min.js') }}"></script>

  <!-- sweet alert -->
  <script src="{{ asset('gentella/js/sweetalert2.all.min.js') }}"></script>
</html>