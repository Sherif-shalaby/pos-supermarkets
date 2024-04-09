@extends('layouts.app')
@section('title', __('lang.all_invoices'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="col-md-12 px-1 no-print">
                <div
                    class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">

                    <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.all_invoices')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                <div class="card my-3">
                    <div class="card-body p-2">
                        <form action="">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

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
                                        {!! Form::label('payment_status', __('lang.payment_status'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('payment_status', $payment_status_array, request()->status, [
                                            'class' => 'form-control',
                                            'placeholder' => __('lang.all'),
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>

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
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        time_picker sale_filter',
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
                                            'class' => 'form-control time_picker  modal-input app()->isLocale("ar") ? text-end : text-start
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        sale_filter',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn col-md-12 btn-main ">@lang('lang.filter')</button>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    <a href="{{ action('QuotationController@viewAllInvoices') }}"
                                        class="btn col-md-12 btn-danger">@lang('lang.clear_filter')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="table-responsive no-print">
                        <table id="sales_table" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.reference')</th>
                                    <th>@lang('lang.created_by')</th>
                                    <th>@lang('lang.customer')</th>
                                    <th>@lang('lang.store')</th>
                                    <th>@lang('lang.payment_status')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ @format_date($sale->transaction_date) }}</td>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>{{ ucfirst($sale->created_by_user->name ?? '') }}</td>
                                        <td>
                                            @if (!empty($sale->customer))
                                                {{ $sale->customer->name }}
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($sale->store->name ?? '') }}</td>
                                        <td>{{ ucfirst($sale->payment_status) }}</td>
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
                                                    @can('sale.sale.create_and_edit')
                                                        <li>
                                                            <a href="{{ action('SellController@edit', $sale->id) }}"
                                                                class="btn print-invoice"><i class="dripicons-document"></i>
                                                                @lang('lang.create_invoice')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('squotation_for_customers.quotation.view')
                                                        <li>

                                                            <a data-href="{{ action('QuotationController@show', $sale->id) }}"
                                                                data-container=".view_modal" class="btn btn-modal"><i
                                                                    class="fa fa-eye"></i>
                                                                @lang('lang.view')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('squotation_for_customers.quotation.create_and_edit')
                                                        <li>

                                                            <a href="{{ action('QuotationController@edit', $sale->id) }}"
                                                                class="btn"><i class="dripicons-document-edit"></i>
                                                                @lang('lang.edit')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan

                                                    @can('squotation_for_customers.quotation.delete')
                                                        <li>
                                                            <a data-href="{{ action('QuotationController@destroy', $sale->id) }}"
                                                                data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
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

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- This will be printed -->
    <section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection

@section('javascript')
    <script>
        $(document).on('click', '.print-invoice', function() {
            $.ajax({
                method: 'get',
                url: $(this).data('href'),
                data: {},
                success: function(result) {
                    if (result.success) {
                        pos_print(result.html_content);
                    }
                },
            });
        })

        function pos_print(receipt) {
            $("#receipt_section").html(receipt);
            __currency_convert_recursively($("#receipt_section"));
            __print_receipt("receipt_section");
        }

        table
            .column('0:visible')
            .order('desc')
            .draw();
    </script>
@endsection
