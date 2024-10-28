@extends('layouts.app')
@section('title', __('lang.cash_out_adjustment'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">

        <x-page-title>

            <h3 class="print-title">@lang('lang.cash_out_adjustment')</h3>

            <x-slot name="buttons">

            </x-slot>
        </x-page-title>

        <div
            class="top-controls py-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">

        </div>
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>@lang('lang.date_and_time')</th>
                                <th>@lang('lang.store')</th>
                                <th>@lang('lang.cashier')</th>
                                <th class="sum">@lang('lang.adjustment_value')</th>
                                <th>@lang('lang.created_by')</th>
                                <th>@lang('lang.title_of_creator')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash_out_adjustments as $adjustment)
                            <tr>
                                <td>{{@format_datetime($adjustment->date_and_time)}}</td>
                                <td>{{$adjustment->store->name ?? ''}}</td>
                                <td>{{$adjustment->cashier->name ?? ''}}</td>
                                <td>{{@num_format($adjustment->discrepancy)}}</td>
                                <td>{{$adjustment->created_by_user->name ?? ''}}</td>
                                <td>@if(!empty($adjustment->created_by_user->employee->job_type)){{$adjustment->created_by_user->employee->job_type->job_title}}@endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">@lang('lang.action')
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                            user="menu">
                                            @can('adjustment.cash_out_adjustment.create_and_edit')
                                            <li>

                                                <a href="{{action('CashOutAdjustmentController@edit', $adjustment->id)}}"
                                                    class="btn"><i class="dripicons-document-edit"></i>
                                                    @lang('lang.edit')</a>
                                            </li>
                                            <li class="divider"></li>
                                            @endcan
                                            @can('adjustment.cash_out_adjustment.delete')
                                            <li>
                                                <a data-href="{{action('CashOutAdjustmentController@destroy', $adjustment->id)}}"
                                                    data-check_password="{{action('UserController@checkPassword', Auth::user()->id)}}"
                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                    @lang('lang.delete')</a>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <th style="text-align: right">@lang('lang.total')</th>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div
            class="bottom-controls mt-1 p-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">
            <!-- Pagination and other controls can go here -->
        </div>


    </div>

</section>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection