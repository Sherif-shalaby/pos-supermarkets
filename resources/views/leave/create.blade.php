<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">


        <x-modal-header>

            <h5 class="modal-title" id="leave">@lang('lang.leave')</h5>
        </x-modal-header>
        {!! Form::open(['url' => action('LeaveController@store'), 'method' => 'post', 'enctype' =>
        'multipart/form-data']) !!}
        <div class="modal-body">
            <div class="row locale_dir">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="locale_label mb-1" for="employee_id">@lang('lang.employee')</label>
                        @if (auth()->user()->can('superadmin') || auth()->user()->is_admin == 1)
                        {!! Form::select('employee_id', $employees, $this_employee_id, ['class' => 'form-control
                        selectpicker', 'id' =>
                        'employee_id', 'required', 'placeholder' => __('lang.please_select'), 'data-live-search' =>
                        'true']) !!}
                        @else
                        {!! Form::select('employee_id', $employees, $this_employee_id, ['class' => 'form-control
                        selectpicker',
                        'id' =>
                        'employee_id', 'required', 'placeholder' => __('lang.please_select'), 'data-live-search' =>
                        'true', 'readonly']) !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-2 jobtypes hide">
                <h5 id="employee_name" class="col-md-6"></h5>
                <h5 id="joing_date" class="col-md-6"></h5>
                <h5 id="job_title" class="col-md-6"></h5>
                <h5 id="no_of_emplyee_same_job" class="col-md-6"></h5>
                <h5 id="leave_balance" class="col-md-6"></h5>

                <div class="leave_balance_details col-md-12"></div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="locale_label mb-1" for="leave_type_id">@lang('lang.select_type_of_leave')</label>
                        {!! Form::select('leave_type_id', $leave_types, false, ['class' => 'form-control', 'required',
                        'placeholder' => 'Please Select']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="locale_label mb-1" for="start_date">@lang('lang.start_date')</label>
                    <input class="form-control" type="date" id="start_date" name="start_date" required>
                </div>
                <div class="col-md-4">
                    <label class="locale_label mb-1" for="end_date">@lang('lang.end_date')</label>
                    <input class="form-control" type="date" id="end_date" name="end_date" required>
                </div>
                <div class="col-md-4">
                    <label class="locale_label mb-1" for="rejoining_date">@lang('lang.rejoining_date')</label>
                    <input class="form-control" type="date" id="rejoining_date" name="rejoining_date" required>
                </div>
                <div class="col-md-4">
                    <label class="locale_label mb-1" for="paid_or_not_paid">@lang('lang.paid_not_paid')</label>
                    {!! Form::select('paid_or_not_paid', ['paid' => 'Paid', 'not_paid' => 'Not Paid'], null, ['class' =>
                    'form-control', 'placeholder' => 'Please Select', 'id' => 'paid_or_not_paid', 'required']) !!}
                </div>
                <div class="col-md-4 if_paid hide">
                    <label class="locale_label mb-1" for="amount_to_paid">@lang('lang.amount_to_paid')</label>
                    {!! Form::text('amount_to_paid', null, ['class' => 'form-control', 'placeholder' =>
                    __('lang.amount_to_paid'), 'id' => 'amount_to_paid']) !!}
                </div>
                <div class="col-md-4 if_paid hide">
                    <label class="locale_label mb-1" for="payment_date">@lang('lang.payment_date')</label>
                    {!! Form::text('payment_date', null, ['class' => 'form-control datepicker', 'placeholder' =>
                    __('lang.payment_date'), 'id' => 'payment_date']) !!}
                </div>
                <div class="col-md-4">
                    <label class="locale_label mb-1" for="upload_files">@lang('lang.upload_files')</label><br>
                    {!! Form::file('upload_files', null, ['class' => 'form-control', 'placeholder' =>
                    __('lang.upload_files'), 'id' => 'upload_files']) !!}
                </div>
                <div class="col-md-12">
                    <label class="locale_label mb-1" for="details">@lang('lang.details')</label>
                    {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' =>
                    __('lang.details'), 'id' => 'details']) !!}
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang('lang.save')</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    $('.selectpicker').selectpicker('render');
    $('#employee_id').change(function(){
        employee_id = $(this).val();
        if(employee_id != '' &&  employee_id != null &&  employee_id != undefined){
            $('.jobtypes').removeClass('hide');
        }else{
            $('.jobtypes').addClass('hide');
        }

        $.ajax({
            method: 'get',
            url: '/get-employee-details-by-id/'+employee_id,
            data: {  },
            success: function(result) {
                $('#employee_name').text('Name: '+result.employee.name);
                $('#joing_date').text('Joining Date: '+result.employee.date_of_start_working);
                $('#job_title').text('Job Type: ' + result.employee.job_title);
                $('#no_of_emplyee_same_job').html(`Number of colleagues in same job: <a style="cursor: pointer;" data-href="/get-same-job-employee-details/${employee_id}" data-container=".second_modal" class="btn-modal"> ${result.no_of_emplyee_same_job} </a>`) ;
                $('#leave_balance').text('Leave Balance: ' + result.leave_balance);
            },
        });
        $.ajax({
            method: 'get',
            url: '/get-balance-leave-details/'+employee_id,
            data: {  },
            contentType: 'html',
            success: function(result) {
                $('.leave_balance_details').empty().append(result);
            },
        });
    })

    $(document).ready(function(){
        $('#employee_id').change()
    })

    $('#paid_or_not_paid').change(function(){
        if($(this).val() === 'paid'){
            $('#amount_to_paid').attr('required', true);
            $('#payment_date').attr('required', true);
            $('.if_paid').removeClass('hide');
        }else{
            $('#amount_to_paid').attr('required', false);
            $('#payment_date').attr('required', false);
            $('.if_paid').addClass('hide');
        }
    })
</script>
