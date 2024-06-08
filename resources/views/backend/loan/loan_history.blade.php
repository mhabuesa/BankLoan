@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Loan History</h3>
                </div>
                <div class="card-body">
                    <div class="mt-3">
                        <label for="" class="fom-label"> Bank Name</label>
                        <select class="form-control" name="bank_id" id="">
                            <option value="">Bank Name</option>
                            @foreach ($banks as $bank )
                            
                            <option value="">{{$bank->bank_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="" class="fom-label"> User Name</label>
                        <select class="form-control" name="user_id" id="usernameSelect">
                            <option value="">User Name</option>
                            @foreach ($users as $user )
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="userInfo" class="mt-3">
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#usernameSelect').change(function() {
    var username = $(this).val();

    $.ajax({
        url: '/showUserLoan/' + username,
        type: 'GET',
        success: function(response) {
           

           // Update UI with user information
        var userInfoHtml = `
            <label for="name" class="form-label text-success text-center">User Info</label>
            <p class="m-0 p-0">Loan: ${response.loan_amount}</p>
            <p class="m-0 p-0">Duration: ${response.duration}</p>
            <p class="m-0 p-0">Percentage: ${response.percentage}%</p>
            <p class="m-0 p-0">Total Payable: ${response.total_payable}</p>
            <p class="m-0 p-0">Monthly Payable: ${response.monthly_payable}</p>
        `;
        $('#userInfo').html(userInfoHtml);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
@endpush