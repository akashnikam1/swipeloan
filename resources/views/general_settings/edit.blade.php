@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Edit General Setting</h3>
                    <div class="nk-block-des">
                        <p>Update general setting details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('general_settings/edit') }}/{{ $data->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="referral_amount">Referral Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('referral_amount') is-invalid @enderror"
                                            name="referral_amount" id="referral_amount" value="{{ old('referral_amount', $data->referral_amount) }}" placeholder="Referral Amount">
                                        @error('referral_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="credit_report_amount">Credit Report Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('credit_report_amount') is-invalid @enderror"
                                            name="credit_report_amount" id="credit_report_amount" value="{{ old('credit_report_amount', $data->credit_report_amount) }}" placeholder="Credit Report Amount">
                                        @error('credit_report_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="payment_mode">Payment Mode</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 @error('payment_mode') is-invalid @enderror" data-ui="lg" data-search="on" name="payment_mode" id="payment_mode">
                                            <option value="select_payment_mode" selected disabled>Select Payment Mode</option>
                                            <option {{( old('payment_mode', $data->payment_mode) == 1) ? 'selected' : ''}} value="1">Razorpay</option>
                                            <option {{( old('payment_mode', $data->payment_mode) == 2) ? 'selected' : ''}} value="2">Billdesk</option>
                                        </select>
                                        @error('payment_mode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="home_screen_video_link">Home Screen Video Link</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('home_screen_video_link') is-invalid @enderror"
                                            name="home_screen_video_link" id="home_screen_video_link" value="{{ old('home_screen_video_link', $data->home_screen_video_link) }}" placeholder="Home Screen Video Link">
                                        @error('home_screen_video_link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="version">Version</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('version') is-invalid @enderror"
                                            name="version" id="version" value="{{ old('version', $data->version) }}" placeholder="Version">
                                        @error('version')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 d-flex justify-content-start">
                               <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="is_force_update" value="0">
                                            <input type="checkbox" class="custom-control-input" name="is_force_update"
                                                id="is_force_update" value="1" {{ $data->is_force_update == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_force_update"><strong>Force Update</strong></label>
                                        </div>
                                    </div>
                               </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="pincode_note" value="0">
                                            <input type="checkbox" class="custom-control-input" name="pincode_note"
                                                id="pincode_note" value="1" {{ $data->pincode_note == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="pincode_note"><strong>Pincode Note</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection