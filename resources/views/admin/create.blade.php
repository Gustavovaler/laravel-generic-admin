@extends('admin.headers.header')

@section('content')
{{-- {{dd($data['products'])}} --}}
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-2">     
<form action="/admin/store/{{$table}}" method="POST">
    @csrf

    @foreach ($data as $item)
    @if ($item['name'] != 'id')
        @if($item['name'] == 'password')
            <label for="">{{$item['name']}}</label><br>
            <input type="password" name="{{$item['name']}}" class="form-control"
            @isset($item['max']) maxlength="{{$item['max']}}" @endisset><br>
        @else
            <label for="">{{$item['name']}}</label><br>
            <input type="@isset($item['type']){{$item['type']}}@endisset" name="{{$item['name']}}" class="form-control"
            @isset($item['max']) maxlength="{{$item['max']}}" @endisset><br>
        @endif        
    @endif
      

{{--         
        @endif  
            @if ($item['name'] == 'password')
                <label for="">{{$item['name']}}</label><br>
                <input type="@isset($item['type']){{$item['type']}}@endisset" name="{{$item['name']}}" class="form-control"
                @isset($item['max']) maxlength="{{$item['max']}}" @endisset><br>
            @endif
                <label for="">{{$item['name']}}</label><br>
                <input type="@isset($item['type']){{$item['type']}}@endisset" name="{{$item['name']}}" class="form-control"
                @isset($item['max']) maxlength="{{$item['max']}}" @endisset><br>  --}}
           
        
    @endforeach

    
    <div class="mt-2">
         <input type="submit" value="Guardar" class="btn btn-primary btn-block">
    </div>
   
</form>
</div>
</div>
</div>    
@endsection