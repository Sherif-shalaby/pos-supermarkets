@extends('layouts.app')
@section('title', __('lang.forfeit_leaves'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">

        <x-page-title>

            <h2 class="mb-4 print-title">@lang('lang.list_of_employees_in_forfeit_leave')</h2>


            <x-slot name="buttons">

            </x-slot>
        </x-page-title>

        <div class="row" id="sales">

            <x-collapse collapse-id="Filter" button-class="d-flex btn-secondary" group-class="mb-1" body-class="py-1">

                <x-slot name="button">
                    {{-- @lang('lang.filter') --}}
                    <div style="width: 20px">
                        <img class="w-100" src="{{ asset('front/white-filter.png') }}" alt="">
                    </div>
                </x-slot>
                <div class="col-md-12">
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('start_date', __('lang.start_date'), []) !!}
                                    {!! Form::text('start_date', request()->start_date, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('end_date', __('lang.end_date'), []) !!}
                                    {!! Form::text('end_date', request()->end_date, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button type="submit" class="btn btn-success mt-2">@lang('lang.filter')</button>
                                <a href="{{action('ForfeitLeaveController@index')}}"
                                    class="btn btn-success mt-2">@lang('lang.clear_filter')</a>
                            </div>

                        </div>
                    </form>
                </div>
            </x-collapse>

            <div
                class="top-controls py-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">

            </div>
            <div class="card mt-1 mb-0">
                <div class="card-body py-2 px-4">
                    <div class="table-responsive">
                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.employee_name')</th>
                                    <th>@lang('lang.leave_type')</th>
                                    <th>@lang('lang.year')</th>
                                    <th>@lang('lang.number_of_days')</th>
                                    <th>@lang('lang.who_forfeited')</th>
                                    <th>@lang('lang.upload_files')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($forfeit_leaves as $leave)
                                <tr>
                                    <td>
                                        {{$leave->name}}
                                    </td>
                                    <td>
                                        {{$leave->leave_type_name}}
                                    </td>
                                    <td>
                                        {{$leave->start_date}}
                                    </td>
                                    <td>
                                        {{@num_format($leave->number_of_days)}}
                                    </td>
                                    <td>{{ucfirst($leave->created_by)}}</td>
                                    <td>
                                        <a data-href="{{action('GeneralController@viewUploadedFiles', ['model_name' => 'ForfeitLeave', 'model_id' => $leave->id, 'collection_name' => 'forfeit_leave'])}}"
                                            data-container=".view_modal"
                                            class="btn btn-danger btn-modal text-white">@lang('lang.view')</a>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div
                class="bottom-controls mt-1 p-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">
                <!-- Pagination and other controls can go here -->
            </div>

        </div>
    </div>
</section>
<div class="modal fade second_modal" role="dialog" aria-hidden="true"></div>

@endsection

@section('javascript')
<script>

</script>
@endsection