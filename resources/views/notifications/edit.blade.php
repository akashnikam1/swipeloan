@extends('layouts.app')
@section('style')
    <style>
        .error {
            width: 100%;
            margin-top: 0.50rem;
            font-size: 0.875em;
            color: var(--bs-form-invalid-color);
        }
    </style>
@endsection
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            @include('layouts.flash')
            <div class="nk-block-between col-sm-8">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('notifications/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">Edit Notification</h3>
                    <div class="nk-block-des">
                        <p>Update notification details</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt d-none d-sm-block">
                                    <a href="{{ url('notifications/send') }}/{{ $data->id }}" class="btn btn-primary">
                                        <em class="icon ni ni-send"></em>
                                        <span>Send Notification</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('notifications/edit') }}/{{ $data->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('title') is-invalid @enderror"
                                            name="title" id="title" value="{{ old('title', $data->title) }}" placeholder="Title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description', $data->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Image</label>
                                    <div class="form-control-wrap">
                                        <input type="file"
                                            class="form-control form-control-lg form-control-outlined @error('image') is-invalid @enderror"
                                            name="image" id="image" value="{{ old('image') }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-control-wrap mt-3">
                                        <img id="image-preview"
                                            src="{{ ($data->image) ? asset('storage/app/public/' . $data->image) : asset('assets/images/default-image.jpg') }}"
                                            alt="Image Preview" style="max-width: 100%; max-height: 130px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label" for="send_notification_to">Send Notification To <span id="userCount" class="text-base">(Total Users - 0)</span></label>
                                <div class="form-group">
                                    @foreach ($notification_conditions as $condition)
                                        <div class="custom-control custom-control-sm custom-radio">
                                            <input type="radio" id="customRadio{{ $condition->id }}" name="notification_filter_conditions_id" 
                                            class="custom-control-input" value="{{ $condition->id }}" data-condition="{{ $condition->id }}"
                                            @if(old('notification_filter_conditions_id', $data->notification_filter_conditions_id) == $condition->id) checked @endif>
                                            <label class="custom-control-label fs-15px" style="margin: 5px;" for="customRadio{{ $condition->id }}">{{ $condition->filter_condition }}</label>
                                        </div>                                    
                                    @endforeach
                                    @if ($errors->has('notification_filter_conditions_id'))
                                        <span class="error" role="alert">                                       
                                            <strong>{{ $errors->first('notification_filter_conditions_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>          
                            
                            {{-- Registered in last days --}}

                            <div class="col-lg-12" id="regDaysInput" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="regDayInput">Number of Days</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('regDayValue') is-invalid @enderror"
                                            name="regDayValue" id="regDayInput" value="{{ old('regDayValue', $data->value) }}" placeholder="Number of Days" >
                                        @error('regDayValue')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Loan closed in last days --}}

                            <div class="col-lg-12" id="closedDaysInput" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="closedDayInput">Number of Days</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control form-control-lg @error('closedDayValue') is-invalid @enderror"
                                            name="closedDayValue" id="closedDayInput" value="{{ old('closedDayValue', $data->value) }}" placeholder="Number of Days" >
                                        @error('closedDayValue')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Specific User --}}

                            <div class="col-lg-12" id="searchAndSelect" style="display: none;" >
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="search_input">Search User</label>
                                        <div class="form-control-wrap">
                                            <input type="text"
                                                class="form-control form-control-lg @error('search_input') is-invalid @enderror"
                                                name="search_input" id="search_input" value="{{ old('search_input') }}" placeholder="Search User" >
                                            @error('search_input')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="user_select">Name & Phone Number</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 @error('user_id') is-invalid @enderror" data-ui="lg" data-search="on" name="user_id" id="user_select">
                                                <option value="select_user" disabled selected>Select User</option>
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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

@section('scriptJs')
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        $(document).ready(function() {
            function populateOldSelectField() {
                var userId = "{{ old('user_id') }}";

                if (userId) {
                    $.ajax({
                        url: "{{ route('users.fetch') }}",
                        method: 'GET',
                        data: { user_id: userId },
                        success: function(response) {
                            $('#user_select').empty(); 
                            $('#user_select').append('<option value="select_user" disabled selected>Select User</option>'); 

                            response.forEach(function(user) {
                                var fullName = user.first_name && user.last_name ?
                                    `${user.first_name} ${user.last_name} - ${user.phone_number}` :
                                    `${user.phone_number}`;

                                var option = `<option value="${user.id}" ${user.id == userId ? 'selected' : ''}>${fullName}</option>`;

                                $('#user_select').append(option);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            }

            var initialConditionId = "{{ $data->notification_filter_conditions_id }}";
            
            showHideFields(initialConditionId, true);

            $('input[name="notification_filter_conditions_id"]').change(function() {
                var conditionId = $(this).data('condition');
                showHideFields(conditionId, false);
            });

            $('#regDayInput').on('input', function() {
                var regDayValue = $(this).val();
                updateCount(regDayValue, 2);
            });

            $('#closedDayInput').on('input', function() {
                var closedDayValue = $(this).val();
                updateCount(closedDayValue, 3);
            });

            $('#user_select').on('change', function() {
                var userIdValue = $(this).val();
                updateCount(userIdValue, 4);
            });

            function showHideFields(conditionId, isInitialLoad) {
                if(conditionId == 1) {
                    updateCount(null, 1);
                }
                   
                if(conditionId != {{ $data->notification_filter_conditions_id }})
                {
                    $('#userCount').text("(Total Users - 0)");
                }

                if (isInitialLoad) {
                    if (conditionId == 2) {
                        $('#regDaysInput input').val({{$data->value}});
                        $('#closedDaysInput input').val('');
                        $('#user_select').val('select_user');
                        updateCount({{$data->value}}, 2);
                    }
                    if (conditionId == 3) {
                        $('#closedDaysInput input').val({{$data->value}});
                        $('#regDaysInput input').val('');
                        $('#user_select').val('select_user');
                        updateCount({{$data->value}}, 3);
                    }
                    if (conditionId == 4) {
                        updateCount({{$data->value}}, 4);
                        $('#regDaysInput input').val('');
                        $('#closedDaysInput input').val('');
                    }
                } else {
                    $('#search_input').val('');
                }

                $('#regDaysInput').hide();
                $('#closedDaysInput').hide();
                $('#searchAndSelect').hide();

                if (conditionId == 2) {
                    $('#regDaysInput').show();
                    $('#regDaysInput input').val('');
                    if(conditionId == initialConditionId) {
                        $('#regDaysInput input').val({{$data->value}});
                        updateCount({{$data->value}}, 2);
                    }
                } else if (conditionId == 3) {
                    $('#closedDaysInput').show();
                    $('#closedDaysInput input').val('');
                    if(conditionId == initialConditionId) {
                        $('#closedDaysInput input').val({{$data->value}});
                        updateCount({{$data->value}}, 3);
                    }
                } else if (conditionId == 4) {
                    updateCount({{$data->value}}, 4);
                    $('#searchAndSelect').show();
                    populateSelectField();
                }
            }

            var oldConditionId = "{{ old('notification_filter_conditions_id') }}";

            if (oldConditionId == 1) {
                updateCount(null, 1);
                $('#regDaysInput').hide();
                $('#closedDaysInput').hide();
                $('#searchAndSelect').hide();
            } else if (oldConditionId == 2) {
                $('#regDaysInput').show();
                $('#closedDaysInput').hide();
                $('#searchAndSelect').hide();
                $('#userCount').text("(Total Users - 0)");
                var regDayValue = "{{ old('regDayValue') }}";
                $('#regDaysInput input').val({{ old('regDayValue') }});
                if(regDayValue > 0) {
                    updateCount(regDayValue ? regDayValue : 0, 2);
                }
            } else if (oldConditionId == 3) {
                $('#closedDaysInput').show();
                $('#regDaysInput').hide();
                $('#searchAndSelect').hide();
                $('#userCount').text("(Total Users - 0)");
                var closedDayValue = "{{ old('closedDayValue') }}";
                $('#closedDaysInput input').val({{ old('closedDayValue') }});
                if(closedDayValue > 0) {
                    updateCount(closedDayValue ? closedDayValue : 0, 3);
                }
            } else if (oldConditionId == 4) {
                $('#searchAndSelect').show();
                $('#regDaysInput').hide();
                $('#closedDaysInput').hide();
                $('#userCount').text("(Total Users - 0)");
                var userId = "{{ old('user_id') }}";
                if(userId > 0) {
                    populateOldSelectField();
                    updateCount(userId ? userId : 0, 4);
                } 
            }

            function updateCount(value, status) {
                $.ajax({
                    url: "{{ route('calculate.user_count') }}",
                    method: 'GET',
                    data: {
                        value: value,
                        status: status
                    },
                    success: function(response) {
                        $('#userCount').text("(Total Users - " + response.users_count + ")");
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function populateSelectField() {
                var userId = "{{ $data->value }}";

                if (userId) {
                    $.ajax({
                        url: "{{ route('users.fetch') }}",
                        method: 'GET',
                        data: { user_id: userId },
                        success: function(response) {
                            $('#user_select').empty(); 
                            $('#user_select').append('<option value="select_user" disabled selected>Select User</option>'); 

                            response.forEach(function(user) {
                                var fullName = user.first_name && user.last_name ?
                                    `${user.first_name} ${user.last_name} - ${user.phone_number}` :
                                    `${user.phone_number}`;

                                var option = `<option value="${user.id}" ${user.id == userId ? 'selected' : ''}>${fullName}</option>`;

                                $('#user_select').append(option);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }

                $('#search_input').on('input', function() {
                    var searchValue = $(this).val();

                    if (searchValue.length >= 4) {
                        $.ajax({
                            url: "{{ route('users.fetch') }}", 
                            method: 'GET',
                            data: { 
                                search_value: searchValue 
                            },
                            success: function(response) {
                                $('#user_select').empty(); 
                                $('#user_select').append('<option value="select_user" disabled selected>Select User</option>'); 

                                response.forEach(function(user) {
                                    var fullName = (user.first_name ? user.first_name : '') + (user.first_name && user.last_name ? ' ' : '') + (user.last_name ? user.last_name : '');
                                    var optionText = fullName.trim() !== '' ? fullName.trim() + ' - ' + user.phone_number : user.phone_number;
                                    var option = `<option value="${user.id}">${optionText}</option>`;
                                    
                                    $('#user_select').append(option);
                                });

                                if ("{{ $data->notification_filter_conditions_id }}" == 4) {
                                    $('#user_select').val("{{ $data->value }}");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection