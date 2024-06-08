@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Loan Holder List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Bank Name</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Duration</th>
                            <th>percentage</th>
                            <th>Total payable Amount</th>
                            <th>Monthly payable Amount</th>
                            <th>Address</th>
                        </tr>
                        {{-- @foreach ($loans as $sl=> $loan )
                            <tr>
                                <td>{{$sl+1}}</td>
                                @php
                                    $bank_name = App\Models\BankModel::where('id', $loan->bank_id)->get();
                                @endphp
                                <td>{{$bank_name->bank_name}}</td>
                                <td>{{$bank->bank_address}}</td>
                            </tr>
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Loan Entry</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('loan.store')}}" method="POST">
                        @csrf
                        <div class="mt-1">
                            <label for="name" class="form-label">Bank</label>
                            <select name="bank_id" id="" class="form-control">
                                <option value="">Select Bank</option>
                                @foreach ($banks as $bank )
                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach

                            </select>
                            @error('bank_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="mt-1">
                            <label for="name" class="form-label">User Name</label>
                            <select name="user_id" id="usernameSelect" class="form-control">
                                <option value="">Select User</option>
                                @foreach ($users as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach

                            </select>
                            @error('bank_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div id="userInfo" class="mt-3">
                            
                        </div>

                        <div class="mt-3">
                            <label for="name" class="form-label">Loan Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                        </div>

                        <div class="mt-3">
                            <label for="name" class="form-label">Loan Duration (in month)</label>
                            <input type="text" name="duration" class="form-control" id="duration">
                        </div>

                        <div class="mt-3">
                            <label for="name" class="form-label">Loan Percentage %</label>
                            <input type="text" name="percentage" class="form-control" id="percentage">
                        </div>

                        <div class="mt-3" >
                            Total Payable Amount:
                            <input id="result" type="text" class="form-control" name="total_payable">
                        </div>
                        <div class="mt-3">
                            Monthly Payable Amount:
                            <input id="result2" type="text" class="form-control" name="monthly_payable">
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#usernameSelect').change(function() {
        var username = $(this).val();

        $.ajax({
            url: '/showUserInfo/' + username,
            type: 'GET',
            success: function(response) {
               

               // Update UI with user information
            var userInfoHtml = `
                <label for="name" class="form-label text-success text-center">User Info</label>
                <p class="m-0 p-0">Address: ${response.address}</p>
                <p class="m-0 p-0">Phone: ${response.phone}</p>
                <p class="m-0 p-0">DOB: ${response.dob}</p>
                <p class="m-0 p-0">NID: ${response.nid}</p>
                <p class="m-0 p-0">Photo:  <img width="50" height="50" src="{{asset('uploads/user/${response.photo}')}}" alt=""></p>
            `;
            $('#userInfo').html(userInfoHtml);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    </script>

    <script>
        $(document).ready(function(){
            function calculateSum() {
                var amount = parseFloat($('#amount').val()) || 0;
                var duration = parseFloat($('#duration').val()) || 0;
                var percentage = parseFloat($('#percentage').val()) || 0;

                $.ajax({
                    url: "{{ route('loan.calculate') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        amount: amount,
                        duration: duration,
                        percentage: percentage
                    },
                    success: function(response) {
                        $('#result').val( response.total);
                        $('#result2').val( response.monthly);
                    }
                });
            }

            $('#amount, #duration, #percentage').on('input', calculateSum);
        });
    </script>

@endpush