<div class="col-md-12" style="margin-top: 5px; padding: 0px; ">
    <div class="table-responsive transaction-list">
        <table id="product_table" style="width: 100% " class="table table-hover table-striped order-list table-fixed">
            <thead>
                <tr>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 17% @else 20% @endif; font-size: 12px !important;">
                        @lang('lang.product')</th>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 17% @else 20% @endif; font-size: 12px !important;">
                        @lang('lang.quantity')</th>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 14% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.price')</th>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 11% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.discount')</th>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 10% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.category_discount')</th>
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 9% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.sub_total')</th>
                    @if (session('system_mode') != 'restaurant')
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 9% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.current_stock')</th>
                    @endif
                    <th
                        style="width: @if (session('system_mode') != 'restaurant') 9% @else 15% @endif; font-size: 12px !important;">
                        @lang('lang.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row" style="display: none;">
    <div class="col-md-2">
        <div class="form-group">
            <input type="hidden" id="final_total" name="final_total" />
            <input type="hidden" id="grand_total" name="grand_total" />
            <input type="hidden" id="gift_card_id" name="gift_card_id" />
            <input type="hidden" id="coupon_id" name="coupon_id">
            <input type="hidden" id="total_tax" name="total_tax" value="0.00">
            <input type="hidden" id="total_item_tax" name="total_item_tax" value="0.00">
            <input type="hidden" id="status" name="status" value="final" />
            <input type="hidden" id="total_sp_discount" name="total_sp_discount" value="0" />
            <input type="hidden" id="total_pp_discount" name="total_pp_discount" value="0" />
            <input type="hidden" name="dining_table_id" id="dining_table_id" value="">
            <input type="hidden" name="dining_action_type" id="dining_action_type" value="">
        </div>
    </div>
</div>
<div class="col-12 totals table_room_hide" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">
    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif justify-content-start align-items-center"
        style="gap: 8px">
        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">

            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.items') }}</span>
            <span id="item">0</span>
        </div>


        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">
                {{
                __('lang.quantity') }}</span>
            <span id="item-quantity">0</span>
        </div>




        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.total') }}</span>
            <span id="subtotal">0.00</span>
        </div>


        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.total_before_discount')
                }}</span>
            <span id="total_before_discount">0.00</span>
        </div>

        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.tax') }} </span>
            <span id="tax">0.00</span>
        </div>


        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.delivery') }}</span>
            <span id="delivery-cost">0.00</span>
        </div>

        <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center rounded"
            style="padding: 5px;min-width: 100px;">
            <span class="totals-title text-center text-primary w-100 px-3 bg-white rounded" style="font-weight:600">{{
                __('lang.sales_promotion') }}</span>
            <span id="sales_promotion-cost_span">0.00</span>
            <input type="hidden" id="sales_promotion-cost" value="0">
        </div>


        <div class="col-sm-3">
            @if(auth()->user()->can('sp_module.sales_promotion.view')
            || auth()->user()->can('sp_module.sales_promotion.create_and_edit')
            || auth()->user()->can('sp_module.sales_promotion.delete'))
            <button style="background-color: #d63031" type="button" class="btn btn-md payment-btn text-white"
                data-toggle="modal" data-target="#discount_modal">@lang('lang.random_discount')</button>
            @endif
            {{-- <span id="discount">0.00</span> --}}
        </div>
    </div>
</div>

<div class="col-md-12 table_room_show hide" style="border-top: 2px solid #e4e6fc; margin-top: 10px;">
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="row">
                <b>@lang('lang.total'): <span class="subtotal">0.00</span></b>
            </div>
            <div class="row">
                <b>@lang('lang.discount'): <span class="discount_span">0.00</span></b>
            </div>
            <div class="row">
                <b>@lang('lang.service'): <span class="service_value_span">0.00</span></b>
            </div>
            <div class="row">
                <b>@lang('lang.grand_total'): <span class="final_total_span">0.00</span></b>
            </div>
        </div>
    </div>






    <div class="row pt-4">
        <div class="col-md-8">
            <div class="row">
                <button type="button" name="action" value="print" id="dining_table_print" class="btn mr-2 text-white"
                    style="background: orange;">@lang('lang.print')</button>
                <button type="button" name="action" value="save" id="dining_table_save"
                    class="btn mr-2 text-white btn-success">@lang('lang.save')</button>
                <button data-method="cash" style="background: #0082ce" type="button"
                    class="btn mr-2 payment-btn text-white" data-toggle="modal" data-target="#add-payment"
                    data-backdrop="static" data-keyboard="false" id="cash-btn">@lang('lang.pay_and_close')</button>
                @if(auth()->user()->can('sp_module.sales_promotion.view')
                || auth()->user()->can('sp_module.sales_promotion.create_and_edit')
                || auth()->user()->can('sp_module.sales_promotion.delete'))
                <button style="background-color: #d63031" type="button" class="btn mr-2 btn-md payment-btn text-white"
                    data-toggle="modal" data-target="#discount_modal">@lang('lang.random_discount')</button>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <button style="background-color: #ff0000;" type="button" class="btn text-white" id="cancel-btn"
                onclick="return confirmCancel()">
                @lang('lang.cancel')</button>
        </div>
    </div>
</div>