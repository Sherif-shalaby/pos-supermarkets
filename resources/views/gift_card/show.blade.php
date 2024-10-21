<div class="modal-dialog" role="document">
    <div class="modal-content">

        <x-modal-header>

            <h4 class="modal-title">@lang( 'lang.view_payments' )</h4>
        </x-modal-header>

        <div class="modal-body">

            @include('gift_card.partials.payment_table', ['payments' => $transaction_payments, 'show_action' => 'yes'])
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default col-12" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>



    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
