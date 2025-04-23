
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>TechFlow - CMS</title>

	<link href="/template/static/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		@include('layouts.app.menu')

		<div class="main">
            @include('layouts.app.navbar')

			<main class="content">
				<div class="container-fluid p-0">
                    @yield('content')
				</div>
			</main>

			@include('layouts.app.footer')
		</div>
	</div>
	@vite(["resources/js/plugins.js"])
	@vite(["resources/js/app.js"])
	<script src="/template/static/js/app.js"></script>

	@yield('js')

</body>

</html>