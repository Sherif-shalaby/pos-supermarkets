@extends('layouts.app')
@section('title', __('lang.coupon'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">


        <x-page-title>

            <h4>@lang('lang.edit_coupon')</h4>

        </x-page-title>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                {!! Form::open(['url' => action('CouponController@update', $coupon->id), 'method' =>
                'put',
                'id' => 'coupon_add_form' ]) !!}

                <div class="row locale_dir">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('coupon_code', __( 'lang.coupon_code' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            <div class="input-group">
                                {!! Form::text('coupon_code', $coupon->coupon_code, ['class' =>
                                'form-control',
                                'placeholder' => __(
                                'lang.coupon_code' ), 'required' ])
                                !!}
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default btn-sm refresh_code"><i
                                            class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('customer_type_ids', __( 'lang.customer_type' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('customer_type_ids[]', $customer_types,
                            $coupon->customer_type_ids, ['class' => 'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('store_ids', __( 'lang.store' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('store_ids[]', $stores, $coupon->store_ids, ['class' =>
                            'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', 'required', 'id' =>
                            'store_ids']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('type', __( 'lang.type' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('type', ['fixed' => 'Fixed', 'percentage' => 'Percentage'],
                            $coupon->type, ['class' =>
                            'form-control', 'data-live-search' => 'true']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('amount', __( 'lang.amount' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::text('amount', @num_format($coupon->amount), ['class' =>
                            'form-control',
                            'placeholder'
                            => __( 'lang.amount' ),
                            'required' ])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="amount_to_be_purchase_checkbox"
                                    @if($coupon->amount_to_be_purchase_checkbox) checked @endif
                                name="amount_to_be_purchase_checkbox"
                                value="1">
                                @lang('lang.amount_to_be_purchase')
                            </label>
                            {!! Form::text('amount_to_be_purchase', $coupon->amount_to_be_purchase,
                            ['class' =>
                            'form-control amount_to_be_purchase' ,
                            'placeholder' => __( 'lang.amount_to_be_purchase' ) ])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('product_classification_tree.partials.product_selection_tree')
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('expiry_date', __( 'lang.expiry_date' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::text('expiry_date', !empty($coupon->expiry_date) ?
                            @format_date($coupon->expiry_date) : null, ['class' => 'form-control
                            datepicker',
                            'placeholder' => __(
                            'lang.expiry_date' )])
                            !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-primary" value="@lang('lang.save')" name="submit">
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="{{asset('js/product_selection_tree.js')}}"></script>
<script>
    $('.datepicker').datepicker({
        language: '{{session('language')}}',
        todayHighlight: true,
    });
    $('.selectpicker').selectpicker('render');
    // $('.selectpicker').selectpicker('selectAll');

    $('.amount_to_be_purchase_checkbox').change(function(){
        if($(this).prop('checked')){
            $('.amount_to_be_purchase').attr('required', true);
        }else{
            $('.amount_to_be_purchase').attr('required', false);
        }
    })

    $('.refresh_code').click()
    $(document).on('click', '.refresh_code', function(){
        console.log('asdf');
        $.ajax({
            method: 'get',
            url: '/coupon/generate-code',
            data: {  },
            success: function(result) {
                $('#coupon_code').val(result);
            },
        });
    })
</script>
@endsection