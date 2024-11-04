@extends('layouts.app')
@section('title', __('lang.earning_of_point_system'))
@section('content')

<section class="forms py-2">
    <div class="container-fluid px-2">


        <x-page-title>

            <h4>@lang('lang.add_earning_of_point_system')</h4>

        </x-page-title>



        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <p class="italic mb-0"><small>@lang('lang.required_fields_info')</small></p>
            </div>
        </div>
        {!! Form::open(['url' => action('EarningOfPointController@store'), 'id' => 'customer-type-form',
        'method' =>
        'POST', 'class' => '', 'enctype' => 'multipart/form-data']) !!}
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('number', __( 'lang.name' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('number', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('store_ids', __( 'lang.store' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('store_ids[]', $stores, false, ['class' => 'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', "data-actions-box"=>"true",
                            'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('customer_type_ids', __( 'lang.customer_type' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('customer_type_ids[]', $customer_types, false, ['class' =>
                            'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', "data-actions-box"=>"true",
                            'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        @include('product_classification_tree.partials.product_selection_tree')
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="d-flex flex-row-reverse" style="gap: 6px">

                                {!! Form::label('points_on_per_amount', __( 'lang.points_on_per_amount_sale' ) ,[
                                'class' =>"locale_label mb-1 field_required"
                                ]) !!} <i class="dripicons-question" data-toggle="tooltip"
                                    title="@lang('lang.points_on_per_amount_info')"></i>
                            </div>
                            {!! Form::text('points_on_per_amount', 1, ['class' => 'form-control', 'required'])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start_date', __( 'lang.start_date' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('end_date', __( 'lang.end_date' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" value="{{trans('lang.submit')}}" id="submit-btn"
                                class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

</section>
@endsection

@section('javascript')
<script src="{{asset('js/product_selection_tree.js')}}"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker('selectAll');
</script>
@endsection