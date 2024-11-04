@extends('layouts.app')
@section('title', __('lang.purchase_return'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">

        <x-page-title>
            <h4>@lang('lang.purchase_return')</h4>
        </x-page-title>

        {!! Form::open(['url' => action('PurchaseReturnController@store'), 'method' => 'post', 'files' =>
        true, 'class' => 'pos-form', 'id' => 'purchase_return_form']) !!}
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">

                <div class="row locale_dir">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="locale_label mb-1" for="supplier_id">@lang('lang.supplier')</label>
                            {!! Form::select('supplier_id', $suppliers, false, ['class' => 'form-control',
                            'data-live-search' => 'true', 'placeholder' => __('lang.please_select'),
                            'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="locale_label mb-1" for="store_id">@lang('lang.store')</label>
                            {!! Form::select('store_id', $stores, false, ['class' => 'form-control',
                            'data-live-search' => 'true', 'placeholder' => __('lang.please_select'),
                            'required', 'id' => 'store_id']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-12">
                        <div class="search-box input-group">
                            <button type="button" class="btn btn-secondary btn-lg" id="search_button"><i
                                    class="fa fa-search"></i></button>
                            <input type="text" name="search_product" id="search_product"
                                placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                class="form-control ui-autocomplete-input" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="product_table" style="width: 100% " class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">{{__('lang.product')}}</th>
                                            <th style="width: 20%">{{__('lang.returned_quantity')}}</th>
                                            <th style="width: 20%">{{__('lang.price')}}</th>
                                            <th style="width: 20%">{{__('lang.current_stock')}}</th>
                                            <th class="sum" style="width: 10%">{{__('lang.sub_total')}}</th>
                                            <th style="width: 20%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('purchase_return.partials.product_row', ['products' => []])
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th style="text-align: right">@lang('lang.total')</th>
                                            <th></th>
                                            <th><span class="grand_total_span">{{@num_format(0)}}</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="display: none;">
                            <div class="col-md-2">
                                <div class="form-group">

                                    <input type="hidden" id="final_total" name="final_total" value="{{0}}" />
                                    <input type="hidden" id="grand_total" name="grand_total" value="{{0}}" />

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">

                <div class="row locale_dir">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('payment_status', __('lang.payment_status'), ['class' =>"locale_label
                            mb-1"]) !!}
                            {!! Form::select('payment_status', $payment_status_array, false, ['class' =>
                            'form-control', 'placeholder' => __('lang.please_select'), 'required']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">

                    @if(!empty($purchase_return))
                    @if($purchase_return->transaction_payments->count() > 0)
                    @include('add_stock.partials.payment_form', ['payment' =>
                    $purchase_return->transaction_payments->first()])
                    @endif
                    @else
                    @include('add_stock.partials.payment_form')
                    @endif

                </div>


                <div class="col-md-3 due_fields hide">
                    <div class="form-group">
                        {!! Form::label('due_date', __('lang.due_date'), ['class' =>"locale_label mb-1"]) !!}
                        {!! Form::text('due_date', !empty($payment) ? $payment->due_date : null, ['class' =>
                        'form-control datepicker', 'readonly',
                        'placeholder' => __('lang.due_date')]) !!}
                    </div>
                </div>

                <div class="col-md-3 due_fields hide">
                    <div class="form-group">
                        {!! Form::label('notify_before_days', __('lang.notify_before_days'), ['class' =>"locale_label
                        mb-1"]) !!}
                        {!! Form::text('notify_before_days', !empty($payment) ? $payment->notify_before_days : null,
                        ['class' =>
                        'form-control',
                        'placeholder' => __('lang.notify_before_days')]) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('notes', __('lang.notes'), ['class' =>"locale_label mb-1"]) !!}
                        {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>

                <div class="row locale_dir">
                    <div class="col-md-12">
                        <button type="sbumit" class="btn btn-primary save-btn">@lang('lang.save')</button>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</section>

<!-- This will be printed -->
<section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection

@section('javascript')
<script src="{{asset('js/purchase_return.js')}}"></script>
<script>
    $(document).ready(function(){
        calculate_sub_totals()
    })
</script>
@endsection