<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	

	<!-- Styles -->
	<link rel="stylesheet" href="css/style.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
</head>
<body>
<aside class="sidebar">
	<div class="sidebar-node">
		<ul class="sidebar-list">
			<li><a href="/home"><i class="fas fa-user"></i> Профиль</a></li>
			<li><a href="/"><i class="fas fa-globe-europe"></i> На сайт</a></li>
		</ul>
	</div>
	<div class="sidebar-node">
		<p class="text-muted sidebar-header"></p>
		<ul class="sidebar-list">
			@if (Auth::user()->typeAdmin==1)		
					<li>
						<a href="jornal"><i class="fas fa-columns">
							</i> Журнал
						</a>
					</li>
			@endif
				
			@if((Auth::user()->typeAdmin == 0)||(Auth::user()->typeAdmin==1))
					<li>
						<a href="zadol.php"><i class="fas fa-mail-bulk">
							</i> Задолжности
						</a>
					</li>
			@endif
			@if((Auth::user()->typeAdmin == 0)||(Auth::user()->typeAdmin==1))
					<li>
						<a href="tests.php"><i class="fas fa-question">
							</i> Тесты
						</a>
					</li>
			@endif
		</ul>
</aside>
			<div class="wrapper">
				<header>
					<nav class="navbar">
						<div class="navbar-user">
							{{ Auth::user()->name }}
						</div>
						<div class="navbar-logout">
							<a href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt" ></i> <span>Выйти</span></a>
						</div>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</nav>
				</header>
				<main>
				@yield('content')
				</main>
			</div>
		
	</div>

</body>
</html>