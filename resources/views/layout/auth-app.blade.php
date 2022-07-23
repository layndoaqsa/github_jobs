
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('titlepage',env('APP_NAME')) | @yield('subtitlepage',env("APP_NAME_FULL"))</title>
    <!-- <link rel="icon" type="image/png" href="{{asset('file/logo-2.png')}}"/> -->

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
	<script src="{{asset('global_assets/js/plugins/ui/ripple.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/js/app.js')}}"></script>
	<!-- /theme JS files -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@stack('after_script')
	<script>
		$(document).ready(function () {
			var alertSuccess = '{{session('alertSuccess')}}'
			if (alertSuccess) {
				swal(alertSuccess, {
					icon: "success",
					timer: 2000,
				});
			}

			var alertSuccess = '{{session('alertSuccessNoTimer')}}'
			if (alertSuccess) {
				swal(alertSuccess, {
					icon: "success",
					timer: false,
				});
			}

			var alertWarning = '{{session('alertWarning')}}'
			if (alertWarning) {
				swal(alertWarning, {
					icon: "warning",
					timer: false,
				});
			}

			var alertWarning = '{{session('alertWarningNoTimer')}}'
			if (alertWarning) {
				swal(alertWarning, {
					icon: "warning",
					timer: false,
				});
			}
			var alertWarning = '{{session('alertErrorNoTimer')}}'
			if (alertWarning) {
				swal(alertWarning, {
					icon: "error",
					timer: false,
				});
			}
			$('body').tooltip({selector: '[data-toggle="tooltip"]'});
		});
		function swallLoading() {
			window.swal({
				title: "Uploading...",
				text: "Please wait",
				imageUrl: "images/ajaxloader.gif",
				closeOnClickOutside: false,
				buttons: false,
			});
		}
	</script>

</head>

<body>

@yield('content')
	
@include('sweetalert::alert')
</body>
</html>
