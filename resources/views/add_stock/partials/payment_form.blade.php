<div class="col-md-12">
    @if (!empty($payment))
        <input type="hidden" name="transaction_payment_id" value="{{ $payment->id }}">
    @endif
    <div class="row  @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
        <div class="col-md-3 px-5 payment_fields hide">
            <div class="form-group">
                {!! Form::label('amount', __('lang.amount') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text(
                    'amount',
                    !empty($transaction_payment) && !empty($transaction_payment->amount)
                        ? $transaction_payment->amount
                        : (!empty($payment)
                            ? $payment->amount
                            : null),
                    [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                        'placeholder' => __('lang.amount'),
                    ],
                ) !!}
            </div>
        </div>

        <div class="col-md-3 px-5 payment_fields hide">
            <div class="form-group">
                {!! Form::label('method', __('lang.payment_type') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select(
                    'method',
                    $payment_type_array,
                    !empty($transaction_payment) && !empty($transaction_payment->method)
                        ? $transaction_payment->method
                        : (!empty($payment)
                            ? $payment->method
                            : 'Please Select'),
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

        <div class="col-md-3 px-5 payment_fields hide">
            <div class="form-group">
                {!! Form::label('paid_on', __('lang.payment_date'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text(
                    'paid_on',
                    !empty($transaction_payment) && !empty($transaction_payment->paid_on)
                        ? @format_date($transaction_payment->paid_on)
                        : (!empty($payment)
                            ? @format_date($payment->paid_on)
                            : @format_date(date('Y-m-d'))),
                    [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start datepicker',
                        'placeholder' => __('lang.payment_date'),
                    ],
                ) !!}
            </div>
        </div>

        <div class="col-md-3 px-5 payment_fields hide">
            <div class="form-group">
                {!! Form::label('upload_documents', __('lang.upload_documents'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                <input
                    class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                    type="file" name="upload_documents[]" id="upload_documents" multiple>
            </div>
        </div>
        <div class="col-md-3 px-5 not_cash_fields hide">
            <div class="form-group">
                {!! Form::label('ref_number', __('lang.ref_number') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text(
                    'ref_number',
                    !empty($transaction_payment) && !empty($transaction_payment->ref_number)
                        ? $transaction_payment->ref_number
                        : (!empty($payment)
                            ? $payment->ref_number
                            : null),
                    [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start not_cash',
                        'placeholder' => __('lang.ref_number'),
                    ],
                ) !!}
            </div>
        </div>
        <div class="col-md-3 px-5 not_cash_fields hide">
            <div class="form-group">
                {!! Form::label('bank_deposit_date', __('lang.bank_deposit_date') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text(
                    'bank_deposit_date',
                    !empty($transaction_payment) && !empty($transaction_payment->bank_deposit_date)
                        ? @format_date($transaction_payment->bank_deposit_date)
                        : (!empty($payment)
                            ? @format_date($payment->bank_deposit_date)
                            : null),
                    [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start not_cash datepicker',
                        'placeholder' => __('lang.bank_deposit_date'),
                    ],
                ) !!}
            </div>
        </div>
        <div class="col-md-3 px-5 not_cash_fields hide">
            <div class="form-group">
                {!! Form::label('bank_name', __('lang.bank_name') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text(
                    'bank_name',
                    !empty($transaction_payment) && !empty($transaction_payment->bank_name)
                        ? $transaction_payment->bank_name
                        : (!empty($payment)
                            ? $payment->bank_name
                            : null),
                    [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start  not_cash',
                        'placeholder' => __('lang.bank_name'),
                    ],
                ) !!}
            </div>
        </div>
    </div>
</div>
