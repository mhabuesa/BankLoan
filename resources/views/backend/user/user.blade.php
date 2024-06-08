@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h3>User List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($users as $sl=> $user )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>
                                    <img width="40" height="40" class="rounded-circle" src="{{asset('uploads')}}/user/{{$user->photo}}" alt="Image">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>
                                    <a href="{{route('user.info',$user->id)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h3>Add User</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.user')}}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" name="phone" class="form-control" value="{{old('phone')}}">
                            @error('phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{old('address')}}">
                            @error('address')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nid" class="form-label">NID card Number</label>
                            <input type="number" name="nid" class="form-control" value="{{old('nid')}}">
                            @error('nid')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{old('dob')}}">
                            @error('dob')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="photo" class="form-label">Image</label>
                            <input class="form-control" type="file" name="photo" id="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img style="border-radius: 10px" class="mt-4" id="blah"  width="250" />
                        </div>



                        <div class="mb-3 d-flex justify-content-end">
                           <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')

    @if (session('created'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{session('created')}}"
            });

        </script>
    @endif

    @if (session('delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{session('delete')}}"
            });

        </script>
    @endif

@endpush