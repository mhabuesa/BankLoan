@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header text-center text-white bg-dark">
                    <h3>User Info Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Photo</th>
                            <td>
                                <img width="100px" src="{{asset('uploads')}}/user/{{$user->photo}}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                <h5>{{$user->name}}</h5>
                            </td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>
                                <h5>{{$user->phone}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <h5>{{$user->email}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                <h5>{{$user->address}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <th>NID Number</th>
                            <td>
                                <h5>{{$user->nid}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Date Of Birth</th>
                            <td>
                                <h5>{{$user->dob}}</h5>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection