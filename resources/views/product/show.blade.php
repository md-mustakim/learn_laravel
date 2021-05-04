@extends('layouts.app')
@section('title')
    @if(count(array($productData)) > 0)
        {{ $productData->name }} |
        @endif
{{--    how show title with product name--}}
@endsection
@section('content')
    <div class="d-flex justify-content-center py-5">
        <div class="">
            @if(count(array($productData)) > 0)
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('images/'.$productData->image)}}" alt="image" style="width: 500px; height: 300px;">
                    </div>
                    <div class="card-body my-2">
                        <div class="py-4">
                            <div class="card-text">
                                Name:    <b>{{ $productData->name }}</b>
                            </div>
                            <div class="card-text my-2">
                                Details <b>{{ $productData->details }}</b>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 d-flex flex-column border align-items-center">
                                <h1>{{ $rating->rating }}</h1>
                                <div class="">
                                    @php
                                        $halfPrint = true;
                                    @endphp
                                    @for($i = 0; $i< 5; $i++)
                                        @if($i < floor($rating->rating))
                                            <i class="fa fa-star text-success"></i>
                                        @else
                                            @if($rating->fraction && $halfPrint)
                                                <i class="fa fa-star-half-alt text-success"></i>
                                                @php
                                                    $halfPrint = false;
                                                @endphp
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                                <div class="">
                                    <span>Total <i class="fa fa-user-alt"></i>  {{ $rating->count}} Person</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="progress mb-2">
                                  <div class="progress-bar w-100" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <div class="progress mb-2">
                                    <div class="progress-bar w-50" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <div class="progress mb-2">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <div class="progress mb-2">
                                    <div class="progress-bar w-25" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                            </div>

                        </div>
                        @auth
                            @if(!$rating->status)
                                <div class="">
                                    <form action="{{ route('review.store') }}" method="POST">
                                        @csrf
                                        <div class="my-4">
                                            <p class="h3">Rate this Product</p>
                                            <div class="">
                                                <input type="radio" name="score" id="one" value="1">
                                                <label for="one">
                                                    <i class="fa fa-star text-success"></i>
                                                </label>
                                            </div>
                                            <div class="">
                                                <input type="radio" name="score" id="two" value="2">
                                                <label for="two">
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                </label>
                                            </div>
                                            <div class="">
                                                <input type="radio" name="score" id="three" value="3">
                                                <label for="three">
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                </label>
                                            </div>
                                            <div class="">
                                                <input type="radio" name="score" id="four" value="4">
                                                <label for="four">
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                </label>
                                            </div>
                                            <div class="">
                                                <input type="radio" name="score" id="five" value="5">
                                                <label for="five">
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                    <i class="fa fa-star text-success"></i>
                                                </label>
                                            </div>


                                        </div>
                                        <div class="">
                                            <input type="text"
                                                   name="title"
                                                   aria-label="title"
                                                   placeholder="Title (Required)"
                                                   class="form-control @error('title') is-invalid @enderror">
                                            @error('title')
                                            <p class="fw-bold text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                    <textarea
                                        name="details"
                                        class="form-control"
                                        id="details"
                                        cols="30"
                                        rows="10"
                                        aria-label="details"
                                        placeholder="Details About this product (optional)"
                                    ></textarea>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $productData->id }}">
                                        <div class="my-2">
                                            <button class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="h2 text-center my-5">
                                    Thank you for rating
                                </div>
                            @endif
                        @endauth

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
