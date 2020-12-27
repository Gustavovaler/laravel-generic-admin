@extends('layouts.app')
@section('content')
    <div class="container">
     <h3>Models</h3>
     <ul>
     @foreach ($models as $item => $value)
     <li><a href="/admin/{{$value}}">{{$value}}</a></li>
     @endforeach  
     </ul>
</div>
@endsection




