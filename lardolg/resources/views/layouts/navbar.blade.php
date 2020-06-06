<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/jquery.js')}}"></script>
	<script src="{{ asset('js/navbar.js')}}"></script>
	
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('css/style.css')}}">
	
	
</head>
<body>
<aside class="sidebar">
	<div class="sidebar-node">
		<ul class="sidebar-list">
			<li><a href="{{ asset('home')}}"><i class="fas fa-user"></i> Профиль</a></li>
		</ul>
	</div>
	<div class="sidebar-node">
		<p class="text-muted sidebar-header"></p>
		<ul class="sidebar-list">
			@if (Auth::user()->typeAdmin==2)		
					<li>
						<a href="{{ asset('journal')}}"><i class="fas fa-columns">
							</i> Журнал
						</a>
					</li>
			@endif
				
			@if((Auth::user()->typeAdmin != 1))
					<li>
						<a href="{{ asset('alerts')}}"><i class="fas fa-mail-bulk">
							</i> Задолжности
						</a>
					</li>
			@endif
			@if((Auth::user()->typeAdmin != 3)&&(Auth::user()->typeAdmin!=4))
					<li>
						<a href="{{ asset('tests')}}"><i class="fas fa-question">
							</i> Тесты
						</a>
					</li>
			@endif
					<li>
						<a href="{{ asset('materials')}}"><i class="fas fa-book">
							</i> Материалы
						</a>
					</li>
				
					<li>
						<a href="{{ asset('additional')}}"><i class="fas fa-calendar">
							</i> Дополнительные занятия
						</a>
					</li>
		
			@if(Auth::user()->typeAdmin == 1)
					<li>
						<a href="{{ asset('adminpanel')}}"><i class="fas fa-cog">
							</i> Панель администрации
						</a>
					</li>
			@endif
			</ul>
			
					
		
</aside>
			<div class="wrapper main">
				<header>
					<nav class="navbar">
						<div class="navbar-bars">
							<i class="fas fa-bars hide-sidebar"></i>
						</div>
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
	@yield('modal')
</body>
</html>