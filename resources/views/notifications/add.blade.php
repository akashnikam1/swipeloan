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
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub" onmouseover="this.style.color='#5664D9';"
                        onmouseout="this.style.color='#667692';"><a class="back-to" href="{{ url('notifications/all') }}"
                            style="cursor:pointer;"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    </div>
                    <h3 class="nk-block-title page-title">Add Notification</h3>
                    <div class="nk-block-des">
                        <p>Create new notification</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg mt-3">
            <div class="card card-bordered card-preview col-sm-8">
                <div class="card-inner">
                    <form method="POST" action="{{ url('notifications/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control form-control-lg @error('title') is-invalid @enderror"
                                            name="title" id="title" value="{{ old('title') }}" placeholder="Title" >
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
                                        <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
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
                                            class="form-control form-control-lg @error('image') is-invalid @enderror"
                                            name="image" id="image" value={{ old('image') }}>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="form-label" for="send_notification_to">Send Notification To <span id="userCount" class="text-base">(Total Users - 0)</span></label>
                                <div class="form-group">
                                    @foreach ($notification_conditions as $condition)
                                        <div class="custom-control custom-control-sm custom-radio">
                                            <input type="radio" {{ old('notification_filter_conditions_id') == $condition->id ? 'checked' : '' }} id="customRadio{{ $condition->id }}" name="notification_filter_conditions_id" class="custom-control-input" value="{{ $condition->id }}" data-condition="{{ $condition->id }}">
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
                                            name="regDayValue" id="regDayInput" value="{{ old('regDayValue') }}" placeholder="Number of Days" >
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
                                            name="closedDayValue" id="closedDayInput" value="{{ old('closedDayValue') }}" placeholder="Number of Days" >
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
                                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var oldConditionId = "{{ old('notification_filter_conditions_id') }}";

            if (oldConditionId == 1) {
                updateCount(null, 1);
            } else if (oldConditionId == 2) {
                $('#regDaysInput').show();
                var regDayValue = "{{ old('regDayValue') }}";
                updateCount(regDayValue ? regDayValue : '', 2);
            } else if (oldConditionId == 3) {
                $('#closedDaysInput').show();
                var closedDayValue = "{{ old('closedDayValue') }}";
                updateCount(closedDayValue ? closedDayValue : '', 3);
            } else if (oldConditionId == 4) {
                $('#searchAndSelect').show();
                var userId = "{{ old('user_id') }}";
                populateOldSelectField();
                updateCount(userId ? userId : '', 4);
            }

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

            $('input[name="notification_filter_conditions_id"]').change(function() {
                var conditionId = $(this).data('condition');
                $('#userCount').text("(Total Users - 0)");
                $('#search_input').val('');
                
                if(oldConditionId != conditionId)
                {
                    $('#regDaysInput input').val('');
                    $('#closedDaysInput input').val('');
                    $('#user_select').val('select_user');
                } else {
                    if(oldConditionId == 2) {
                        $('#regDaysInput input').val({{ old('regDayValue') }});
                        var regDayValue = "{{ old('regDayValue') }}";
                        updateCount(regDayValue ? regDayValue : '', 2);
                    } else if(oldConditionId == 3) {
                        $('#closedDaysInput input').val({{ old('closedDayValue') }});
                        var closedDayValue = "{{ old('closedDayValue') }}";
                        updateCount(closedDayValue ? closedDayValue : '', 3);
                    } else if(oldConditionId == 4) {
                        var userId = "{{ old('user_id') }}";
                        populateOldSelectField();
                        updateCount(userId ? userId : '', 4);
                    }
                }

                if(conditionId == 1) {
                    updateCount(null, 1);
                }

                if (conditionId == 2) {
                    $('#regDaysInput').show();
                    $('#closedDaysInput').hide();
                    $('#searchAndSelect').hide();
                } else if(conditionId == 3) {
                    $('#closedDaysInput').show();
                    $('#regDaysInput').hide();
                    $('#searchAndSelect').hide();
                } else if(conditionId == 4) {
                    $('#regDaysInput').hide();
                    $('#closedDaysInput').hide();
                    $('#searchAndSelect').show();
                    populateSelectField();
                }  else {
                    $('#regDaysInput').hide();
                    $('#closedDaysInput').hide();
                    $('#searchAndSelect').hide();
                }
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
                                    var fullName = user.first_name && user.last_name ?
                                                user.first_name + ' ' + user.last_name + ' - ' + user.phone_number :
                                                user.phone_number;
                                    var option = $('<option>', {
                                        value: user.id,
                                        text: fullName
                                    });

                                    $('#user_select').append(option);
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    } else {
                        $('#user_select').empty(); 
                        $('#user_select').append('<option value="select_user" disabled selected>Select User</option>');
                    }
                });
            }
        });
    </script>
@endsection
