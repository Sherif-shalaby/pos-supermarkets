@extends('layouts.app')
@section('title', __('lang.due_report'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content') <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1 no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 print-title position-relative" style="margin-right: 30px">
                            @lang('lang.due_report')
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
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_date', __('lang.end_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_date', request()->end_date, [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>

                                    @if (session('user.is_superadmin'))
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('store_id', __('lang.store'), []) !!}
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

                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                    </div>
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <a href="{{ action('ReportController@getDueReport') }}"
                                            class="btn btn-danger col-md-12 ">@lang('lang.clear_filter')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.date')</th>
                                            <th>@lang('lang.reference')</th>
                                            <th>@lang('lang.customer')</th>
                                            <th class="sum">@lang('lang.amount')</th>
                                            <th class="sum">@lang('lang.paid')</th>
                                            <th class="sum">@lang('lang.due')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $total_paid = 0;
                                            $total_due = 0;
                                        @endphp
                                        @foreach ($dues as $due)
                                            <tr>
                                                <td>{{ @format_date($due->transaction_date) }}</td>
                                                <td> {{ $due->invoice_no }}</td>
                                                <td> {{ $due->customer->name ?? '' }}</td>
                                                <td> {{ @num_format($due->final_total) }}</td>
                                                <td> {{ @num_format($due->transaction_payments->sum('amount')) }}</td>
                                                <td> {{ @num_format($due->final_total - $due->transaction_payments->sum('amount')) }}
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
                                                            {{-- @can('sale.pos.create_and_edit')
                                                <li>

                                                    <a data-href="{{action('SellController@print', $due->id)}}"
                                            class="btn print-invoice"><i class="dripicons-print"></i>
                                            @lang('lang.generate_invoice')</a>
                                            </li>
                                            <li class="divider"></li>
                                            @endcan --}}
                                                            @can('sale.pos.view')
                                                                <li>

                                                                    <a data-href="{{ action('SellController@show', $due->id) }}"
                                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                                            class="fa fa-eye"></i>
                                                                        @lang('lang.view')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('sale.pos.create_and_edit')
                                                                <li>

                                                                    <a href="{{ action('SellController@edit', $due->id) }}"
                                                                        class="btn"><i class="dripicons-document-edit"></i>
                                                                        @lang('lang.edit')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('return.sell_return.create_and_edit')
                                                                <li>
                                                                    <a href="{{ action('SellReturnController@add', $due->id) }}"
                                                                        class="btn"><i class="fa fa-undo"></i>
                                                                        @lang('lang.sale_return')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('sale.pay.create_and_edit')
                                                                @if ($due->payment_status != 'paid')
                                                                    <li>
                                                                        <a data-href="{{ action('TransactionPaymentController@addPayment', ['id' => $due->id]) }}"
                                                                            data-container=".view_modal"
                                                                            class="btn btn-modal"><i class="fa fa-plus"></i>
                                                                            @lang('lang.add_payment')</a>
                                                                    </li>
                                                                @endif
                                                            @endcan
                                                            @can('sale.pay.view')
                                                                @if ($due->payment_status != 'pending')
                                                                    <li>
                                                                        <a data-href="{{ action('TransactionPaymentController@show', $due->id) }}"
                                                                            data-container=".view_modal"
                                                                            class="btn btn-modal"><i class="fa fa-money"></i>
                                                                            @lang('lang.view_payments')</a>
                                                                    </li>
                                                                @endif
                                                            @endcan
                                                            @can('sale.pos.delete')
                                                                <li>
                                                                    <a data-href="{{ action('SellController@destroy', $due->id) }}"
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
                                                $total_paid += $due->transaction_payments->sum('amount');
                                                $total_due +=
                                                    $due->final_total - $due->transaction_payments->sum('amount');
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th style="text-align: right">@lang('lang.total')</th>
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
