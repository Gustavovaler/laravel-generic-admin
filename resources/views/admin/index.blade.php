@extends('admin.headers.header')

@section('content')
    <div class="container mt-5">
     <h3>Models</h3>
     <ul>
     @foreach ($models as $item => $value)
     <li><a href="/admin/{{$value}}">{{$value}}</a></li>
     @endforeach  
     </ul>
</div>
@endsection




