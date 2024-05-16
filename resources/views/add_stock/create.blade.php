@extends('layouts.app')
@if (!empty($is_raw_material))
    @section('title', __('lang.add_stock_for_raw_material'))
@else
    @section('title', __('lang.add_stock'))
@endif
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    @php
        $clear_all_input_stock_form = App\Models\System::getProperty('clear_all_input_stock_form');
        if ($clear_all_input_stock_form == 0) {
            $transaction_payment = [];
            $recent_stock = [];
        } else {
            $recent_stock = \App\Models\Transaction::where('type', 'add_stock')->orderBy('created_at', 'desc')->first();
            if (!empty($recent_stock)) {
                $transaction_payment = $recent_stock->transaction_payments->first();
            }
        }
    @endphp
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h4 class="mb-0">
                            @if (!empty($is_raw_material))
                                <h4>@lang('lang.add_stock_for_raw_material')</h4>
                            @else
                                <h4>@lang('lang.add_stock')</h4>
                            @endif
                            <span class=" header-pill"></span>
                        </h4>
                    </div>
                    <div class="card mb-2 d-flex flex-row justify-content-around align-items-center ">
                        <div class=" d-flex flex-row justify-content-center align-items-center">
                            <p class="italic mb-0 py-1"><small>@lang('lang.required_fields_info')</small>
                            <div style="width: 30px;height: 30px;">
                                <img class="w-100 h-100" src="{{ asset('front/images/icons/warning.png') }}" alt="warning!">
                            </div>
                            </p>
                        </div>
                        <div>
                            <div class="i-checks">
                                <input id="clear_all_input_form" name="clear_all_input_form" type="checkbox"
                                    @if (isset($clear_all_input_stock_form) && $clear_all_input_stock_form == '1') checked @endif class="form-control-custom">
                                <label for="clear_all_input_form">
                                    <strong>
                                        @lang('lang.clear_all_input_form')
                                    </strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    {!! Form::open([
                        'url' => action('AddStockController@store'),
                        'method' => 'post',
                        'id' => 'add_stock_form',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <input type="hidden" name="batch_count" id="batch_count" value="0">
                    <input type="hidden" name="row_count" id="row_count" value="0">
                    <input type="hidden" name="is_raw_material" id="is_raw_material" value="{{ $is_raw_material }}">
                    <input type="hidden" name="is_add_stock" id="is_add_stock" value="1">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'store_id',
                                            $stores,
                                            !empty($recent_stock) && !empty($recent_stock->store_id) ? $recent_stock->store_id : 'Please Select',
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'required',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        {!! Form::label('supplier_id', __('lang.supplier') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'supplier_id',
                                            $suppliers,
                                            !empty($recent_stock) && !empty($recent_stock->supplier_id) ? $recent_stock->supplier_id : $suppliers,
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'required',
                                                'selected',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <div
                                            class="d-flex align-items-center @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">

                                            {!! Form::label('po_no', __('lang.po_no'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            <div style="width: 30px;height: 30px;">
                                                <img class="w-100 h-100 dripicons-question"
                                                    src="{{ asset('front/images/icons/warning.png') }}" alt="warning!"
                                                    data-toggle="tooltip" title="@lang('lang.po_no_add_stock_info')">
                                            </div>

                                        </div>
                                        {!! Form::select(
                                            'po_no',
                                            $po_nos,
                                            !empty($recent_stock) && !empty($recent_stock->purchase_order_id) ? $recent_stock->purchase_order_id : null,
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        {!! Form::label('status', __('lang.status') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'status',
                                            ['received' => __('lang.received'), 'partially_received' => __('lang.partially_received')],
                                            !empty($recent_stock) && !empty($recent_stock->status) ? $recent_stock->status : 'Please Select',
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'required',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-4 px-5">
                                    {!! Form::label('transaction_date', __('lang.date_and_time'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <input type="datetime-local" id="transaction_date" name="transaction_date"
                                        value="{{ date('Y-m-d\TH:i') }}"
                                        class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif">
                                </div>
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <input type="hidden" name="exchange_rate" id="exchange_rate" value="1">
                                        <input type="hidden" name="default_currency_id" id="default_currency_id"
                                            value="{{ !empty(App\Models\System::getProperty('currency')) ? App\Models\System::getProperty('currency') : '' }}">
                                        {!! Form::label('paying_currency_id', __('lang.paying_currency'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'paying_currency_id',
                                            $exchange_rate_currencies,
                                            !empty(App\Models\System::getProperty('currency')) ? App\Models\System::getProperty('currency') : null,
                                            ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required'],
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="row justify-content-center align-items-center mb-3" style="gap: 10px">
                                <div class="col-md-8">
                                    <div class="search-box input-group modal-input"
                                        style="height: 30px;padding: 0 !important">
                                        <button type="button"
                                            class="btn h-100 d-flex justify-content-center align-items-center"
                                            style="background-color: var(--complementary-color-1)" id="search_button"><i
                                                class="fa fa-search text-white"></i></button>
                                        <input type="text" name="search_product" id="search_product"
                                            placeholder="@lang('lang.enter_product_name_to_print_labels')" class="form-control h-100 ui-autocomplete-input"
                                            style="background-color: transparent" autocomplete="off">
                                        <button type="button"
                                            class="btn text-black d-flex justify-content-center align-items-center btn-modal h-100"
                                            style="background-color: transparent"
                                            data-href="{{ action('ProductController@create') }}?quick_add=1"
                                            data-container=".view_modal"><i class="fa fa-plus text-black"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @include('quotation.partial.product_selection')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-condensed" id="product_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 7%">@lang('lang.image')</th>
                                                <th style="width: 10%">@lang('lang.products')</th>
                                                <th style="width: 10%">@lang('lang.sku')</th>
                                                <th style="width: 10%">@lang('lang.quantity')</th>
                                                <th style="width: 10%">@lang('lang.unit')</th>
                                                <th style="width: 12%">@lang('lang.purchase_price')</th>
                                                <th style="width: 12%">@lang('lang.selling_price')</th>
                                                <th style="width: 10%">@lang('lang.sub_total')</th>
                                                <th style="width: 10%">@lang('lang.new_stock')</th>
                                                <th style="width: 10%">@lang('lang.change_current_stock')</th>
                                                <th style="width: 10%">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="col-md-3">@lang('lang.items_count'): <span class="items_count_span"
                                style="margin-right: 15px;">0</span>
                        </h4>
                        <h4 class="col-md-3">
                            @lang('lang.items_quantity'): <span class="items_quantity_span" style="margin-right: 15px;">0</span>
                        </h4>

                        <div class="col-md-3">
                            <h3> @lang('lang.total'): <span class="final_total_span"></span> </h3>
                            <input type="hidden" name="grand_total" id="grand_total" value="0">
                            <input type="hidden" name="final_total" id="final_total" value="0">
                        </div>
                    </div>
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h6 class="mb-0">
                            @lang('lang.more_info')
                            <span class="header-pill"></span>
                        </h6>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="row  @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('files', __('lang.files'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        <input
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            type="file" name="files[]" id="files" multiple>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('invoice_no', __('lang.invoice_no'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text(
                                            'invoice_no',
                                            !empty($recent_stock) && !empty($recent_stock->invoice_no) ? $recent_stock->invoice_no : null,
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.invoice_no'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('other_expenses', __('lang.other_expenses'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text(
                                            'other_expenses',
                                            !empty($recent_stock) && !empty($recent_stock->other_expenses) ? @num_format($recent_stock->other_expenses) : null,
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.other_expenses'),
                                                'id' => 'other_expenses',
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount', __('lang.discount'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text(
                                            'discount_amount',
                                            !empty($recent_stock) && !empty($recent_stock->discount_amount)
                                                ? @num_format($recent_stock->discount_amount)
                                                : null,
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.discount'),
                                                'id' => 'discount_amount',
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('other_payments', __('lang.other_payments'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text(
                                            'other_payments',
                                            !empty($recent_stock) && !empty($recent_stock->other_payments) ? @num_format($recent_stock->other_payments) : null,
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.other_payments'),
                                                'id' => 'other_payments',
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('source_type', __('lang.source_type') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'source_type',
                                            ['user' => __('lang.user'), 'pos' => __('lang.pos'), 'store' => __('lang.store'), 'safe' => __('lang.safe')],
                                            !empty($recent_stock) && !empty($recent_stock->source_type) ? $recent_stock->source_type : 'Please Select',
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                                'required',
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('source_of_payment', __('lang.source_of_payment') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'source_id',
                                            $users,
                                            !empty($recent_stock) && !empty($recent_stock->source_id) ? $recent_stock->source_id : null,
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                                'id' => 'source_id',
                                                'required',
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('payment_status', __('lang.payment_status') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'payment_status',
                                            $payment_status_array,
                                            !empty($recent_stock) && !empty($recent_stock->payment_status) ? $recent_stock->payment_status : 'Please Select',
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'required',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                @include('add_stock.partials.payment_form')

                                <div class="col-md-3 due_amount_div hide">
                                    <label
                                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                        for="due_amount">@lang('lang.due') <span
                                            class="due_amount_span">{{ @num_format(0) }}</span></label>
                                </div>

                                <div class="col-md-3 due_fields hide">
                                    <div class="form-group">
                                        {!! Form::label('due_date', __('lang.due_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text(
                                            'due_date',
                                            !empty($transaction_payment) && !empty($transaction_payment->due_date)
                                                ? @format_date($transaction_payment->due_date)
                                                : (!empty($payment)
                                                    ? @format_date($payment->due_date)
                                                    : null),
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start datepicker',
                                                'placeholder' => __('lang.due_date'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 due_fields hide">
                                    <div class="form-group">
                                        {!! Form::label('notify_before_days', __('lang.notify_before_days'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}

                                        {!! Form::text(
                                            'notify_before_days',
                                            !empty($transaction_payment) && !empty($transaction_payment->notify_before_days)
                                                ? $transaction_payment->notify_before_days
                                                : (!empty($payment)
                                                    ? $payment->notify_before_days
                                                    : null),
                                            [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.notify_before_days'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('notes', __('lang.notes'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::textarea(
                                            'notes',
                                            !empty($recent_stock) && !empty($recent_stock->notes) ? $recent_stock->notes : null,
                                            ['class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start', 'rows' => 3],
                                        ) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="row my-2 justify-content-center align-items-center">

                                <div class="col-md-4 w-25">
                                    <button type="submit" name="submit" id="submit-save" value="save"
                                        class="btn btn-primary py-1 w-100 pull-right btn-flat submit">@lang('lang.save')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>



    </section>
@endsection

@section('javascript')
    {{-- <script src="{{ asset('front/js/bootstrap.min.js') }}"></script> --}}

    <script src="{{ asset('js/add_stock.js') }}"></script>
    <script src="{{ asset('js/product_selection.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var hiddenColumnArray = JSON.parse('{!! addslashes(json_encode(Cache::get('key_' . auth()->id(), []))) !!}');

            $.each(hiddenColumnArray, function(index, value) {
                $('.column-toggle').each(function() {
                    if ($(this).val() == value) {
                        // alert(value)
                        toggleColumnVisibility(value, $(this));
                    }
                });
            });

            $(document).on('click', '.column-toggle', function() {
                var column_index = parseInt($(this).val());
                toggleColumnVisibility(column_index, $(this));

                if (hiddenColumnArray.includes(column_index)) {
                    hiddenColumnArray.splice(hiddenColumnArray.indexOf(column_index), 1);
                } else {
                    hiddenColumnArray.push(column_index);
                }

                hiddenColumnArray = [...new Set(hiddenColumnArray)]; // Remove duplicates

                // Update the columnVisibility cache data
                $.ajax({
                    url: '/update-stock-column-visibility', // Replace with your route or endpoint for updating cache data
                    method: 'POST',
                    data: {
                        stockColumnVisibility: hiddenColumnArray
                    },
                    success: function() {
                        console.log('Column visibility updated successfully.');
                    }
                });
            });

            function toggleColumnVisibility(column_index, this_btn) {
                var column = product_table.column(column_index);
                column.visible(!column.visible());

                if (column.visible()) {
                    $(this_btn).addClass('badge-primary').removeClass('badge-warning');
                } else {
                    $(this_btn).removeClass('badge-primary').addClass('badge-warning');
                }
            }
        });
        $(document).on('click', '#add-selected-btn', function() {
            $('#select_products_modal').modal('hide');
            // $.each(product_selected, function(index, value) {
            //     get_label_product_row(value.product_id, value.variation_id);
            // });
            get_label_multipe_product_row(product_selected)
            product_selected = [];
            product_table.ajax.reload();
        })
        @if (!empty($product_id) && !empty($variation_id))
            $(document).ready(function() {
                get_label_product_row({{ $product_id }}, {{ $variation_id }});
            })
        @endif
        $('#po_no').change(function() {
            let po_no = $(this).val();

            if (po_no) {
                $.ajax({
                    method: 'get',
                    url: '/add-stock/get-purchase-order-details/' + po_no,
                    data: {},
                    contentType: 'html',
                    success: function(result) {
                        $("table#product_table tbody").empty().append(result);
                        calculate_sub_totals()
                    },
                });
            }
        });
        $(document).on("click", '#submit-btn-add-product', function(e) {
            e.preventDefault();
            var sku = $('#sku').val();
            if ($("#product-form-quick-add").valid()) {
                tinyMCE.triggerSave();
                $.ajax({
                    type: "POST",
                    url: "/product",
                    data: $("#product-form-quick-add").serialize(),
                    success: function(response) {
                        if (response.success) {
                            swal("Success", response.msg, "success");;
                            $("#search_product").val(sku);
                            $('input#search_product').autocomplete("search");
                            $('.view_modal').modal('hide');
                        }
                    },
                    error: function(response) {
                        if (!response.success) {
                            swal("Error", response.msg, "error");
                        }
                    },
                });
            }
        });
        $(document).on("change", "#category_id", function() {
            $.ajax({
                method: "get",
                url: "/category/get-sub-category-dropdown?category_id=" +
                    $("#category_id").val(),
                data: {},
                contentType: "html",
                success: function(result) {
                    $("#sub_category_id").empty().append(result).change();
                    $("#sub_category_id").selectpicker("refresh");

                    if (sub_category_id) {
                        $("#sub_category_id").selectpicker("val", sub_category_id);
                    }
                },
            });
        });

        //payment related script

        $('#payment_status').change(function() {
            var payment_status = $(this).val();

            if (payment_status === 'paid' || payment_status === 'partial') {
                $('.not_cash_fields').addClass('hide');
                $('#method').change();
                $('#method').attr('required', true);
                $('#paid_on').attr('required', true);
                $('.payment_fields').removeClass('hide');
            } else {
                $('.payment_fields').addClass('hide');
            }
            if (payment_status === 'pending' || payment_status === 'partial') {
                $('.due_fields').removeClass('hide');
            } else {
                $('.due_fields').addClass('hide');
            }
            if (payment_status === 'pending') {
                $('.not_cash_fields').addClass('hide');
                $('.not_cash').attr('required', false);
                $('#method').attr('required', false);
                $('#paid_on').attr('required', false);
            } else {
                $('#method').attr('required', true);
            }
            if (payment_status === 'paid') {
                $('.due_fields').addClass('hide');
            }
        })
        $('#method').change(function() {
            var method = $(this).val();

            if (method === 'cash') {
                $('.not_cash_fields').addClass('hide');
                $('.not_cash').attr('required', false);
            } else {
                $('.not_cash_fields').removeClass('hide');
                $('.not_cash').attr('required', true);
            }
        });

        $(document).ready(function() {
            $('#payment_status').change();
            $('#source_type').change();
            $("#source_id").selectpicker("refresh");
        })
        $('#source_type').change(function() {
            if ($(this).val() !== '') {
                $.ajax({
                    method: 'get',
                    url: '/add-stock/get-source-by-type-dropdown/' + $(this).val(),
                    data: {},
                    success: function(result) {
                        $("#source_id").empty().append(result);
                        $('#source_id').val({{ $recent_stock->source_id ?? null }});
                        $("#source_id").selectpicker("refresh");
                    },
                });
            }
        });

        $(document).on('change', '.expiry_date', function() {
            if ($(this).val() != '') {
                let tr = $(this).parents('tr');
                tr.find('.days_before_the_expiry_date').val(15);
            }
        })
    </script>
    <script>
        function showDetails(i) {
            if ($(`#row_details_${i}`).is(":visible")) {
                $(`#row_details_${i}`).hide()
            } else {
                $(`#row_details_${i}`).show()
            }
            if ($(`#bounce_details_td_${i}`).is(":visible")) {
                $(`#bounce_details_td_${i}`).hide()
            } else {
                $(`#bounce_details_td_${i}`).show()
            }
            if ($(`#row_batch_details_${i}`).is(":visible")) {
                $(`#row_batch_details_${i}`).hide()
            } else {
                $(`#row_batch_details_${i}`).show()
            }
            $(`#arrow${i}`).toggleClass("fa-arrow-down fa-arrow-up")
        }
    </script>

@endsection
