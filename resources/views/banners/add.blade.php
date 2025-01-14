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
                    <h3 class="nk-block-title page-title">Add Banner</h3>
                    <div class="nk-block-des">
                        <p>Create new banner</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('banners/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="banner_image">Image (320x145)</label>
                                    <div class="form-control-wrap">
                                        <input type="file"
                                            class="form-control form-control-lg @error('banner_image') is-invalid @enderror"
                                            name="banner_image" id="banner_image" value="{{ old('banner_image') }}">
                                        @error('banner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="banner_link">Banner Link</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('banner_link') is-invalid @enderror"
                                            name="banner_link" id="banner_link" value="{{ old('banner_link') }}" placeholder="Banner Link">
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
