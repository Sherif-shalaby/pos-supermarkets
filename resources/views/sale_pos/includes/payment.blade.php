<div class="payment-options px-2 d-flex flex-column table_room_hide"
    style=" width: @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket') 100%; @else 50%; @endif">
    {{-- <div class="my-1 w-100">
        <button data-method="card" type="button" class="btn btn-primary btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i>
            @lang('lang.card')</button>
    </div> --}}
    <div class="my-1 w-100">
        <button data-method="cash" type="button" class="btn btn-primary btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" data-backdrop="static" data-keyboard="false" id="cash-btn"><i
                class="fa fa-money"></i>
            @lang('lang.pay')</button>
    </div>
    <div class="my-1 w-100">
        <button data-method="cash" type="button" class="btn btn-primary btn-custom " id="quick-pay-btn"><i
                class="fa fa-money"></i>
            @lang('lang.quick_pay')</button>
    </div>
    <div class="my-1 w-100">
        <button data-method="coupon" type="button" class="btn btn-primary btn-custom " data-toggle="modal"
            data-target="#coupon_modal" id="coupon-btn"><i class="fa fa-tag"></i>
            @lang('lang.coupon')</button>
    </div>
    @if (session('system_mode') != 'restaurant')
    <div class="my-1 w-100">
        <button data-method="paypal" type="button" class="btn btn-custom btn-primary payment-btn" data-toggle="modal"
            data-target="#add-payment" data-backdrop="static" data-keyboard="false" id="paypal-btn"><i
                class="fa fa-paypal"></i>
            @lang('lang.other_online_payments')</button>
    </div>
    @endif
    <div class="my-1 w-100">
        <button data-method="draft" type="button" data-toggle="modal" data-target="#sale_note_modal"
            class="btn btn-primary btn-custom"><i class="dripicons-flag"></i>
            @lang('lang.draft')</button>
    </div>
    <div class="my-1 w-100">
        <button data-method="draft" type="button" class="btn btn-primary btn-custom" id="view-draft-btn"
            data-href="{{ action('SellPosController@getDraftTransactions') }}"><i class="dripicons-flag"></i>
            @lang('lang.view_draft')</button>
    </div>
    <div class="my-1 w-100">
        <button data-method="online-order" type="button" class="btn btn-primary btn-custom" id="view-online-order-btn"
            data-href="{{ action('SellPosController@getOnlineOrderTransactions') }}"><img
                src="{{ asset('images/online_order.png') }}" style="height: 25px; width: 35px;" alt="icon">
            @lang('lang.online_orders') <span class="badge badge-danger online-order-badge">0</span></button>
    </div>
    {{-- <div class="my-1 w-100">
        <button data-method="cheque" type="button" class="btn btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i>
            @lang('lang.cheque')</button>
    </div>
    <div class="my-1 w-100">
        <button data-method="bank_transfer" type="button" class="btn btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" id="bank-transfer-btn"><i class="fa fa-building-o"></i>
            @lang('lang.bank_transfer')</button>
    </div> --}}
    <div class="my-1 w-100">
        <button data-method="pay-later" type="button" class="btn btn-primary btn-custom" id="pay-later-btn"><i
                class="fa fa-hourglass-start"></i>
            @lang('lang.pay_later')</button>
    </div>
    {{-- <div class="my-1 w-100">
        <button data-method="gift_card" type="button" class="btn btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" id="gift-card-btn"><i class="fa fa-credit-card-alt"></i>
            @lang('lang.gift_card')</button>
    </div> --}}
    {{-- <div class="my-1 w-100">
        <button data-method="deposit" type="button" class="btn btn-custom payment-btn" data-toggle="modal"
            data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i>
            @lang('lang.use_the_balance')</button>
    </div> --}}
    <div class="my-1 w-100">
        <button type=" button" class="btn btn-danger btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i
                class="fa fa-close"></i>
            @lang('lang.cancel')</button>
    </div>
    <div class="my-1 w-100">
        <button type=" button" class="btn btn-primary btn-custom" id="recent-transaction-btn"><i
                class="dripicons-clock"></i>
            @lang('lang.recent_transactions')</button>
    </div>
</div>