<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ExchangeRateController@update', $exchange_rate->id), 'method' => 'put', 'id' =>
        'exchange_rate_add_form']) !!}

        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.edit_rate' )</h4>
        </x-modal-header>

        <div class="modal-body row locale_dir">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('store_id', __('lang.store') ,[
                    'class' =>"locale_label mb-1 field_required"
                    ]) !!}
                    {!! Form::select('store_id', $stores, $exchange_rate->store_id, ['class' => 'form-control
                    selectpicker', 'data-live-search' => 'true', 'id' => 'store_id', 'placeholder' =>
                    __('lang.please_select'), 'required']) !!}
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('received_currency_id', __('lang.received_currency') ,[
                    'class' =>"locale_label mb-1 field_required"
                    ]) !!}
                    {!! Form::select('received_currency_id', $currencies_excl, $exchange_rate->received_currency_id,
                    ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'id' =>
                    'received_currency_id', 'placeholder' => __('lang.please_select'), 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('conversion_rate', __('lang.enter_the_rate') ,[
                    'class' =>"locale_label mb-1 field_required"
                    ]) !!}
                    {!! Form::text('conversion_rate', rtrim(number_format($exchange_rate->conversion_rate, 8, '.',
                    ''), '0') , ['class' => 'form-control', 'placeholder' => __('lang.enter_the_rate'), 'required'])
                    !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('default_currency_id', __('lang.default_currency') ,[
                    'class' =>"locale_label mb-1 field_required"
                    ]) !!}
                    {!! Form::select('default_currency_id', $currencies_all, $exchange_rate->default_currency_id,
                    ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'id' =>
                    'default_currency_id', 'placeholder' => __('lang.please_select'), 'required']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('expiry_date', __('lang.expiry_date'),[
                    'class' =>"locale_label mb-1 "
                    ]) !!}
                    {!! Form::date('expiry_date', $exchange_rate->expiry_date, ['class' => 'form-control',
                    'placeholder' => __('lang.expiry_date')]) !!}
                </div>
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
    $('.selectpicker').selectpicker('refresh');
</script>