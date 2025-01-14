@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';">
                        <a class="back-to" href="{{ url('nbfc/all') }}" style="cursor:pointer;">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>Back</span>
                        </a>
                    </div>
                    <h3 class="nk-block-title page-title">Edit NBFC</h3>
                    <div class="nk-block-des">
                        <p>Update nbfc details</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                            <em class="icon ni ni-menu-alt-r"></em>
                        </a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt d-none d-sm-block" data-bs-toggle="modal"
                                    data-bs-target="#transactionModal">
                                    <button class="btn btn-outline-danger">
                                        <em class="icon ni ni-edit"></em>
                                        <span>Add Transaction</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <form method="POST" action="{{ url('nbfc/edit') }}/{{ $data->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="nbfc_name">NBFC Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('nbfc_name') is-invalid @enderror"
                                            name="nbfc_name" id="nbfc_name" value="{{ old('nbfc_name', $data->nbfc_name) }}"
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
                                        <input type="text"
                                            class="form-control form-control-lg @error('payment_limit') is-invalid @enderror"
                                            name="payment_limit" id="payment_limit"
                                            value="{{ old('payment_limit', $data->payment_limit) }}"
                                            placeholder="Payment Limit" readonly>
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
                                            name="razorpay_key" id="razorpay_key"
                                            value="{{ old('razorpay_key', $data->razorpay_key) }}"
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
                                            name="razorpay_secret" id="razorpay_secret"
                                            value="{{ old('razorpay_secret', $data->razorpay_secret) }}"
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
                                            name="razorpayX_key" id="razorpayX_key"
                                            value="{{ old('razorpayX_key', $data->razorpayX_key) }}"
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
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <h5 class="title mt-3">Transaction History</h5>

                    <div class="nk-block nk-block-lg mt-3">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Transaction Date</th>
                                            <th>Amount (₹)</th>
                                            <th>Transaction Type</th>
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

    {{-- Transaction Modal --}}

    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('nbfc/update-transaction') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <input type="hidden" name="nbfc_id" value="{{ $data->id }}">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="amount">Amount (₹)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('amount') is-invalid @enderror"
                                            name="amount" id="amount" value="{{ old('amount') }}"
                                            placeholder="Amount">
                                        <em id="paymentLimitInWords" class="text-primary text-italic"></em>
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="transaction_type">Transaction Type</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('transaction_type') is-invalid @enderror"
                                            data-ui="lg" data-search="on" name="transaction_type"
                                            id="transaction_type">
                                            <option value="select_transaction_type" selected disabled>Select Transaction
                                                Type</option>
                                            <option {{ old('transaction_type') == 'ADD' ? 'selected' : '' }}
                                                value="ADD">
                                                Add</option>
                                            <option {{ old('transaction_type') == 'DEDUCT' ? 'selected' : '' }}
                                                value="DEDUCT">Deduct</option>
                                        </select>
                                        @error('transaction_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
@section('scriptJs')
    <script>
        @if ($errors->any())
            const transactionModal = new bootstrap.Modal(document.getElementById('transactionModal'));
            transactionModal.show();
        @endif

        $(document).ready(function() {
            const oldPaymentLimit = "{{ old('payment_limit') ?? ($data->payment_limit ?? '') }}";

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

        $(document).ready(function() {
            datatable1();
        });

        function datatable1() {
            NioApp.DataTable('#myTable', {
                "processing": true,
                "serverSide": true,
                "searching": true,
                "bLengthChange": true,

                ajax: "{{ route('nbfc.edit', ['id' => $data->id]) }}",
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

                "columns": [{
                        "mData": "created_at",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        "mData": "amount",
                    },
                    {
                        "mData": "transaction_type",
                    },
                ]
            });
        }
    </script>
@endsection
