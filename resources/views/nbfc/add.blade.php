@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';">
                        <a class="back-to" href="{{ url('nbfc/all') }}" style="cursor:pointer;">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>Back</span>
                        </a>
                    </div>
                    <h3 class="nk-block-title page-title">Add NBFC</h3>
                    <div class="nk-block-des">
                        <p>Create new nbfc</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <form method="POST" action="{{ url('nbfc/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="nbfc_name">NBFC Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('nbfc_name') is-invalid @enderror"
                                            name="nbfc_name" id="nbfc_name" value="{{ old('nbfc_name') }}"
                                            placeholder="NBFC Name">
                                        @error('nbfc_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="payment_limit">Payment Limit (₹)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('payment_limit') is-invalid @enderror"
                                            name="payment_limit" id="payment_limit" value="{{ old('payment_limit') }}"
                                            placeholder="Payment Limit">
                                        <em id="paymentLimitInWords" class="text-primary text-italic"></em>
                                        @error('payment_limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="razorpay_key">Razorpay Key</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('razorpay_key') is-invalid @enderror"
                                            name="razorpay_key" id="razorpay_key" value="{{ old('razorpay_key') }}"
                                            placeholder="Razorpay Key">
                                        @error('razorpay_key')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="razorpay_secret">Razorpay Secret</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('razorpay_secret') is-invalid @enderror"
                                            name="razorpay_secret" id="razorpay_secret" value="{{ old('razorpay_secret') }}"
                                            placeholder="Razorpay Secret">
                                        @error('razorpay_secret')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="razorpayX_key">RazorpayX Key</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('razorpayX_key') is-invalid @enderror"
                                            name="razorpayX_key" id="razorpayX_key" value="{{ old('razorpayX_key') }}"
                                            placeholder="RazorpayX Key">
                                        @error('razorpayX_key')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptJs')
    <script>
        $(document).ready(function() {
            const oldPaymentLimit = "{{ old('payment_limit') }}";

            function convertToWords(paymentLimit) {
                if (paymentLimit) {
                    $.ajax({
                        url: "{{ url('nbfc/convert-to-words') }}",
                        method: 'POST',
                        data: {
                            payment_limit: paymentLimit,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#paymentLimitInWords').text(`${response.in_words}`);
                        },
                        error: function(error) {
                            $('#paymentLimitInWords').text('');
                        }
                    });
                } else {
                    $('#paymentLimitInWords').text('');
                }
            }

            if (oldPaymentLimit) {
                convertToWords(oldPaymentLimit);
            }

            $('#payment_limit').on('input', function() {
                const paymentLimit = $(this).val();
                convertToWords(paymentLimit);
            });
        });
    </script>
@endsection
