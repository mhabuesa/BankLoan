@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Bank List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Bank Name</th>
                            <th>Address</th>
                        </tr>
                        @foreach ($banks as $sl=> $bank )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$bank->bank_name}}</td>
                                <td>{{$bank->bank_address}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Bank</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('bank.store')}}" method="POST">
                        @csrf
                        <div class="mt-1">
                            <label for="name" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name">
                            @error('bank_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="name" class="form-label">Bank Address</label>
                            <input type="text" class="form-control" name="bank_address">
                            @error('bank_address')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    @if (session('insert'))
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
                title: "{{session('insert')}}"
            });

        </script>
    @endif

@endpush