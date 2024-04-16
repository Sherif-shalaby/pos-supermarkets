@extends('layouts.app')
@section('title', __('lang.expected_receivable_report'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1  no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.expected_receivable_report')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <form action="">
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_date', __('lang.start_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_date', request()->start_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_time', __('lang.start_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_time', request()->start_time, [
                                                'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                time_picker sale_filter  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_date', __('lang.end_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_date', request()->end_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_time', __('lang.end_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_time', request()->end_time, [
                                                'class' => 'form-control time_picker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                sale_filter  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('customer_id', __('lang.customer'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select('customer_id', $customers, request()->customer_id, [
                                                'class' => 'form-control',
                                                'placeholder' => __('lang.all'),
                                                'data-live-search' => 'true',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('customer_type_id', __('lang.customer_type'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select('customer_type_id', $customer_types, request()->customer_type_id, [
                                                'class' => 'form-control',
                                                'placeholder' => __('lang.all'),
                                                'data-live-search' => 'true',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @if (session('user.is_superadmin'))
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('store_id', __('lang.store'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('store_id', $stores, request()->store_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('lang.all'),
                                                    'data-live-search' => 'true',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('pos_id', __('lang.pos'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('pos_id', $store_pos, request()->pos_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('lang.all'),
                                                    'data-live-search' => 'true',
                                                ]) !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('product_id', __('lang.product'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select('product_id', $products, request()->product_id, [
                                                'class' => 'form-control',
                                                'placeholder' => __('lang.all'),
                                                'data-live-search' => 'true',
                                            ]) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                    </div>
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <a href="{{ action('ReportController@getExpectedReceivableReport') }}"
                                            class="btn btn-danger col-md-12 ">@lang('lang.clear_filter')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-2">
                        <div class="card-body p-2">


                            <div class="table-responsive">
                                <table id="sales_table" class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.date')</th>
                                            <th>@lang('lang.reference')</th>
                                            <th>@lang('lang.customer')</th>
                                            <th>@lang('lang.sale_status')</th>
                                            <th>@lang('lang.payment_status')</th>
                                            <th class="sum">@lang('lang.amount')</th>
                                            <th class="sum">@lang('lang.total_paid')</th>
                                            <th class="sum">@lang('lang.due')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_paid = 0;
                                            $total_due = 0;
                                        @endphp
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ @format_date($sale->transaction_date) }}</td>
                                                <td>{{ $sale->invoice_no }} @if (!empty($sale->return_parent))
                                                        <a data-href="{{ action('SellReturnController@show', $sale->id) }}"
                                                            data-container=".view_modal" class="btn btn-modal"
                                                            style="color: #007bff;">R</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($sale->customer))
                                                        {{ $sale->customer->name }}
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst($sale->status) }}</td>
                                                <td>
                                                    @if (!empty($payment_status_array[$sale->payment_status]))
                                                        {{ $payment_status_array[$sale->payment_status] }}
                                                    @endif
                                                </td>
                                                <td>{{ @num_format($sale->final_total) }}</td>
                                                </td>
                                                <td>{{ @num_format($sale->transaction_payments->sum('amount')) }}</td>
                                                </td>
                                                <td>{{ @num_format($sale->final_total - $sale->transaction_payments->sum('amount')) }}
                                                </td>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-default btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">@lang('lang.action')
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                            user="menu">
                                                            @can('sale.pos.view')
                                                                <li>

                                                                    <a data-href="{{ action('SellController@show', $sale->id) }}"
                                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                                            class="fa fa-eye"></i>
                                                                        @lang('lang.view')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('sale.pos.create_and_edit')
                                                                <li>

                                                                    <a href="{{ action('SellController@edit', $sale->id) }}"
                                                                        class="btn"><i class="dripicons-document-edit"></i>
                                                                        @lang('lang.edit')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('return.sell_return.create_and_edit')
                                                                <li>
                                                                    <a href="{{ action('SellReturnController@add', $sale->id) }}"
                                                                        class="btn"><i class="fa fa-undo"></i>
                                                                        @lang('lang.sale_return')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('sale.pay.create_and_edit')
                                                                @if ($sale->payment_status != 'paid')
                                                                    <li>
                                                                        <a data-href="{{ action('TransactionPaymentController@addPayment', ['id' => $sale->id]) }}"
                                                                            data-container=".view_modal"
                                                                            class="btn btn-modal"><i class="fa fa-plus"></i>
                                                                            @lang('lang.add_payment')</a>
                                                                    </li>
                                                                @endif
                                                            @endcan
                                                            @can('sale.pay.view')
                                                                @if ($sale->payment_status != 'pending')
                                                                    <li>
                                                                        <a data-href="{{ action('TransactionPaymentController@show', $sale->id) }}"
                                                                            data-container=".view_modal"
                                                                            class="btn btn-modal"><i class="fa fa-money"></i>
                                                                            @lang('lang.view_payments')</a>
                                                                    </li>
                                                                @endif
                                                            @endcan
                                                            @can('sale.pos.delete')
                                                                <li>
                                                                    <a data-href="{{ action('SellController@destroy', $sale->id) }}"
                                                                        data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                        class="btn text-red delete_item"><i
                                                                            class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $total_paid += $sale->transaction_payments->sum('amount');
                                                $total_due +=
                                                    $sale->final_total - $sale->transaction_payments->sum('amount');
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th style="text-align: right">@lang('lang.totals')</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')

@endsection
