@if (session('error'))
    <div class="alert alert-fill alert-danger alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-cross-circle"></em>
        <strong>{{ session('error') }}</strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-fill alert-success alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-check-circle"></em>
        <strong>{{ session('success') }}</strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-fill alert-warning alert-icon alert-dismissible" role="alert"><em
            class="icon ni ni-alert-circle"></em>
        <strong>{{ session('warning') }}</strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif
