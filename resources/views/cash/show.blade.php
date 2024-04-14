<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h4 class="modal-title  px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.cash_details')
            </h4>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td><b>@lang('lang.date_and_time')</b></td>
                        <td>{{ @format_datetime($cash_register->created_at) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.cash_in')</b></td>
                        <td>{{ @num_format($cash_register->total_cash_in) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.cash_out')</b></td>
                        <td>{{ @num_format($cash_register->total_cash_out) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_sales')</b></td>
                        <td>{{ @num_format($cash_register->total_sale - $cash_register->total_refund - $total_latest_payments) }}
                        </td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_cash_sale')</b></td>
                        <td>{{ @num_format($cash_register->total_cash_sales - $total_latest_payments) }}
                        </td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_latest_payments')</b></td>
                        <td>
                            {{ @num_format($total_latest_payments) }}
                        </td>
                        @if (!empty($total_latest_payments) && $total_latest_payments > 0)
                            <td><a data-href="{{ action('CashController@showLatestPaymentDetails', $cash_register->id) }}"
                                    data-container=".view_modal" class="btn btn-modal btn-danger text-white"><i
                                        class="fa fa-eye"></i> @lang('lang.view')</a></td>
                        @endif
                    </tr>
                    @if (session('system_mode') == 'restaurant')
                        <tr>
                            <td><b>@lang('lang.dining_in')</b></td>
                            <td>{{ @num_format($cash_register->total_dining_in) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><b>@lang('lang.total_card_sale')</b></td>
                        <td>{{ @num_format($cash_register->total_card_sales) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_cheque_sale')</b></td>
                        <td>{{ @num_format($cash_register->total_cheque_sales) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_bank_transfer_sale')</b></td>
                        <td>{{ @num_format($cash_register->total_bank_transfer_sales) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.total_gift_card_sale')</b></td>
                        <td>{{ @num_format($cash_register->total_gift_card_sales) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.return_sales')</b></td>
                        <td>{{ @num_format($cash_register->total_sell_return) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.purchases')</b></td>
                        <td>{{ @num_format($cash_register->total_purchases) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.expenses')</b></td>
                        <td>{{ @num_format($cash_register->total_expenses) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.wages_and_compensation')</b></td>
                        <td>{{ @num_format($cash_register->total_wages_and_compensation) }}</td>
                    </tr>
                    <tr>
                        <td><b>@lang('lang.current_cash')</b></td>
                        <td>{{ @num_format($cash_register->total_cash_sales + $cash_register->total_cash_in - $cash_register->total_cash_out - $cash_register->total_purchases - $cash_register->total_expenses - $cash_register->total_wages_and_compensation - $cash_register->total_sell_return) }}
                        </td>
                    </tr>
                </table>
            </div>
            <input type="hidden" name="cash_register_id" value="{{ $cash_register->id }}">
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker('render')
</script>
