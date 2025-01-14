@extends('layouts.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('banners/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">Edit Banner</h3>
                    <div class="nk-block-des">
                        <p>Update banner details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('banners/edit') }}/{{ $data->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="banner_image">Image (320x145)</label>
                                    <div class="form-control-wrap">
                                        <input type="file"
                                            class="form-control form-control-lg form-control-outlined @error('banner_image') is-invalid @enderror"
                                            name="banner_image" id="banner_image" value="{{ old('banner_image', $data->banner_image) }}">
                                        @error('banner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-control-wrap mt-3">
                                        <img id="image-preview"
                                            src="{{ ($data->banner_image) ? asset('storage/app/public/' . $data->banner_image) : asset('assets/images/default-image.jpg') }}"
                                            alt="Image Preview" style="max-width: 100%; max-height: 130px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="banner_link">Banner Link</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('banner_link') is-invalid @enderror"
                                            name="banner_link" id="banner_link" value="{{ old('banner_link', $data->banner_link) }}" placeholder="Banner Link">
                                        @error('banner_link')
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
        document.getElementById('banner_image').addEventListener('change', function(event) {
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