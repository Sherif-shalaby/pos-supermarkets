@extends('layouts.app')
@section('title', __('lang.pos'))
@section('styles')
<style>
    .btn-group-custom .btn {
        font-size: 13px !important;
        min-width: 13% !important;
        margin: 2px 5px;
        text-align: center !important;
        overflow: initial;
        width: auto !important;
    }

    .checkboxes input[type=checkbox] {
        width: 140%;
        height: 140%;
        accent-color: var(--primary-color);
    }

    /* Styling for the Offcanvas */
    .offcanvas {
        position: fixed;
        top: 0;
        right: -100%;
        width: 300px;
        height: 100%;
        background-color: #f8f9fa;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        transition: right 0.3s ease;
        z-index: 1050;
        padding: 20px;
        overflow-y: auto;
    }

    .offcanvas.open {
        right: 0;
    }

    /* Backdrop */
    .offcanvas-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
    }

    .offcanvas-backdrop.show {
        display: block;
    }

    /* Toggle and Close Buttons */
    .offcanvas-toggle {
        padding: 10px 20px;
        cursor: pointer;
        background-color: var(--primary-color);
        color: white;
        border: none;
        font-size: 16px;
    }

    .offcanvas-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
        background: none;
        border: none;
        color: black;

    }

    body.offcanvas-open {
        overflow: hidden;
    }
</style>

@endsection

@section('content')
@php
$watsapp_numbers = App\Models\System::getProperty('watsapp_numbers');
@endphp
<section class="forms pos-section no-print">
    <div class="container-fluid px-0">

        <div class="d-flex">
            <audio id="mysoundclip1" preload="auto">
                <source src="{{ asset('audio/beep-timber.mp3') }}">
                </source>
            </audio>
            <audio id="mysoundclip2" preload="auto">
                <source src="{{ asset('audio/beep-07.mp3') }}">
                </source>
            </audio>
            <audio id="mysoundclip3" preload="auto">
                <source src="{{ asset('audio/beep-long.mp3') }}">
                </source>
            </audio>

            <div class="@if (session('system_mode') == 'pos') col-md-12 @else col-md-6 @endif">

                {!! Form::open(['url' => action('SellPosController@store'), 'method' => 'post', 'files' => true, 'class'
                => 'pos-form', 'id' => 'add_pos_form']) !!}



                <div class="d-flex">
                    <div class="card col-md-10">
                        <div class="card-body" style="padding: 0px 10px; !important">
                            <input type="hidden" name="default_customer_id" id="default_customer_id"
                                value="@if (!empty($walk_in_customer)) {{ $walk_in_customer->id }} @endif">
                            <input type="hidden" name="row_count" id="row_count" value="0">
                            <input type="hidden" name="customer_size_id_hidden" id="customer_size_id_hidden" value="">
                            <input type="hidden" name="enable_the_table_reservation" id="enable_the_table_reservation"
                                value="{{ App\Models\System::getProperty('enable_the_table_reservation') }}">


                            <div class="row">

                                <div class="col-md-12 main_settings">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                {!! Form::label('store_id', __('lang.store') . ':*', []) !!}
                                                {!! Form::select('store_id', $stores, $store_pos->store_id, ['class' =>
                                                'selectpicker form-control', 'data-live-search' => 'true', 'required',
                                                'style' => 'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                {!! Form::label('store_pos_id', __('lang.pos') . ':*', []) !!}
                                                {!! Form::select('store_pos_id', $store_poses, $store_pos->id, ['class'
                                                =>
                                                'selectpicker form-control', 'data-live-search' => 'true', 'required',
                                                'style' => 'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="setting_invoice_lang"
                                                    id="setting_invoice_lang"
                                                    value="{{ !empty(App\Models\System::getProperty('invoice_lang')) ? App\Models\System::getProperty('invoice_lang') : 'en' }}">
                                                {!! Form::label('invoice_lang', __('lang.invoice_lang') . ':', []) !!}
                                                {!! Form::select('invoice_lang', $languages + ['ar_and_en' => 'Arabic
                                                and
                                                English'], !empty(App\Models\System::getProperty('invoice_lang')) ?
                                                App\Models\System::getProperty('invoice_lang') : 'en', ['class' =>
                                                'form-control selectpicker', 'data-live-search' => 'true']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="hidden" name="exchange_rate" id="exchange_rate" value="1">
                                                <input type="hidden" name="default_currency_id" id="default_currency_id"
                                                    value="{{ !empty(App\Models\System::getProperty('currency')) ? App\Models\System::getProperty('currency') : '' }}">
                                                {!! Form::label('received_currency_id', __('lang.received_currency') .
                                                ':',
                                                []) !!}
                                                {!! Form::select('received_currency_id', $exchange_rate_currencies,
                                                !empty(App\Models\System::getProperty('currency')) ?
                                                App\Models\System::getProperty('currency') : null, ['class' =>
                                                'form-control
                                                selectpicker', 'data-live-search' => 'true']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-1" style="padding: 0 !important;">
                                            <div class="form-group" style="margin-top: 31px;">
                                                <select class="form-control" name="tax_id" id="tax_id">
                                                    <option value="">No Tax</option>
                                                    @foreach ($taxes as $tax)
                                                    <option data-rate="{{ $tax['rate'] }}" @if (!empty($transaction) &&
                                                        $transaction->tax_id == $tax['id']) selected @endif
                                                        value="{{ $tax['id'] }}">{{ $tax['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="tax_id_hidden" id="tax_id_hidden" value="">
                                                <input type="hidden" name="tax_method" id="tax_method" value="">
                                                <input type="hidden" name="tax_rate" id="tax_rate" value="0">
                                                <input type="hidden" name="tax_type" id="tax_type" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-link btn-sm"
                                                style="margin-top: 30px; padding: 0px !important;" data-toggle="modal"
                                                data-target="#delivery-cost-modal"><img
                                                    src="{{ asset('images/delivery.jpg') }}" alt="delivery"
                                                    style="height: 35px; width: 40px;"></button>
                                        </div>
                                        @if (session('system_mode') == 'restaurant')
                                        <div class="col-md-1">
                                            <button type="button" style="padding: 0px !important;"
                                                data-href="{{ action('DiningRoomController@getDiningModal') }}"
                                                data-container="#dining_model"
                                                class="btn btn-modal pull-right mt-4"><img
                                                    src="{{ asset('images/black-table.jpg') }}" alt="black-table"
                                                    style="width: 40px; height: 33px; margin-top: 7px;"></button>
                                        </div>
                                        @endif

                                        <div id="offcanvas" class="offcanvas">
                                            <button id="offcanvas-close" type="button"
                                                class="offcanvas-close">×</button>
                                            <h2>Products</h2>
                                            @include('sale_pos.partials.right_side')
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 main_settings">
                                    <div class="row table_room_hide">
                                        <div class="col-md-3">
                                            {!! Form::label('customer_id', __('lang.customer'), []) !!}
                                            <div class="input-group my-group">
                                                {!! Form::select('customer_id', $customers, !empty($walk_in_customer) ?
                                                $walk_in_customer->id : null, ['class' => 'selectpicker form-control',
                                                'data-live-search' => 'true', 'style' => 'width: 80%', 'id' =>
                                                'customer_id', 'required']) !!}
                                                <span class="input-group-btn">
                                                    @can('customer_module.customer.create_and_edit')
                                                    <a class="btn-modal btn btn-default bg-white btn-flat"
                                                        data-href="{{ action('CustomerController@create') }}?quick_add=1"
                                                        data-container=".view_modal"><i
                                                            class="fa fa-plus-circle text-primary fa-lg"></i></a>
                                                    @endcan
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary" style="margin-top: 30px;"
                                                data-toggle="modal"
                                                data-target="#contact_details_modal">@lang('lang.details')</button>
                                        </div>

                                        <div class="col-md-2 flex_center flex-column">
                                            <label for="customer_type_name">@lang('lang.customer_type'):
                                            </label>
                                            <span class="customer_type_name"></span>
                                        </div>
                                        <div class="col-md-1 flex_center flex-column">
                                            <label for="customer_balance">@lang('lang.balance'):
                                            </label>
                                            <span class="customer_balance">{{ @num_format(0) }}</span>
                                        </div>
                                        <div class="col-md-1 flex_center flex-column">
                                            <label for="points">@lang('lang.points'):
                                            </label>
                                            <span class="points"><span class="customer_points_span">{{
                                                    @num_format(0)
                                                    }}</span></span>
                                            {{-- <label for="staff_note">@lang('lang.note'): --}}

                                                <span class="staff_note small"></span>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-danger btn-xs pull-right"
                                                style="margin-top: 38px;" data-toggle="modal"
                                                data-target="#non_identifiable_item_modal">@lang('lang.non_identifiable_item')</button>
                                        </div>
                                        <div class="mx-2">
                                            <button type="button" class="btn btn-danger btn-xs  pull-right"
                                                style="margin-top: 38px;" id="print_and_draft"><i
                                                    class="dripicons-print"></i></button>
                                            <input type="hidden" id="print_and_draft_hidden"
                                                name="print_and_draft_hidden" value="">
                                        </div>
                                    </div>


                                    <div class="row table_room_show hide">
                                        <div class="col-md-4">
                                            <div class=""
                                                style="padding: 5px 5px; background:#0082ce; color: #fff; font-size: 20px; font-weight: bold; text-align: center; border-radius: 5px;">
                                                <span class="room_name"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""
                                                style="font-size: 20px !important; font-weight: bold; text-align: center; margin-top: 3px;">@lang('lang.table'):
                                                <span class="table_name"></span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group my-group">
                                                {!! Form::select('service_fee_id', $service_fees, null, ['class' =>
                                                'form-control', 'placeholder' => __('lang.select_service'), 'id' =>
                                                'service_fee_id']) !!}
                                            </div>
                                        </div>
                                        <input type="hidden" name="service_fee_id_hidden" id="service_fee_id_hidden"
                                            value="">
                                        <input type="hidden" name="service_fee_rate" id="service_fee_rate" value="0">
                                        <input type="hidden" name="service_fee_value" id="service_fee_value" value="0">
                                    </div>


                                    @include('sale_pos.includes.search')

                                    @include('sale_pos.includes.selected-products')

                                </div>
                            </div>

                        </div>


                        <div class="payment-amount table_room_hide">
                            <h2 class="bg-primary text-white">{{ __('lang.grand_total') }} <span
                                    class="final_total_span">0.00</span></h2>
                        </div>
                        @php
                        $default_invoice_toc = App\Models\System::getProperty('invoice_terms_and_conditions');
                        if (!empty($default_invoice_toc)) {
                        $toc_hidden = $default_invoice_toc;
                        } else {
                        $toc_hidden = array_key_first($tac);
                        }
                        $term=App\Models\TermsAndCondition::where('default','1')->first();

                        @endphp
                        <input type="hidden" name="terms_and_condition_hidden" id="terms_and_condition_hidden"
                            value="{{ $toc_hidden }}">

                        @include('sale_pos.includes.terms-and-conditions')


                    </div>

                    <div class="col-md-2">
                        <!-- product list -->

                        <!-- navbar-->
                        <header class="header">
                            <nav class="navbar">
                                <div class="">
                                    <div class="navbar-holder d-flex align-items-center justify-content-between">

                                        @include('sale_pos.includes.header')

                                    </div>
                            </nav>
                        </header>


                        @include('sale_pos.includes.payment')
                    </div>
                </div>

                @include('sale_pos.partials.payment_modal')
                @include('sale_pos.partials.discount_modal')
                {{-- @include('sale_pos.partials.tax_modal') --}}
                @include('sale_pos.partials.delivery_cost_modal')
                @include('sale_pos.partials.coupon_modal')
                @include('sale_pos.partials.contact_details_modal')
                @include('sale_pos.partials.weighing_scale_modal')
                @include('sale_pos.partials.non_identifiable_item_modal')
                @include('sale_pos.partials.customer_sizes_modal')
                @include('sale_pos.partials.sale_note')

                {!! Form::close() !!}
            </div>



            <!-- recent transaction modal -->
            @include('sale_pos.includes.recent-transaction')


            <!-- draft transaction modal -->
            @include('sale_pos.includes.draft-transaction')


            <!-- onlineOrder transaction modal -->
            @include('sale_pos.includes.online-order-transaction')

            <div id="dining_model" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                class="modal text-left">
            </div>


            <div id="dining_table_action_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                class="modal fade text-left">
            </div>

        </div>
    </div>


</section>


<!-- This will be printed -->
<section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection
@section('style')

<style>
    .red {
        color: #a50d0d !important;
    }
</style>
@endsection
@section('javascript')
<script src="{{ asset('js/onscan.min.js') }}"></script>
<script src="{{ asset('js/pos.js') }}"></script>
<script src="{{ asset('js/dining_table.js') }}"></script>
<script>
    $(document).ready(function() {
            $('.online-order-badge').hide();
        })
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('order-channel');
        channel.bind('new-order', function(data) {
            if (data) {
                let badge_count = parseInt($('.online-order-badge').text()) + 1;
                $('.online-order-badge').text(badge_count);
                $('.online-order-badge').show();
                var transaction_id = data.transaction_id;
                $.ajax({
                    method: 'get',
                    url: '/pos/get-transaction-details/' + transaction_id,
                    data: {},
                    success: function(result) {
                        toastr.success(LANG.new_order_placed_invoice_no + ' ' + result.invoice_no);
                        let notification_number = parseInt($('.notification-number').text());
                        console.log(notification_number, 'notification-number');
                        if (!isNaN(notification_number)) {
                            notification_number = parseInt(notification_number) + 1;
                        } else {
                            notification_number = 1;
                        }
                        $('.notification-list').empty().append(
                            `<i class="dripicons-bell"></i><span class="badge badge-danger notification-number">${notification_number}</span>`
                        );
                        $('.notifications').prepend(
                            `<li>
                                <a class="pending notification_item"
                                    data-mark-read-action=""
                                    data-href="{{ url('/') }}/pos/${transaction_id}/edit?status=final">
                                    <p style="margin:0px"><i class="dripicons-bell"></i> ${LANG.new_order_placed_invoice_no} #
                                        ${result.invoice_no}</p>
                                    <span class="text-muted">
                                        @lang('lang.total'): ${__currency_trans_from_en(result.final_total, false)}
                                    </span>
                                </a>

                            </li>`
                        );
                        $('.no_new_notification_div').addClass('hide');

                    },
                });
            }
        });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const offcanvasToggle = document.getElementById('offcanvas-toggle');
    const offcanvasClose = document.getElementById('offcanvas-close');
    const offcanvas = document.getElementById('offcanvas');
    const backdrop = document.getElementById('offcanvas-backdrop');

    offcanvasToggle.addEventListener('click', function() {
    offcanvas.classList.add('open');
    // backdrop.classList.add('show');
    document.body.classList.add('offcanvas-open');
    });

    offcanvasClose.addEventListener('click', function() {
    offcanvas.classList.remove('open');
    // backdrop.classList.remove('show');
    document.body.classList.remove('offcanvas-open');
    });

    backdrop.addEventListener('click', function() {
    offcanvas.classList.remove('open');
    // backdrop.classList.remove('show');
    document.body.classList.remove('offcanvas-open');
    });
    });
</script>
@endsection