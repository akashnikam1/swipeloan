@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('partners/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">Edit Partner</h3>
                    <div class="nk-block-des">
                        <p>Update partner details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('partners/edit') }}/{{ $data->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <label class="form-label" for="partner_name">Partner Name</label>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('partner_name') is-invalid @enderror"
                                            name="partner_name" id="partner_name" value="{{ old('partner_name', $data->partner_name) }}" placeholder="Partner Name">
                                        @error('partner_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="partner_image">Image (85x85)</label>
                                    <div class="form-control-wrap">
                                        <input type="file"
                                            class="form-control form-control-lg @error('partner_image') is-invalid @enderror"
                                            name="partner_image" id="partner_image" value="{{ old('partner_image') }}">
                                        @error('partner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-control-wrap mt-3">
                                        <img id="image-preview"
                                            src="{{ ($data->partner_image) ? asset('storage/app/public/' . $data->partner_image) : asset('assets/images/default-image.jpg') }}"
                                            alt="Image Preview" style="max-width: 100%; max-height: 130px;">
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
        document.getElementById('partner_image').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection