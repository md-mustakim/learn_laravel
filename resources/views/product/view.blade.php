@extends('layouts.theme')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header card-header-success">
                <div class="d-flex justify-content-between align-items-center card-title">
                    <div class="font-weight-bold font-lora card-title h4">Product List</div>
                    <a href="{{route('product.create')}}" class="float-right"> <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="font-weight-bold alert-success alert">
                        {{ Session::get('message') }}
                    </p>
                @endif
                @if(count($products) > 0)
                    <table class="table table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    <a href="{{ route('product.show', $product->id) }}">{{$product->name}}</a>
                                </td>
                                <td>{{$product->details}}</td>
                                <td>{{ count($product->rating) }} <i class="fa fa-user"></i></td>
                                <td>{{ number_format($product->rating->sum('score')/count($product->rating), 1) }} <i class="fa fa-star text-success"></i></td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('product.show', $product->id)}}" class="text-decoration-none  mx-2" title="View Product">
                                        <i class="fa fa-eye"> </i>
                                    </a>
                                    <a href="{{route('product.edit', $product->id)}}" class="text-decoration-none  mx-2" title="Edit Product">
                                        <i class="fa fa-edit"> </i>
                                    </a>

                                    <span onclick="deleteItem()">
                                   <i class="fa fa-trash"> </i>
                               </span>
                                    <form class="d-none" action="{{route('product.destroy', $product->id)}}" method="post" id="deleteProduct">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">No Product Found</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function deleteItem() {
            if (confirm('Are you Sure?')){
                document.getElementById('deleteProduct').submit();
            }
        }
    </script>
@endpush
