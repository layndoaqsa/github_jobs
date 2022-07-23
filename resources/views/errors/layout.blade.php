
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('titlepage',env('APP_NAME')) | @yield('subtitlepage','PJB PLTU Teluk Balikpapan')</title>
    <link rel="icon" type="image/png" href="{{asset('file/logo-2.png')}}"/>

	<!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="assets/js/app.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="{{route('home')}}" class="d-inline-block texh-white">
				<h5 class="text-white mb-0">{{env("APP_NAME_FULL")}}</h5>
			</a>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Container -->
				<div class="flex-fill">

					<!-- Error title -->
        		    @yield('content')
					<!-- /error title -->
                    <div class="message text-center" style="padding: 10px;">
        		    @yield('message')
                    </div>


					<!-- Error content -->
					<div class="row">
						<div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">

							<!-- Search -->
							<!-- <form action="#">
								<div class="input-group mb-3">
									<input type="text" class="form-control form-control-lg" placeholder="Search">

									<div class="input-group-append">
										<button type="submit" class="btn bg-slate-600 btn-icon btn-lg"><i class="icon-search4"></i></button>
									</div>
								</div>
							</form> -->
							<!-- /search -->


							<!-- Buttons -->
							<div class="row">
								<div class="col-sm-12">
									<a href="{{route('home')}}" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i> Dashboard</a>
								</div>

								<!-- <div class="col-sm-6">
									<a href="#" class="btn btn-light btn-block mt-3 mt-sm-0"><i class="icon-menu7 mr-2"></i> Advanced search</a>
								</div> -->
							</div>
							<!-- /buttons -->

						</div>
					</div>
					<!-- /error wrapper -->

				</div>
				<!-- /container -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-dark">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
			            &copy; {{\Carbon\Carbon::now()->format('Y')}} <b>{{env("APP_NAME_FULL")}}</b>
						<br>
						Layndo Safara Aqsa
                    </span>
                </div>
            </div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
