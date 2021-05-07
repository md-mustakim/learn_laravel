@extends('layouts.theme')
@section('content')
    <div class="row m-0 p-0">
        <div class="col-md-6 mx-auto">
            <table class="table table-sm table-borderless">
                <tr>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Joined</td>
                    <td>{{date('d-M-Y', strtotime($user->created_at))}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
