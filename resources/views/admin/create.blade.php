@extends('admin.headers.header')

@section('content')
{{-- {{dd($data['products'])}} --}}
<div class="container mt-5">
<form action="/admin/store/{{$table}}" method="POST">
    @csrf
    @foreach ($data[$table] as $item)
    
        @foreach ($item as $data => $value)
            @if ($data == 'Field')
                <label for="" class="">{{$value}}</label><br>
            @endif    
            @if ($data == 'Type')
                @if ($value == 'varchar(191)')
                    <input type="text" class="form-control">
                @endif
                @if ($value == 'int(11)')
                <input type="number" class="form-control">
                @endif
                @if ($value == 'timestamp')
                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                @endif
            @endif           
            
            {{-- @if (substr($value,0,7) === 'varchar')
                
            @endif --}}
        
            {{-- {{$data}} -- {{$value}} --}}
        @endforeach
    
    @endforeach
    <input type="submit" value="Guardar" class="btn btn-primary btn-block">
</form>
</div>    
@endsection