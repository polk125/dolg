@extends('layouts.navbar')

@section('content')
 <div class="profile"><h1>Профиль</h1>
 <h2>Вы авторизованы</h2>
 {{Auth::user()->name}}
</div>
@endsection
