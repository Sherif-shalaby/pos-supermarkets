<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">


        <x-modal-header>

            <h5 class="modal-title" id="same_job_employee">@lang('lang.same_job_employee')</h5>
        </x-modal-header>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('lang.employee_name')</th>
                                <th>@lang('lang.job_title')</th>
                                <th>@lang('lang.date_of_work_start')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->job_title}}</td>
                                <td>{{@format_date($employee->date_of_start_working)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary col-12" data-dismiss="modal">Close</button>
        </div>

    </div>
</div>
