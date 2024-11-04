@extends('layouts.app')
@section('title', __('lang.weighing_scale_setting'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <div class="col-md-12  no-print">

            <x-page-title>

                <h4>@lang('lang.weighing_scale_setting')</h4>


                <x-slot name="buttons">

                </x-slot>
            </x-page-title>
            {!! Form::open(['url' => action('SettingController@postWeighingScaleSetting'), 'method' => 'post', 'enctype'
            =>
            'multipart/form-data']) !!}
            <div class="card mt-1 mb-0">
                <div class="card-body py-2 px-4">
                    <div class="row locale_dir">
                        <div class="col-sm-3">
                            <div class="i-checks toggle-pill-color" style="margin-top: 30px;">
                                <input id="enable" name="weighing_scale_setting[enable]" type="checkbox" @if(
                                    !empty($weighing_scale_setting['enable']) ) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="enable">
                                </label>
                                <span>
                                    <strong>{{__('lang.enable')}}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('label_prefix', __('lang.weighing_barcode_prefix') ,[
                                'class' =>"locale_label mb-1 "
                                ]) !!}
                                {!! Form::text('weighing_scale_setting[label_prefix]',
                                isset($weighing_scale_setting['label_prefix']) ? $weighing_scale_setting['label_prefix']
                                : null,
                                ['class' => 'form-control', 'id' => 'label_prefix']) !!}
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('product_sku_length', __('lang.weighing_product_sku_length') ,[
                                'class' =>"locale_label mb-1 "
                                ]) !!}

                                {!! Form::select('weighing_scale_setting[product_sku_length]', [1,2,3,4,5,6,7,8,9],
                                isset($weighing_scale_setting['product_sku_length']) ?
                                $weighing_scale_setting['product_sku_length'] : 4, ['class' => 'form-control select2',
                                'style'
                                => 'width: 100%;', 'id' => 'product_sku_length']) !!}
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('qty_length', __('lang.weighing_qty_integer_part_length') ,[
                                'class' =>"locale_label mb-1 "
                                ]) !!}

                                {!! Form::select('weighing_scale_setting[qty_length]', [1,2,3,4,5],
                                isset($weighing_scale_setting['qty_length']) ? $weighing_scale_setting['qty_length'] :
                                3,
                                ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'qty_length'])
                                !!}
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('qty_length_decimal', __('lang.weighing_qty_fractional_part_length'),[
                                'class' =>"locale_label mb-1 "
                                ]) !!}
                                {!! Form::select('weighing_scale_setting[qty_length_decimal]', [1,2,3,4],
                                isset($weighing_scale_setting['qty_length_decimal']) ?
                                $weighing_scale_setting['qty_length_decimal'] : 2, ['class' => 'form-control select2',
                                'style'
                                => 'width: 100%;', 'id' => 'qty_length_decimal']) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('last_digits_type', __('lang.last_digits_type') ,[
                                'class' =>"locale_label mb-1 "
                                ]) !!}
                                {!! Form::select('weighing_scale_setting[last_digits_type]', ['price' =>
                                __('lang.price'),
                                'quantity' => __('lang.quantity')],
                                isset($weighing_scale_setting['last_digits_type']) ?
                                $weighing_scale_setting['last_digits_type'] : 'quantity', ['class' => 'form-control
                                select2',
                                'style'
                                => 'width: 100%;', 'id' => 'last_digits_type', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</section>

@endsection

@section('javascript')
<script>

</script>
@endsection