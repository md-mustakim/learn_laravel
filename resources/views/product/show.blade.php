@extends('layouts.app')
@section('title')
    @if(count(array($productData)) > 0)
        {{ $productData->name }}
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
                        <div class="pt-1 pb-3">
                            <div class="card-text">
                                Name:    <span class="font-weight-bold h4">{{ $productData->name }}</span>
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
                                @for($s=1; $s <6; $s++)
                                    <div class="progress mb-2">
                                        <div class="progress-bar" style="width: {{$s * 10}}px" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>
                                    </div>
                                @endfor
                            </div>

                        </div>
                        @guest
                            <div class="h2 my-5">Please <a href="{{ route('user.login') }}">login</a> for rate this product</div>
                        @endguest
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
                        <div class="">
                            <div class="">
                                @foreach($productData->rating as $item)
                                    <div class="border my-4 p-3">
                                        <div class="my-1">
                                            <span class="h3 font-weight-bold font-lora">{{ $item->user->name }}</span>
                                        </div>
                                        <div class="">
                                            @php
                                                $star = 1;
                                            @endphp
                                            @for($i = 0; $i<5; $i++)
                                               @if($i < $item->score)
                                                   <i class="fa fa-star text-success"></i>
                                                @else
                                                   <i class="far fa-star text-success"></i>
                                               @endif
                                            @endfor
                                        </div>
                                        <div class="">
                                           <span class="h5"> {{ $item->title }}</span>
                                        </div>
                                        <div class="">
                                            {{ $item->details }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
