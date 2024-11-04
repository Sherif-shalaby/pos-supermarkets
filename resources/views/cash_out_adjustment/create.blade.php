@extends('layouts.app')
@section('title', __('lang.cash_out_adjustment'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <x-page-title>

            <h4>@lang('lang.cash_out_adjustment')</h4>

        </x-page-title>
        {!! Form::open(['url' => action('CashOutAdjustmentController@store'), 'method' => 'post', 'id' =>
        'sms_form', 'files' => true
        ]) !!}
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="col-md-12">
                    <div class="row locale_dir">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('store_id', __('lang.store'), [
                                'class' =>"locale_label mb-1"
                                ]) !!}
                                {!! Form::select('store_id', $stores, false, ['class' => 'form-control
                                selectpicker', 'id' => 'store_id' ,'placeholder' =>
                                __('lang.please_select')]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('user_id', __('lang.cashier'), [
                                'class' =>"locale_label mb-1"
                                ]) !!}
                                {!! Form::select('user_id', $users, false, ['class' => 'form-control
                                selectpicker', 'id' => 'user_id' ,'placeholder' =>
                                __('lang.please_select')]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('current_cash', __('lang.current_cash'), [
                                'class' =>"locale_label mb-1"
                                ]) !!}
                                {!! Form::text('current_cash', null, ['class' => 'form-control', 'id' =>
                                'current_cash' ,'placeholder' =>
                                __('lang.current_cash'), 'readonly']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('amount', __('lang.amount'), [
                                'class' =>"locale_label mb-1"
                                ]) !!}
                                {!! Form::text('amount', null, ['class' => 'form-control', 'id' => 'amount'
                                ,'placeholder' =>
                                __('lang.amount')]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('discrepancy', __('lang.discrepancy'), [
                                'class' =>"locale_label mb-1"
                                ]) !!}
                                {!! Form::text('discrepancy', null, ['class' => 'form-control', 'id' =>
                                'discrepancy' ,'placeholder' =>
                                __('lang.discrepancy')]) !!}
                            </div>
                        </div>
                        <input type="hidden" name="cash_register_id" id="cash_register_id" value="">

                    </div>
                </div>

                <div class="col-sm-12">
                    <button type="submit" name="submit" id="print" style="margin: 10px" value="save"
                        class="btn btn-primary pull-right btn-flat submit">@lang( 'lang.save' )</button>

                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

</section>
@endsection

@section('javascript')
<script type="text/javascript">
    $('.selectpicker').selectpicker()
    $(document).on('change', '#amount', function(){
        let amount = __read_number($('#amount'));
        let current_cash = __read_number($('#current_cash'));

        let discrepancy = amount - current_cash;

        __write_number($('#discrepancy'), discrepancy);

    });
    $(document).on('change', '#user_id', function(){
        let user_id = $(this).val();

        $.ajax({
            method: 'get',
            url: '/cash-out-adjustment/get-cash-details/1',
            data: {  },
            success: function(result) {
                if(result.store_id){
                    $('#store_id').val(result.store_id).selectpicker('refresh');
                }
                if(result.current_cash){
                    __write_number($('#current_cash'), result.current_cash);
                }
                if(result.cash_register_id){
                   $('#cash_register_id').val( result.cash_register_id);
                }
            },
        });
    })
</script>
@endsection