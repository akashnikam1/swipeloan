@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('loan_requests/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">Update Loan Request</h3>
                    <div class="nk-block-des">
                        <p>Loan Request Info</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                            class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <h6 class="nk-block-title">Status:
                                @if ($data->loan_status == 0)
                                    Pending
                                @elseif($data->loan_status == 1)
                                    Approved
                                @elseif($data->loan_status == 2)
                                    Ongoing
                                @elseif($data->loan_status == 3)
                                    Closed
                                @elseif($data->loan_status == 4)
                                    Declined
                                @endif
                            </h6>
                            <ul class="nk-block-tools g-3">
                                @if ($data->loan_status == 1)
                                    <li>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#disburseAmountModal">
                                            <em class="icon ni ni-done"></em>
                                            <span>Disburse Amount</span>
                                        </button> 
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#declinedModal">
                                            <em class="icon ni ni-cross"></em>
                                            <span>Declined</span>
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <ul class="nav nav-tabs" style="margin-top: -20px">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalInfo">
                                <div class="nk-block-between">
                                    @if (in_array($data->users->user_application_status, [1, 2, 3, 4]))
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
                                    @if (in_array($data->users->user_application_status, [2, 3, 4]))
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
                                    @if (in_array($data->users->user_application_status, [3, 4]))
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
                                    @if ($data->users->user_application_status == 4)
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
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#loanInfo"><em
                            class="icon ni ni-wallet"></em><span>Loan Info</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#loanDocument"><em
                            class="icon ni ni-file-docs"></em><span>Loan Document</span></a> </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="personalInfo">
                            <form method="POST"
                                action="javascript:void(0);"
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
                                                    value="{{ old('first_name', $data->loan_users->first_name) }}"
                                                    placeholder="First Name" readonly>
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
                                                    value="{{ old('last_name', $data->loan_users->last_name) }}"
                                                    placeholder="Last Name" readonly>
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
                                                    value="{{ old('email', $data->loan_users->email) }}" placeholder="Email" readonly>
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
                                                    value="{{ old('phone_number', $data->loan_users->phone_number) }}"
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
                                                    value="{{ old('alternate_phone_number', $data->loan_users->alternate_phone_number) }}"
                                                    placeholder="Alternate Phone Number" readonly>
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
                                                    value="{{ old('dob', $data->loan_users->dob) }}" name="dob"
                                                    id="dob" placeholder="DOB" readonly style="pointer-events: none">
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
                                                <select class="form-select js-select2 @error('employment_type') is-invalid @enderror" data-ui="lg" data-search="on" name="employment_type" id="employment_type" readonly disabled>
                                                    <option value="select_employment_type" selected disabled>Select Employment Type</option>
                                                    <option {{(strtolower($data->loan_users->employment_type) == 'salaried') ? 'selected' : ''}} value="Salaried">Salaried</option>
                                                    <option {{(strtolower($data->loan_users->employment_type) == 'self-employed') ? 'selected' : ''}} value="Self-employed">Self-employed</option>
                                                    <option {{(strtolower($data->loan_users->employment_type) == 'doctor') ? 'selected' : ''}} value="Doctor">Doctor</option>
                                                    <option {{(strtolower($data->loan_users->employment_type) == 'student') ? 'selected' : ''}} value="Student">Student</option>
                                                    <option {{(strtolower($data->loan_users->employment_type) == 'other') ? 'selected' : ''}} value="Other">Other</option>
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
                                                <select class="form-select js-select2 @error('relationship_status') is-invalid @enderror" data-ui="lg" data-search="on" name="relationship_status" id="relationship_status" readonly disabled>
                                                    <option value="select_relationship_status" selected disabled>Select Relationship Status</option>
                                                    <option {{(strtolower($data->loan_users->relationship_status) == 'single') ? 'selected' : ''}} value="Single">Single</option>
                                                    <option {{(strtolower($data->loan_users->relationship_status) == 'married') ? 'selected' : ''}} value="Married">Married</option>
                                                    <option {{(strtolower($data->loan_users->relationship_status) == 'divorced') ? 'selected' : ''}} value="Divorced">Divorced</option>
                                                    <option {{(strtolower($data->loan_users->relationship_status) == 'widowed') ? 'selected' : ''}} value="Widowed">Widowed</option>
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
                                                    id="current_address" placeholder="Current Address" readonly>{{ old('current_address', $data->loan_users->current_address) }}</textarea>
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
                                                    value="{{ old('pincode', $data->loan_users->pincode) }}"
                                                    placeholder="Pincode" readonly>
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
                                            <button type="submit" class="btn btn-lg btn-primary d-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr>

                            <div class="row">
                                <h5 class="title">Relative Info</h5>
                                <form method="POST" class="mt-1"
                                    action="javascript:void(0);"
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
                                                        value="{{ old('relative1_name', $data->users->relative1_name) }}"
                                                        placeholder="Relative 1 Name" readonly>
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
                                                    <select class="form-select js-select2 @error('relative1_relation_id') is-invalid @enderror" data-ui="lg" data-search="on" name="relative1_relation_id" id="relative1_relation_id" readonly disabled>
                                                        <option value="select_relative1_relation" selected disabled>Select Relative 1 Relation</option>
                                                        @foreach ($relations as $relation)
                                                            <option value="{{ $relation->id }}" {{ ($relation->id == $data->users->relative1_relation_id) ? 'selected' : '' }}>{{ $relation->relation_name }}</option>
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
                                                        value="{{ old('relative1_phone_number', $data->users->relative1_phone_number) }}"
                                                        placeholder="Relative 1 Phone Number" readonly>
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
                                                        value="{{ old('relative2_name', $data->users->relative2_name) }}"
                                                        placeholder="Relative 2 Name" readonly>
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
                                                    <select class="form-select js-select2 @error('relative2_relation_id') is-invalid @enderror" data-ui="lg" data-search="on" name="relative2_relation_id" id="relative2_relation_id" readonly disabled>
                                                        <option value="select_relative2_relation" selected disabled>Select Relative 2 Relation</option>
                                                        @foreach ($relations as $relation)
                                                            <option value="{{ $relation->id }}" {{ ($relation->id == $data->users->relative2_relation_id) ? 'selected' : '' }}>{{ $relation->relation_name }}</option>
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
                                                        value="{{ old('relative2_phone_number', $data->users->relative2_phone_number) }}"
                                                        placeholder="Relative 2 Phone Number" readonly>
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
                                                <button type="submit" class="btn btn-lg btn-primary d-none">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane" id="loanLimitInfo">
                            <form method="POST"
                                action="javascript:void(0);"
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
                                                    value="{{ old('income_amount', $data->loan_users->income_amount) }}"
                                                    placeholder="Income Amount" readonly>
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
                                                    value="{{ old('company_name', $data->loan_users->company_name) }}"
                                                    placeholder="Company Name" readonly>
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
                                                    id="company_address" value="" placeholder="Company Address" readonly>{{ old('company_address', $data->loan_users->company_address) }}</textarea>
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
                                                    value="{{ old('company_pincode', $data->loan_users->company_pincode) }}"
                                                    placeholder="Company Pincode" readonly>
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
                                                    value="{{ old('company_city', $data->loan_users->company_city) }}"
                                                    placeholder="Company City" readonly>
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
                                                    value="{{ old('credit_limit', $data->loan_users->credit_limit) }}"
                                                    placeholder="Credit Limit" readonly>
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
                                                        value="{{ old('salary_slip', $data->loan_users->salary_slip) }}" readonly disabled>
                                                </div>
                                                @error('salary_slip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-wrap mt-3">
                                                    <a href="{{ $data->loan_users->salary_slip ? asset('storage/app/public/' . $data->loan_users->salary_slip) : 'javascript:void(0)' }}" target="{{ $data->loan_users->salary_slip ? '_blank' : '' }}" id="salary_slip_preview" style="font-size:24px">
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
                                                        value="{{ old('bank_statement', $data->loan_users->bank_statement) }}" readonly disabled>
                                                </div>
                                                @error('bank_statement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-wrap mt-3">
                                                    <a href="{{ $data->loan_users->bank_statement ? asset('storage/app/public/' . $data->loan_users->bank_statement) : 'javascript:void(0)' }}" target="{{ $data->loan_users->bank_statement ? '_blank' : '' }}" id="bank_statement_preview" style="font-size:24px">
                                                        <em class="icon ni ni-file-pdf"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary d-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="KYCInfo">
                            <form method="POST"
                                action="javascript:void(0);"
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
                                                    value="{{ old('aadhaar_number', $data->users->aadhaar_number) }}"
                                                    placeholder="Aadhaar Number" readonly>
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
                                                    value="{{ old('aadhaar_name', $data->users->aadhaar_name) }}"
                                                    placeholder="Aadhaar Name" readonly>
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
                                                    value="{{ old('aadhaar_dob', $data->users->aadhaar_dob) }}" name="aadhaar_dob"
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
                                                    value="{{ old('pan_card_number', $data->users->pan_card_number) }}"
                                                    placeholder="PAN Number" readonly>
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
                                                        value="{{ old('pan_name', $data->users->pan_name) }}"
                                                        placeholder="PAN Name" readonly>
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
                                                        placeholder="Selfie" readonly disabled>
                                                </div>
                                                @error('selfie')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-control-wrap mt-3">
                                                <img id="selfie_preview"
                                                    src="{{ $data->loan_users->selfie ? asset('storage/app/public/' . $data->loan_users->selfie) : asset('assets/images/default-image.jpg') }}"
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
                                                        placeholder="Aadhaar Photo" readonly disabled>
                                                </div>
                                                @error('aadhaar_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-control-wrap mt-3">
                                                <img id="aadhaar_photo_preview"
                                                    src="{{ $data->users->aadhaar_image ? asset('storage/app/public/' . $data->users->aadhaar_image) : asset('assets/images/default-image.jpg') }}"
                                                    alt="" style="max-width: 100%; max-height: 130px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary d-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="bankInfo">
                            <form method="POST"
                                action="javascript:void(0);"
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
                                                    value="{{ old('bank_name', $data->loan_users->bank_name) }}"
                                                    placeholder="Bank Name" readonly>
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
                                                    value="{{ old('account_number', $data->loan_users->account_number) }}"
                                                    placeholder="Account Number" readonly>
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
                                                    value="{{ old('ifsc_code', $data->loan_users->ifsc_code) }}"
                                                    placeholder="IFSC Code" readonly>
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
                                            <button type="submit" class="btn btn-lg btn-primary d-none">Save</button>
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
                                            <label class="form-label" for="cibil_score">CIBIL Score</label>
                                            <div class="form-control-wrap">
                                                <input type="number"
                                                    class="form-control form-control-lg @error('cibil_score') is-invalid @enderror"
                                                    name="cibil_score" id="cibil_score"
                                                    value="{{ old('cibil_score', $data->loan_users->cibil_score) }}"
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
                                                    value="{{ old('loan_stage', $data->users->loan_stage) . ' Stage' }}"
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
                                            <label class="form-label" for="geo_location">Geo Location</label>
                                            <div class="form-control-wrap">
                                                <textarea cols="5" rows="3"
                                                    class="form-control form-control-lg @error('geo_location') is-invalid @enderror" name="geo_location"
                                                    id="geo_location" placeholder="Geo Location" readonly>{{ old('geo_location', $data->users->geo_location) }}</textarea>
                                                @error('geo_location')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                  
                                   	<div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="nbfc_id">NBFC Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('nbfc_id') is-invalid @enderror"
                                                    name="nbfc_id" id="nbfc_id"
                                                    value="{{ old('nbfc_id', $data->nbfc->nbfc_name ?? '') }}"
                                                    placeholder="NBFC Name" readonly>
                                                @error('nbfc_id')
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

                        <div class="tab-pane" id="loanInfo">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Loan Information</h5>
                                            <p>Loan info, like loan amount, emi charges and other info.</p>
                                            <div style="height: 1px; background-color: #ECECEC"></div>
                                        </div>

                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Loan Number</span>
                                                    <span class="profile-ud-value">{{ $data->loan_number }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Loan Amount</span>
                                                    <span class="profile-ud-value">{{ $data->loan_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Documentation Fee</span>
                                                    <span class="profile-ud-value">{{ $data->documentation_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">GST on Documentation Fee</span>
                                                    <span class="profile-ud-value">{{ $data->gst_on_documentation_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Up Front Charges</span>
                                                    <span class="profile-ud-value">{{ $data->up_front_charges }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">GST on Up Front Charges</span>
                                                    <span class="profile-ud-value">{{ $data->gst_on_up_front_charges }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Net Disbursed Amount</span>
                                                    <span class="profile-ud-value">{{ $data->net_disbursed_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Pre Interest Amount</span>
                                                    <span class="profile-ud-value">{{ $data->pre_interest_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Disbursed Amount</span>
                                                    <span class="profile-ud-value">{{ $data->disbursed_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Disbursed Date</span>
                                                    <span class="profile-ud-value">
                                                        @if ($data->disbursed_date)
                                                            {{ \Carbon\Carbon::parse($data->disbursed_date)->format('d-m-Y') }}
                                                        @else
                                                            NA
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Due On</span>
                                                    <span class="profile-ud-value">{{ \Carbon\Carbon::parse($data->due_on)->format('d-m-Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">EMI Amount</span>
                                                    <span class="profile-ud-value">{{ $data->emi_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Tenure</span>
                                                    <span class="profile-ud-value">{{ $data->tenure }} Days</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Total EMI Amount</span>
                                                    <span class="profile-ud-value">{{ $data->total_emi_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">EMI Start Date</span>
                                                    <span class="profile-ud-value">{{ \Carbon\Carbon::parse($data->emi_start_date)->format('d-m-Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">EMI End Date</span>
                                                    <span class="profile-ud-value">{{ \Carbon\Carbon::parse($data->emi_end_date)->format('d-m-Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Interest Amount</span>
                                                    <span class="profile-ud-value">{{ $data->interest_rate }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Post Service Fee</span>
                                                    <span class="profile-ud-value">{{ $data->post_service_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">GST on Post Service Fee</span>
                                                    <span class="profile-ud-value">{{ $data->gst_on_post_service_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Technology Fee</span>
                                                    <span class="profile-ud-value">{{ $data->technology_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">GST on Technology Fee</span>
                                                    <span class="profile-ud-value">{{ $data->gst_on_technology_fee }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Loan Type</span>
                                                    <span class="profile-ud-value">{{ $data->loan_type }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Payment Mode</span>
                                                    <span class="profile-ud-value">{{ $data->payment_mode == 1 ? 'Razorpay' : 'Billdesk' }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Lender</span>
                                                    <span class="profile-ud-value">{{ $data->lender }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Is Auto Debit</span>
                                                    <span class="profile-ud-value">{{ $data->is_auto_debit == 1 ? 'Yes' : 'No' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">EMI Schedules</h5>
                                            <p>EMI schedules and E-Nach history.</p>
                                            <div style="height: 1px; background-color: #ECECEC"></div>

                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" class="text-center">Payment Info</th>
                                                            <th colspan="6" class="text-center">E-Nach Charges</th>
                                                        </tr>
                                                        <tr>
                                                            <th width="110px">Payment Date</th>
                                                            <th>Payment Amount</th>
                                                            <th>E-Nach Charges</th>
                                                            <th>GST on E-Nach Charges</th>
                                                            <th>Bounce Charges</th>
                                                            <th>Total Amount</th>
                                                            <th width="110px">E-Nach Date</th>
                                                            <th>E-Nach Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $payment)
                                                            @if ($payment->enachTransactions->isEmpty())
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                                                                    <td>{{ number_format($payment->payment_amount, 2) }}</td>
                                                                    <td colspan="6">-</td>
                                                                </tr>
                                                            @else
                                                                @foreach ($payment->enachTransactions as $enach)
                                                                    <tr>
                                                                        @if ($loop->first)
                                                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                                                                            <td>{{ number_format($payment->payment_amount, 2) }}</td>
                                                                        @else
                                                                            <td></td>
                                                                            <td></td>
                                                                        @endif
                                                                        <td>{{ number_format($enach->enach_charges, 2) }}</td>
                                                                        <td>{{ number_format($enach->gst_on_enach_charges, 2) }}</td>
                                                                        <td>{{ number_format($enach->bounce_charges, 2) }}</td>
                                                                        <td>{{ number_format($enach->amount + $enach->enach_charges + $enach->gst_on_enach_charges + $enach->bounce_charges, 2) }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($enach->enach_date)->format('d-m-Y') }}</td>
                                                                        <td>
                                                                            <span class="{{ $enach->enach_status == 1 ? 'text-success' : 'text-danger' }}">
                                                                                {{ $enach->enach_status == 1 ? 'Success' : 'Failed' }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="loanDocument">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Document Name</th>
                                                <th>Document</th>
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

   {{-- Declined Loan Request Modal --}}

    <div class="modal fade" tabindex="-1" id="declinedModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-bs-label="Close"> 
                    <em class="icon ni ni-cross"></em> 
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Declined Loan Request</h5>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ url('loan_requests/loan_details/declined_loan_request') }}/{{ $data->id }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="declined_reason">Declined Reason</label>
                                    <div class="form-control-wrap">
                                        <textarea cols="5" rows="3" class="form-control form-control-lg" name="declined_reason"
                                        id="declined_reason" placeholder="Declined Reason" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">
                            <button type="submit" class="btn btn-primary">Declined</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Disburse Amount Modal --}}

    <div class="modal fade" tabindex="-1" id="declinedModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Declined Loan Request</h5>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ url('loan_requests/loan_details/declined_loan_request') }}/{{ $data->id }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="declined_reason">Declined Reason</label>
                                    <div class="form-control-wrap">
                                        <textarea cols="5" rows="3" class="form-control form-control-lg" name="declined_reason"
                                            id="declined_reason" placeholder="Declined Reason" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">
                        <button type="submit" class="btn btn-primary">Declined</button>
                    </span>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Success/Failed Loan Disbursement Modal --}}

    <div class="modal fade" tabindex="-1" id="responseModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Loan Disbursement Status</h5>
                </div>
                <div class="modal-body modal-body-md text-center">
                    <div class="nk-modal">
                        <em id="responseIcon" class="nk-modal-icon icon icon-circle icon-circle-xxl"></em>
                        <h4 id="responseTitle" class="nk-modal-title"></h4>
                        <div class="nk-modal-text">
                            <div id="responseMessage" class="caption-text"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OKAY</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Loader --}}
    
    <div class="js-preloader d-none" style="justify-content: center; align-items: center; height: 100vh;">
        <div id="loader" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem; --bs-spinner-border-width: 0.35em;" role="status"></div>
        </div>
    </div>  
@endsection

@section('scriptJs')
    <script>
        $(document).ready(function() {
            datatable1();
        });
        
        $(document).ready(function() {
            $('#disburseForm').on('submit', function(e) {
                e.preventDefault();

                $('.js-preloader').removeClass('d-none');
                $('#disburseAmountModal').modal('hide');

                let actionUrl = $(this).data('action-url');
                let formData = $(this).serialize();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: actionUrl,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        const responseIcon = $("#responseIcon");
                        const responseTitle = $("#responseTitle");
                        const responseMessage = $("#responseMessage");

                        $('.js-preloader').addClass('d-none');
 
                        if (response.success) {
                            responseIcon.attr("class",
                                "nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"
                                );
                            responseTitle.text("Success");
                            responseMessage.text(response.message);
                        } else {
                            responseIcon.attr("class",
                                "nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"
                                );
                            responseTitle.text("Failed");
                            responseMessage.text(response.message);
                        }

                        $('#responseModal').modal('show');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        const responseModal = new bootstrap.Modal(document.getElementById(
                            "responseModal"));
                        const responseIcon = $("#responseIcon");
                        const responseTitle = $("#responseTitle");
                        const responseMessage = $("#responseMessage");
                        
                        $('.js-preloader').addClass('d-none');

                        responseIcon.attr("class",
                            "nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"
                            );
                        responseTitle.text("Error");
                        responseMessage.text("An unexpected error occurred. Please try again.");

                        $('#responseModal').modal('show');
                    }
                });
            });
        });

        function datatable1() {
            loanId = {{ $data->id }};
            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: "{{ route('loan.details', ['id' => $data->id]) }}",
                "order": [
                    [0, "desc"]
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
                        "mData": "date",
                    },
                    {
                        "mData": "document_name",
                    },
                    {
                        "mData": "document_url",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ asset('storage/app/public') }}/' + data + '" target="_blank" style="font-size:22px"><em class="icon ni ni-file-pdf"></em></a>';
                        }
                    },
                ]
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
    </script>
@endsection
