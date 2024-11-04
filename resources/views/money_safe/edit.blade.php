<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('MoneySafeController@update', $money_safe->id), 'method' => 'put', 'id' =>
        'money_safe_edit_form']) !!}

        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.edit' )</h4>

        </x-modal-header>

        <div class="modal-body row locale_dir">
            <div class="col-md-6">
                {!! Form::label('store_id', __('lang.store') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::select('store_id', $stores, $money_safe->store_id, ['class' => 'form-control selectpicker',
                'data-live-search' => 'true', 'required', 'placeholder' => __('lang.please_select')]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('name', __('lang.safe_name') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('name', $money_safe->name, ['class' => 'form-control', 'placeholder' => __('lang.name'),
                'required', 'readonly' => $money_safe->is_default == 1 ? true : false]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('currency_id', __('lang.currency') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::select('currency_id', $currencies, $money_safe->currency_id, ['class' => 'form-control
                selectpicker', 'data-live-search' => 'true', 'required']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('type', __('lang.type_of_safe') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::select('type', ['cash' => __('lang.cash'), 'bank' => __('lang.bank')], $money_safe->type,
                ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required', 'placeholder' =>
                __('lang.please_select')]) !!}
            </div>
            <div class="col-md-6 bank_fields">
                {!! Form::label('bank_name', __('lang.bank_name'),[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('bank_name', $money_safe->bank_name, ['class' => 'form-control ', $money_safe->type ==
                'bank'? 'bank_required':'', 'placeholder' => __('lang.bank_name'),$money_safe->type == 'bank'?
                'required':'' ]) !!}
            </div>
            <div class="col-md-6 bank_fields">
                {!! Form::label('IBAN', __('lang.IBAN') ,[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('IBAN', $money_safe->IBAN, ['class' => 'form-control', 'placeholder' => __('lang.IBAN')])
                !!}
            </div>
            <div class="col-md-6 bank_fields">
                {!! Form::label('bank_address', __('lang.bank_address') ,[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('bank_address', $money_safe->bank_address, ['class' => 'form-control', 'placeholder' =>
                __('lang.bank_address')]) !!}
            </div>
            {{-- <div class="col-md-6 bank_fields">
                {!! Form::label('credit_card_currency_id', __('lang.credit_card_default_currency') . ':*') !!}
                {!! Form::select('credit_card_currency_id', $currencies, $money_safe->credit_card_currency_id, ['class'
                => 'form-control selectpicker bank_required', 'data-live-search' => 'true', 'placeholder' =>
                __('lang.please_select')]) !!}
            </div>
            <div class="col-md-6 bank_fields">
                {!! Form::label('bank_transfer_currency_id', __('lang.bank_transfer_default_currency') . ':*') !!}
                {!! Form::select('bank_transfer_currency_id', $currencies, $money_safe->bank_transfer_currency_id,
                ['class' => 'form-control selectpicker bank_required', 'data-live-search' => 'true', 'placeholder' =>
                __('lang.please_select')]) !!}
            </div> --}}
            <div class="col-md-6 cash_fields">
                {!! Form::label('add_money_users', __('lang.add_money_users') ,[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::select('add_money_users[]', $employees, $money_safe->add_money_users, ['class' =>
                'form-control selectpicker', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'multiple'])
                !!}
            </div>
            <div class="col-md-6 cash_fields">
                {!! Form::label('take_money_users', __('lang.take_money_users') ,[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::select('take_money_users[]', $employees, $money_safe->take_money_users, ['class' =>
                'form-control selectpicker', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'multiple'])
                !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang( 'lang.save' )</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker();
    @if ($money_safe->type == 'cash')
        $('.bank_fields').hide();
    @else
        $('.cash_fields').hide();
    @endif
    $('select#type').change();
    $(document).on('change', '#type', function() {
        let type = $(this).val();
        if (type == 'cash') {
            $('.bank_fields').hide();
            $('.cash_fields').show();
            $('.bank_required').attr('required', false);
        }
        if (type == 'bank') {
            $('.bank_fields').show();
            $('.cash_fields').hide();
            $('.bank_required').attr('required', true);
        }
    })
</script>