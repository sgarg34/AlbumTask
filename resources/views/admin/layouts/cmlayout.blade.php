<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>{{ config('app.name', 'Album') }} Admin</title>
	<meta name="csrf-token" content="{!! csrf_token() !!}">
	<meta name="baseurl" content="{{url('')}}">
	<link href="{{asset('backend/css/all.min.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('backend/css/custom_style.css')}}" rel="stylesheet">
	<link href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>

<body class="bg-gradient-primary">
    @if(Auth::user())
	    @php
		$user = Auth::user();
		@endphp
	@endif
	@section('header')
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<!-- Sidebar - Brand -->
		
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Nav Item - Dashboard -->
			
			<!-- Divider -->
			<hr class="sidebar-divider">
			
			<li class="nav-item">
				<a class="nav-link" href="{{route('album.list')}}">	<i class="fa fa-id-card" aria-hidden="true"></i>
					<span>Album</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">
			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					    <i class="fa fa-bars"></i>
					</button>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Nav Item - Search Dropdown (Visible Only XS) -->
						<li class="nav-item dropdown no-arrow d-sm-none">
							<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <i class="fas fa-search fa-fw"></i>
							</a>
							<!-- Dropdown - Messages -->
							<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
								<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">	<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>
						<!-- Nav Item - Messages -->
						<div class="topbar-divider d-none d-sm-block"></div>
						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<span class="mr-2 d-none d-lg-inline text-gray-600 small captialize"> </span>
								
                                        <img class="img-profile rounded-circle" src="{{asset('backend/images/dummyprofile.jpg')}}">
    						</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							    <a class="dropdown-item text-center" href="javascript:void(0);">{{ $user->first_name.' '.$user->last_name}}<br><span style="font-size:12px;">Administrator</span></a>
								<div class="dropdown-divider"></div>
								<div class="dropdown-divider"></div>	
								<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
							</div>
						</li>
					</ul>
				</nav>
				<!-- End of Topbar -->@show @section('body') @show @section('footer')</div>
			<!-- End of Main Content -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">	<span>Copyright &copy; {{now()->year}}, {{ config('app.name', 'Album') }} Admin</span>
					</div>
				</div>
			</footer>
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">	<i class="fas fa-angle-up"></i>
	</a>
	<!-- End Change PassWord model -->@show
	<script>
		var baseurl = $('meta[name="baseurl"]').prop('content');
		var token = $('meta[name="csrf-token"]').prop('content');
	</script>
	<script src="{{asset('dist/js/lightbox-plus-jquery.min.js')}}"></script>
	<script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('backend/js/jquery.easing.min.js')}}"></script>
	<script src="{{asset('backend/js/script.js')}}"></script>
	<script src="{{asset('backend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script src="{{asset('backend/js/custom.js')}}"></script>
	
	@yield('scripts')
	<style>
		table.dataTable.nowrap td {
			white-space: normal !important;
		}
	</style>
	<script src="https://cdn.tiny.cloud/1/g2adjiwgk9zbu2xzir736ppgxzuciishwhkpnplf46rni4g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
selector: 'textarea.editor',
plugins: 'code',
toolbar: 'code',

content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
</body>

</html>