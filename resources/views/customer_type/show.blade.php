@extends('layouts.app')
@section('title', __('lang.customer_details'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1 no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.customer_details')
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
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                    </div>
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <a href="{{ action('CustomerTypeController@show', $customer_type->id) }}"
                                            class="btn btn-danger col-md-12">@lang('lang.clear_filter')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-2">
                        <div class="card-body p-2">

                            <ul class="nav mb-2 nav-tabs  @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (empty(request()->show) || request()->show == 'customers') active @endif" href="#customers"
                                        role="tab" data-toggle="tab">@lang('lang.customers')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->show == 'discounts') active @endif"
                                        href="#store-discount" role="tab" data-toggle="tab">@lang('lang.discounts')</a>
                                </li>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel"
                                    class="tab-pane fade @if (empty(request()->show) || request()->show == 'customers') show active @endif"
                                    id="customers">
                                    <div class="table-responsive">
                                        <table id="store_table" class="table dataTable">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang.customer_type')</th>
                                                    <th>@lang('lang.name')</th>
                                                    <th>@lang('lang.photo')</th>
                                                    <th>@lang('lang.mobile_number')</th>
                                                    <th>@lang('lang.address')</th>
                                                    <th>@lang('lang.joining_date')</th>
                                                    <th>@lang('lang.created_by')</th>
                                                    <th class="notexport">@lang('lang.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td>{{ $customer->customer_type->name }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>
                                                            @if (!empty($customer->getFirstMediaUrl('customer_photo')))
                                                                <img src="{{ $customer->getFirstMediaUrl('customer_photo') }}"
                                                                    alt="photo" width="50" height="50">
                                                            @endif
                                                        </td>
                                                        <td>{{ $customer->mobile_number }}</td>
                                                        <td>{{ $customer->address }}</td>
                                                        <td>{{ @format_date($customer->created_at) }}</td>
                                                        <td>{{ $customer->created_by_user->name ?? '' }}</td>
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
                                                                    @can('customer_module.customer.view')
                                                                        <li>
                                                                            <a href="{{ action('CustomerController@show', $customer->id) }}"
                                                                                class="btn">
                                                                                <i class="dripicons-document"></i>
                                                                                @lang('lang.view')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan
                                                                    @can('customer_module.customer.edit')
                                                                        <li>
                                                                            <a
                                                                                href="{{ action('CustomerController@edit', $customer->id) }}"><i
                                                                                    class="dripicons-document-edit btn"></i>@lang('lang.edit')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan
                                                                    @can('adjustment.customer_balance_adjustment.create_and_edit')
                                                                        <li>
                                                                            <a href="{{ action('CustomerBalanceAdjustmentController@create', ['customer_id' => $customer->id]) }}"
                                                                                class="btn"><i class="fa fa-adjust"></i>
                                                                                @lang('lang.adjust_customer_balance')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan
                                                                    @can('adjustment.customer_point_adjustment.create_and_edit')
                                                                        <li>

                                                                            <a href="{{ action('CustomerPointAdjustmentController@create', ['customer_id' => $customer->id]) }}"
                                                                                class="btn"><i class="fa fa-adjust"></i>
                                                                                @lang('lang.adjust_customer_points')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan
                                                                    @can('customer_module.customer.delete')
                                                                        <li>
                                                                            <a data-href="{{ action('CustomerController@destroy', $customer->id) }}"
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div role="tabpanel"
                                    class="tab-pane fade @if (request()->show == 'discounts') show active @endif"
                                    id="store-discount">
                                    <div class="table-responsive">
                                        <table class="table dataTable">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang.date')</th>
                                                    <th>@lang('lang.reference_no')</th>
                                                    <th>@lang('lang.customer')</th>
                                                    <th>@lang('lang.product')</th>
                                                    <th class="sum">@lang('lang.grand_total')</th>
                                                    <th>@lang('lang.status')</th>
                                                    <th>@lang('lang.action')</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $total_discount_payments = 0;
                                                    $total_discount_due = 0;
                                                @endphp
                                                @foreach ($discounts as $discount)
                                                    <tr>
                                                        <td>{{ @format_date($discount->transaction_date) }}</td>
                                                        <td>{{ $discount->invoice_no }}</td>
                                                        <td>
                                                            @if (!empty($discount->customer))
                                                                {{ $discount->customer->name }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @foreach ($discount->transaction_sell_lines as $line)
                                                                ({{ @num_format($line->quantity) }})
                                                                @if (!empty($line->product))
                                                                    {{ $line->product->name }}
                                                                @endif <br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ @num_format($discount->final_total) }}</td>
                                                        </td>
                                                        <td>
                                                            @if ($discount->status == 'final')
                                                                <span class="badge badge-success">@lang('lang.completed')</span>
                                                            @else
                                                                {{ ucfirst($discount->status) }}
                                                            @endif
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
                                                                            <a data-href="{{ action('SellController@show', $discount->id) }}"
                                                                                data-container=".view_modal"
                                                                                class="btn btn-modal"><i class="fa fa-eye"></i>
                                                                                @lang('lang.view')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan
                                                                    @can('sale.pos.create_and_edit')
                                                                        <li>
                                                                            <a href="{{ action('SellController@edit', $discount->id) }}"
                                                                                class="btn"><i
                                                                                    class="dripicons-document-edit"></i>
                                                                                @lang('lang.edit')</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    @endcan

                                                                    @can('sale.pos.delete')
                                                                        <li>
                                                                            <a data-href="{{ action('SellController@destroy', $discount->id) }}"
                                                                                data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                                class="btn text-red delete_item"><i
                                                                                    class="fa fa-trash"></i>
                                                                                @lang('lang.delete')</a>
                                                                        </li>
                                                                    @endcan
                                                                </ul>
                                                            </div>
                                                    </tr>
                                                    @php
                                                        $total_discount_payments += $discount->transaction_payments->sum(
                                                            'amount',
                                                        );
                                                        $total_discount_due +=
                                                            $discount->final_total -
                                                            $discount->transaction_payments->sum('amount');
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align: right">@lang('lang.total')</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


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
