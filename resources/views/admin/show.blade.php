@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                  @foreach ($fields as $field)
                      <th scope="col">{{$field}}</th>
                  @endforeach 
                  <th scope="col">Actions</th>              
              </tr>
            </thead>
            <tbody>              
                  @foreach ($data as $item)
                    <tr>
                       @foreach ($fields as $field)
                           <td>{{$item->$field}}</td>
                       @endforeach 
                       <td>
                           <form action="/admin/{{$model}}/{{$item->id}}" method="POST">
                               @csrf
                              <input type="submit" class="btn btn-danger mb-1" value="Delete">
                           </form>
                           
                           <a href="" class="btn btn-secondary">Update</a></td>             
                    </tr>
                  @endforeach   
             
            </tbody>
          </table>

          <div class="container">
              <a href="/admin/{{$model}}/create" class="btn btn-primary">New record</a>
          </div>

</div>
    
@endsection