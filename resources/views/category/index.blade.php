@extends('layouts.app')

@section('title')
    Categories
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
          @if(count($categories)> 0)
                <table class="table table-bordered">
                   <thead class="thead-light">
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                   </tr>
                   </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
              <h5>No category found</h5>
            @endif
        </div>
    </div>
@endsection
