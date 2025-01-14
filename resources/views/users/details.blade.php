@extends('layouts.app')
@section('style')
<style>
    .address-cell {
        border-right: 1px solid #DBDFEA;
    }

    #smsTable th:first-child {
        padding-left: 1.25rem !important;
    }

    #smsTable td {
        padding-left: 0.50rem !important;
    }
</style>
@endsection
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('users/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">User</h3>
                    <div class="nk-block-des">
                        <p>User Info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <ul class="nav nav-tabs" style="margin-top: -20px">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#personalInfo">
                                <div class="nk-block-between">
                                    @if (in_array($data->user_application_status, [1, 2, 3, 4]))
                                        <span class="bg-success text-white circle" style="width: 19px; height: 19px; padding: .96px 2px;">
                                            <em class="icon ni ni-check-thick fs-16px"></em>
                                        </span>
                                    @endif
                                    <em class="icon ni ni-user-circle"></em>
                                    <span>Personal Info</span>
                                </div>                                
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#KYCInfo">
                                <div class="nk-block-between">
                                    @if (in_array($data->user_application_status, [2, 3, 4]))
                                        <span class="bg-success text-white circle" style="width: 19px; height: 19px; padding: .96px 2px;">
                                            <em class="icon ni ni-check-thick fs-16px"></em>
                                        </span>
                                    @endif
                                    <em class="icon ni ni-shield-check"></em>
                                    <span>KYC Info</span>
                                </div>                                
                            </a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" data-bs-toggle="tab" href="#bankInfo">
                                <div class="nk-block-between">
                                    @if (in_array($data->user_application_status, [3, 4]))
                                        <span class="bg-success text-white circle" style="width: 19px; height: 19px; padding: .96px 2px;">
                                            <em class="icon ni ni-check-thick fs-16px"></em>
                                        </span>
                                    @endif
                                    <em class="icon ni ni-coin-alt"></em>
                                    <span>Bank Info</span>
                                </div>
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#loanLimitInfo">
                                <div class="nk-block-between">
                                    @if ($data->user_application_status == 4)
                                        <span class="bg-success text-white circle" style="width: 19px; height: 19px; padding: .96px 1px;">
                                            <em class="icon ni ni-check-thick fs-16px"></em>
                                        </span>
                                    @endif
                                    <em class="icon ni ni-bag"></em>
                                    <span>Loan Limit Info</span>
                                </div>                                
                            </a> 
                        </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#otherInfo"><em
                            class="icon ni ni-block-over"></em><span>Other Info</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#referredToInfo"><em
                            class="icon ni ni-link"></em><span>Referred To</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#contactInfo"><em 
                            class="icon ni ni-contact"></em><span>Contact Info</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#smsInfo"><em 
                            class="icon ni ni-msg"></em><span>SMS Info</span></a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="personalInfo">
                            <form method="POST"
                                action="{{ url('users/user_details/personal_info/edit') }}/{{ $data->id }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">First Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                                    name="first_name" id="first_name"
                                                    value="{{ old('first_name', $data->first_name) }}"
                                                    placeholder="First Name">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="last_name">Last Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                                    name="last_name" id="last_name"
                                                    value="{{ old('last_name', $data->last_name) }}"
                                                    placeholder="Last Name">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="form-control-wrap">
                                                <input type="email"
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                    name="email" id="email"
                                                    value="{{ old('email', $data->email) }}" placeholder="Email" readonly>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone_number">Phone Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                                                    name="phone_number" id="phone_number"
                                                    value="{{ old('phone_number', $data->phone_number) }}"
                                                    placeholder="Phone Number" readonly>
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="alternate_phone_number">Alternate Phone Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('alternate_phone_number') is-invalid @enderror"
                                                    name="alternate_phone_number" id="alternate_phone_number"
                                                    value="{{ old('alternate_phone_number', $data->alternate_phone_number) }}"
                                                    placeholder="Alternate Phone Number">
                                                @error('alternate_phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="dob">DOB</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right"
                                                    style="pointer-events:none; margin-top: 2px;"><em
                                                        class="icon ni ni-calendar-alt"></em>
                                                </div>
                                                <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                    class="form-control form-control-lg date-picker @error('dob') is-invalid @enderror"
                                                    value="{{ old('dob', $data->dob) }}" name="dob"
                                                    id="dob" placeholder="DOB">
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="employment_type">Employment Type</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2 @error('employment_type') is-invalid @enderror" data-ui="lg" data-search="on" name="employment_type" id="employment_type">
                                                    <option value="select_employment_type" selected disabled>Select Employment Type</option>
                                                    <option {{(strtolower($data->employment_type) == 'salaried') ? 'selected' : ''}} value="Salaried">Salaried</option>
                                                    <option {{(strtolower($data->employment_type) == 'self-employed') ? 'selected' : ''}} value="Self-employed">Self-employed</option>
                                                    <option {{(strtolower($data->employment_type) == 'doctor') ? 'selected' : ''}} value="Doctor">Doctor</option>
                                                    <option {{(strtolower($data->employment_type) == 'student') ? 'selected' : ''}} value="Student">Student</option>
                                                    <option {{(strtolower($data->employment_type) == 'other') ? 'selected' : ''}} value="Other">Other</option>
                                                </select>
                                                @error('employment_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="relationship_status">Relationship
                                                Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2 @error('relationship_status') is-invalid @enderror" data-ui="lg" data-search="on" name="relationship_status" id="relationship_status">
                                                    <option value="select_relationship_status" selected disabled>Select Relationship Status</option>
                                                    <option {{(strtolower($data->relationship_status) == 'single') ? 'selected' : ''}} value="Single">Single</option>
                                                    <option {{(strtolower($data->relationship_status) == 'married') ? 'selected' : ''}} value="Married">Married</option>
                                                    <option {{(strtolower($data->relationship_status) == 'divorced') ? 'selected' : ''}} value="Divorced">Divorced</option>
                                                    <option {{(strtolower($data->relationship_status) == 'widowed') ? 'selected' : ''}} value="Widowed">Widowed</option>
                                                </select>
                                                @error('relationship_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="current_address">Current Address</label>
                                            <div class="form-control-wrap">
                                                <textarea cols="5" rows="3"
                                                    class="form-control form-control-lg @error('current_address') is-invalid @enderror" name="current_address"
                                                    id="current_address" placeholder="Current Address">{{ old('current_address', $data->current_address) }}</textarea>
                                                @error('current_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="pincode">Pincode</label>
                                            <div class="form-control-wrap">
                                                <input type="number"
                                                    class="form-control form-control-lg @error('pincode') is-invalid @enderror"
                                                    name="pincode" id="pincode"
                                                    value="{{ old('pincode', $data->pincode) }}"
                                                    placeholder="Pincode">
                                                @error('pincode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr>

                            <div class="row">
                                <h5 class="title">Relative Info</h5>
                                <form method="POST" class="mt-1"
                                    action="{{ url('users/user_details/relative_info/edit') }}/{{ $data->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative1_name">Relative 1 Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('relative1_name') is-invalid @enderror"
                                                        name="relative1_name" id="relative1_name"
                                                        value="{{ old('relative1_name', $data->relative1_name) }}"
                                                        placeholder="Relative 1 Name">
                                                    @error('relative1_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative1_relation_id">Relative 1 Relation</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2 @error('relative1_relation_id') is-invalid @enderror" data-ui="lg" data-search="on" name="relative1_relation_id" id="relative1_relation_id">
                                                        <option value="select_relative1_relation" selected disabled>Select Relative 1 Relation</option>
                                                        @foreach ($relations as $relation)
                                                            <option value="{{ $relation->id }}" {{ ($relation->id == $data->relative1_relation_id) ? 'selected' : '' }}>{{ $relation->relation_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('relative1_relation_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative1_phone_number">Relative 1 Phone Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('relative1_name') is-invalid @enderror"
                                                        name="relative1_phone_number" id="relative1_phone_number"
                                                        value="{{ old('relative1_phone_number', $data->relative1_phone_number) }}"
                                                        placeholder="Relative 1 Phone Number">
                                                    @error('relative1_phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative2_name">Relative 2 Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('relative1_name') is-invalid @enderror"
                                                        name="relative2_name" id="relative2_name"
                                                        value="{{ old('relative2_name', $data->relative2_name) }}"
                                                        placeholder="Relative 2 Name">
                                                    @error('relative2_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative2_relation_id">Relative 2 Relation</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2 @error('relative2_relation_id') is-invalid @enderror" data-ui="lg" data-search="on" name="relative2_relation_id" id="relative2_relation_id">
                                                        <option value="select_relative2_relation" selected disabled>Select Relative 2 Relation</option>
                                                        @foreach ($relations as $relation)
                                                            <option value="{{ $relation->id }}" {{ ($relation->id == $data->relative2_relation_id) ? 'selected' : '' }}>{{ $relation->relation_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('relative2_relation_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="relative2_phone_number">Relative 2 Phone Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('relative2_phone_number') is-invalid @enderror"
                                                        name="relative2_phone_number" id="relative2_phone_number"
                                                        value="{{ old('relative2_phone_number', $data->relative2_phone_number) }}"
                                                        placeholder="Relative 2 Phone Number">
                                                    @error('relative2_phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane" id="loanLimitInfo">
                            <form method="POST"
                                action="{{ url('users/user_details/loan_limit_info/edit') }}/{{ $data->id }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="income_amount">Income Amount</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('income_amount') is-invalid @enderror"
                                                    name="income_amount" id="income_amount"
                                                    value="{{ old('income_amount', $data->income_amount) }}"
                                                    placeholder="Income Amount">
                                                @error('income_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="company_name">Company Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('company_name') is-invalid @enderror"
                                                    name="company_name" id="company_name"
                                                    value="{{ old('company_name', $data->company_name) }}"
                                                    placeholder="Company Name">
                                                @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="company_address">Company Address</label>
                                            <div class="form-control-wrap">
                                                <textarea rows="3" cols="5"
                                                    class="form-control form-control-lg @error('company_address') is-invalid @enderror" name="company_address"
                                                    id="company_address" value="" placeholder="Company Address">{{ old('company_address', $data->company_address) }}</textarea>
                                                @error('company_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="company_pincode">Company Pincode</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('company_pincode') is-invalid @enderror"
                                                    name="company_pincode" id="company_pincode"
                                                    value="{{ old('company_pincode', $data->company_pincode) }}"
                                                    placeholder="Company Pincode">
                                                @error('company_pincode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="company_city">Company City</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('company_city') is-invalid @enderror"
                                                    name="company_city" id="company_city"
                                                    value="{{ old('company_city', $data->company_city) }}"
                                                    placeholder="Company City">
                                                @error('company_city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="credit_limit">Credit Limit</label>
                                            <div class="form-control-wrap">
                                                <input type="number"
                                                    class="form-control form-control-lg @error('credit_limit') is-invalid @enderror"
                                                    name="credit_limit" id="credit_limit"
                                                    value="{{ old('credit_limit', $data->credit_limit) }}"
                                                    placeholder="Credit Limit">
                                                @error('credit_limit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="salary_slip">Salary Slip</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file"
                                                        class="form-control form-control-lg @error('salary_slip') is-invalid @enderror"
                                                        name="salary_slip" id="salary_slip"
                                                        value="{{ old('salary_slip', $data->salary_slip) }}">
                                                </div>
                                                @error('salary_slip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-wrap mt-3">
                                                    <a href="{{ $data->salary_slip ? asset('storage/app/public/' . $data->salary_slip) : 'javascript:void(0)' }}" target="{{ $data->salary_slip ? '_blank' : '' }}" id="salary_slip_preview" style="font-size:24px">
                                                        <em class="icon ni ni-file-pdf"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="bank_statement">Bank Statement</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file"
                                                        class="form-control form-control-lg @error('bank_statement') is-invalid @enderror"
                                                        name="bank_statement" id="bank_statement"
                                                        value="{{ old('bank_statement', $data->bank_statement) }}">
                                                </div>
                                                @error('bank_statement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-wrap mt-3">
                                                    <a href="{{ $data->bank_statement ? asset('storage/app/public/' . $data->bank_statement) : 'javascript:void(0)' }}" target="{{ $data->bank_statement ? '_blank' : '' }}" id="bank_statement_preview" style="font-size:24px">
                                                        <em class="icon ni ni-file-pdf"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="KYCInfo">
                            <form method="POST"
                                action="{{ url('users/user_details/kyc_info/edit') }}/{{ $data->id }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="aadhaar_number">Aadhaar Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('aadhaar_number') is-invalid @enderror"
                                                    name="aadhaar_number" id="aadhaar_number"
                                                    value="{{ old('aadhaar_number', $data->aadhaar_number) }}"
                                                    placeholder="Aadhaar Number">
                                                @error('aadhaar_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="aadhaar_name">Aadhaar Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('aadhaar_name') is-invalid @enderror"
                                                    name="aadhaar_name" id="aadhaar_name"
                                                    value="{{ old('aadhaar_name', $data->aadhaar_name) }}"
                                                    placeholder="Aadhaar Name">
                                                @error('aadhaar_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="aadhaar_dob">Aadhaar DOB</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right"
                                                    style="pointer-events:none; margin-top: 2px;"><em
                                                        class="icon ni ni-calendar-alt"></em>
                                                </div>
                                                <input type="text" data-date-format="yyyy-mm-dd" autocomplete="off"
                                                    class="form-control form-control-lg date-picker @error('dob') is-invalid @enderror"
                                                    value="{{ old('aadhaar_dob', $data->aadhaar_dob) }}" name="aadhaar_dob"
                                                    id="aadhaar_dob" placeholder="Aadhaar DOB" readonly style="pointer-events: none">
                                                @error('aadhaar_dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="pan_card_number">PAN Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('pan_card_number') is-invalid @enderror"
                                                    name="pan_card_number" id="pan_card_number"
                                                    value="{{ old('pan_card_number', $data->pan_card_number) }}"
                                                    placeholder="PAN Number">
                                                @error('pan_card_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="pan_name">PAN Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('pan_name') is-invalid @enderror"
                                                        name="pan_name" id="pan_name"
                                                        value="{{ old('pan_name', $data->pan_name) }}"
                                                        placeholder="PAN Name">
                                                    @error('pan_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="selfie">Selfie</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file"
                                                        class="form-control form-control-lg @error('selfie') is-invalid @enderror"
                                                        name="selfie" id="selfie" value="{{ old('selfie') }}"
                                                        placeholder="Selfie">
                                                </div>
                                                @error('selfie')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-control-wrap mt-3">
                                                <img id="selfie_preview"
                                                    src="{{ $data->selfie ? asset('storage/app/public/' . $data->selfie) : asset('assets/images/default-image.jpg') }}"
                                                    alt="" style="max-width: 100%; max-height: 130px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="selfie">Aadhaar Photo</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file"
                                                        class="form-control form-control-lg @error('aadhaar_image') is-invalid @enderror"
                                                        name="aadhaar_image" id="aadhaar_image" value="{{ old('aadhaar_image') }}"
                                                        placeholder="Aadhaar Photo">
                                                </div>
                                                @error('aadhaar_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-control-wrap mt-3">
                                                <img id="aadhaar_photo_preview"
                                                    src="{{ $data->aadhaar_image ? asset('storage/app/public/' . $data->aadhaar_image) : asset('assets/images/default-image.jpg') }}"
                                                    alt="" style="max-width: 100%; max-height: 130px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="bankInfo">
                            <form method="POST"
                                action="{{ url('users/user_details/bank_info/edit') }}/{{ $data->id }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="bank_name">Bank Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('bank_name') is-invalid @enderror"
                                                    name="bank_name" id="bank_name"
                                                    value="{{ old('bank_name', $data->bank_name) }}"
                                                    placeholder="Bank Name">
                                                @error('bank_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="account_number">Account Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('account_number') is-invalid @enderror"
                                                    name="account_number" id="account_number"
                                                    value="{{ old('account_number', $data->account_number) }}"
                                                    placeholder="Account Number">
                                                @error('account_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="ifsc_code">IFSC Code</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('ifsc_code') is-invalid @enderror"
                                                    name="ifsc_code" id="ifsc_code"
                                                    value="{{ old('ifsc_code', $data->ifsc_code) }}"
                                                    placeholder="IFSC Code">
                                                @error('ifsc_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="otherInfo">
                            <form method="POST"
                                action="javascript:void(0);"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="my_referral_code">My Referral Code</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('my_referral_code') is-invalid @enderror"
                                                    name="my_referral_code" id="my_referral_code"
                                                    value="{{ old('my_referral_code', $data->my_referral_code) }}"
                                                    placeholder="My Referral Code" readonly>
                                                @error('my_referral_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="cashback_earned">Cashback Earned</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('cashback_earned') is-invalid @enderror"
                                                    name="cashback_earned" id="cashback_earned"
                                                    value="{{ old('cashback_earned', $data->cashback_earned) }}"
                                                    placeholder="Cashback Earned" readonly>
                                                @error('cashback_earned')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="referred_by">Referred By</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('referred_by') is-invalid @enderror"
                                                    name="referred_by" id="referred_by" placeholder="Referred By"
                                                    value="@if(isset($data->referred_by)){{ old('referred_by', $data->users->first_name . ' ' . $data->users->last_name) }}@else{{ old('referred_by') }}@endif"
                                                     readonly>
                                                @error('referred_by')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="cibil_score">CIBIL Score</label>
                                            <div class="form-control-wrap">
                                                <input type="number"
                                                    class="form-control form-control-lg @error('cibil_score') is-invalid @enderror"
                                                    name="cibil_score" id="cibil_score"
                                                    value="{{ old('cibil_score', $data->cibil_score) }}"
                                                    placeholder="CIBIL Score" readonly>
                                                @error('cibil_score')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="loan_stage">Loan Stage</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('loan_stage') is-invalid @enderror"
                                                    name="loan_stage" id="loan_stage"
                                                    value="{{ old('loan_stage', $data->loan_stage) . ' Stage' }}"
                                                    placeholder="Loan Stage" readonly>
                                                @error('loan_stage')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="user_application_status">Application Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2 @error('user_application_status') is-invalid @enderror" data-ui="lg" data-search="on" name="user_application_status" id="user_application_status" readonly>
                                                    <option value="select_application_status" selected disabled>Select Application Status</option>
                                                    <option {{ ($data->user_application_status == 0 ) ? 'selected' : ''}} value="0">Profile not filled yet</option>
                                                    <option {{ ($data->user_application_status == 1) ? 'selected' : ''}} value="1">Profile Completed</option>
                                                    <option {{ ($data->user_application_status == 2) ? 'selected' : ''}} value="2">KYC Completed</option>
                                                    <option {{ ($data->user_application_status == 3) ? 'selected' : ''}} value="3">Loan Limit Completed</option>
                                                    <option {{ ($data->user_application_status == 4) ? 'selected' : ''}} value="3">Bank Verification Completed</option>
                                                </select>
                                                @error('user_application_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="geo_location">Geo Location</label>
                                            <div class="form-control-wrap">
                                                <textarea cols="5" rows="3"
                                                    class="form-control form-control-lg @error('geo_location') is-invalid @enderror" name="geo_location"
                                                    id="geo_location" placeholder="Geo Location" readonly>{{ old('geo_location', $data->geo_location) }}</textarea>
                                                @error('geo_location')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="referredToInfo">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="contactInfo">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table" id="contactTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="smsInfo">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table" id="smsTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th width="35%">Message</th>
                                                <th>Read</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptJs')
    <script>
        $(document).ready(function() {
            datatable1();
        });

        function datatable1() {
            userId = {{ $data->id }};

            // Referred To

            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: {
                    url: "{{ route('user.details', ['id' => $data->id]) }}",
                    data: {
                        datatable: 'referred'
                    }
                },
                "order": [
                    // [0, "desc"]
                ],
                responsive: !0,
                autoFill: !0,
                keys: !0,
                lengthMenu: [
                    [10, 100, 500, -1],
                    [10, 100, 500, "All"]
                ],

                "columns": [
                    {
                        "mData": "first_name",
                        "render": function(data, type, row, meta) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": "last_name",
                        "render": function(data, type, row, meta) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": "phone_number"
                    },
                ]
            });

            // Contact Data

            NioApp.DataTable('#contactTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: {
                    url: "{{ route('user.details', ['id' => $data->id]) }}",
                    data: {
                        datatable: 'contacts'
                    }
                },
                "order": [
                    // [0, "desc"]
                ],
                responsive: !0,
                autoFill: !0,
                keys: !0,
                lengthMenu: [
                    [10, 100, 500, -1],
                    [10, 100, 500, "All"]
                ],

                "columns": [
                    {
                        "mData": "name",
                        "render": function(data, type, row, meta) {
                            return data ? data : 'NA';
                        }
                    },
                    {
                        "mData": "phone_number"
                    },
                    {
                        "mData": "email",
                        "render": function(data, type, row, meta) {
                            return data ? data : 'NA';
                        }
                    }
                ]
            });

            // SMS Data

            NioApp.DataTable('#smsTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                ajax: {
                    url: "{{ route('user.details', ['id' => $data->id]) }}",
                    data: {
                        datatable: 'sms'
                    }
                },
                "order": [
                    // [0, "desc"]
                ],
                responsive: !0,
                autoFill: !0,
                keys: !0,
                lengthMenu: [
                    [10, 100, 500, -1],
                    [10, 100, 500, "All"]
                ],

                "columns": [
                    {
                        "mData": "address",
                        "render": function(data, type, row) {
                            return "<span style='padding-left: .75rem;'>" + data + "</span>";
                        }
                    },
                    {
                        "mData": "body",
                        "render": function(data, type, row) {
                            var truncatedText = data.length > 40 ? data.substr(0, 40) + '...' : data;
                            return "<span class='d-inline-block myTooltip' tabindex='0' data-toggle='tooltip' title='" +
                                    data + "' data-placement='top'>" + truncatedText + "</span>";
                        },
                    },
                    {
                        "mData": "is_read",
                        render: function(data, type, row) {
                            if (row.is_read == 1) {
                                return "<h6 class='text-success sub-text' style='margin-top:5px;'>Read</h6>";
                            } else {
                                return "<h6 class='text-danger sub-text' style='margin-top:5px;'>Unread</h6>";
                            }
                        }
                    },
                    {
                        "mData": "type",
                        render: function(data, type, row) {
                            if (row.type == "sent") {
                                return "<h6 class='text-primary sub-text' style='margin-top:5px;'>Sent</h6>";
                            } else {
                                return "<h6 class='text-warning sub-text' style='margin-top:5px;'>Received</h6>";
                            }
                        }
                    },
                    {
                        "mData": "date",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:m:s');
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).nodes();
                    var last = null;

                    var groupCounts = {};

                    api.column(0, { page: 'current' }).data().each(function(group, i) {
                        var lowerGroup = group.toLowerCase();
                        if (!groupCounts[lowerGroup]) {
                            groupCounts[lowerGroup] = { count: 0, originalGroup: group };
                        }
                        groupCounts[lowerGroup].count++;
                    });

                    api.column(0, { page: 'current' }).data().each(function(group, i) {
                        var lowerGroup = group.toLowerCase(); 
                        if (last !== lowerGroup) {
                            $(rows).eq(i).find('td:first').attr('rowspan', groupCounts[lowerGroup].count).addClass('address-cell');
                            last = lowerGroup;
                        } else {
                            $(rows).eq(i).find('td:first').remove();
                        }
                    });

                    $('.myTooltip').tooltip();

                    $('.dataTables_scrollBody .myTooltip').on('shown.bs.tooltip', function() {
                        var $tooltip = $(this).next('.tooltip');
                        var $cell = $(this).closest('td');
                        var tooltipLeft = $cell.position().left + ($cell.outerWidth() - $tooltip.outerWidth()) / 2;
                        var tooltipTop = $cell.position().top - $tooltip.outerHeight();
                        $tooltip.css({ left: tooltipLeft, top: tooltipTop });
                    });
                },
            });

            $('.myTooltip').tooltip();

            $('#smsTable tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 0 && currentOrder[1] === 'asc') {
                    table.order([0, 'desc']).draw();
                } else {
                    table.order([0, 'asc']).draw();
                }
            });
        }

        document.getElementById('selfie').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('selfie_preview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        document.getElementById('aadhaar_image').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('aadhaar_image_preview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            var fileInput = document.getElementById('salary_slip');
            var viewLink = document.getElementById('salary_slip_preview');

            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files[0]) {
                    var fileURL = URL.createObjectURL(fileInput.files[0]);
                    viewLink.href = fileURL;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var fileInput = document.getElementById('bank_statement');
            var viewLink = document.getElementById('bank_statement_preview');

            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files[0]) {
                    var fileURL = URL.createObjectURL(fileInput.files[0]);
                    viewLink.href = fileURL;
                }
            });
        });

        $(document).ready(function() {
            var lastActiveTab = localStorage.getItem('lastActiveTab');

            if (!lastActiveTab) {
                lastActiveTab = '#personalInfo';
            }

            @if (Session::has('personal_info'))
                lastActiveTab = '#personalInfo';
            @elseif (Session::has('loan_limit_info'))
                lastActiveTab = '#loanLimitInfo';
            @elseif (Session::has('kyc_info'))
                lastActiveTab = '#KYCInfo';
            @elseif (Session::has('bank_info'))
                lastActiveTab = '#bankInfo';
            @endif

            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $(lastActiveTab).addClass('show active');
            $('a[href="' + lastActiveTab + '"]').addClass('active');

            $('.nav-link').on('shown.bs.tab', function(e) {
                var targetTab = $(e.target).attr('href');
                localStorage.setItem('lastActiveTab', targetTab);
            });
        });
    </script>
@endsection
