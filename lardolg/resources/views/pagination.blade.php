


  @extends('layouts.navbar')


@section('content')

<div class="container">
  <table class="table">

<thead class="thead-dark">
  <tr> 
  <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">E-mail</th>
    
  </tr>
</thead>
<tbody>
@foreach($users as $user)
  <tr>
  <td>{{$user->id}}</td>
     <td>{{$user->name}}</td>
     <td>{{$user->email}}</td>
     
  </tr>
  @endforeach
</tbody>
</table>
{{$users->links()}}
</div>
</main>
@endsection