@extends('layouts.app')
@section('title', __('lang.earning_of_point_system'))
@section('content')

<section class="forms py-2">
    <div class="container-fluid px-2">

        <x-page-title>
            <h4>@lang('lang.edit_earning_of_point_system')</h4>
            <x-slot name="buttons">

            </x-slot>
        </x-page-title>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <p class="italic mb-0"><small>@lang('lang.required_fields_info')</small></p>
            </div>
        </div>
        {!! Form::open(['url' => action('EarningOfPointController@update', $earning_of_point->id), 'id'
        => 'customer-type-form',
        'method' =>
        'PUT', 'class' => '', 'enctype' => 'multipart/form-data']) !!}
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('number', __( 'lang.name' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('number', $earning_of_point->number, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('store_ids', __( 'lang.store' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('store_ids[]', $stores, $earning_of_point->store_ids, ['class' =>
                            'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', 'required',
                            "data-actions-box"=>"true"]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('customer_type_ids', __( 'lang.customer_type' ) ,[
                            'class' =>"locale_label mb-1 field_required"
                            ]) !!}
                            {!! Form::select('customer_type_ids[]', $customer_types,
                            $earning_of_point->customer_type_ids, ['class' => 'selectpicker
                            form-control', 'data-live-search' => "true", 'multiple', 'required',
                            "data-actions-box"=>"true"]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('product_classification_tree.partials.product_selection_tree')
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="d-flex flex-row-reverse" style="gap: 6px">

                                {!! Form::label('points_on_per_amount', __( 'lang.points_on_per_amount_sale' ) .
                                ':*') !!} <i class="dripicons-question" data-toggle="tooltip"
                                    title="@lang('lang.points_on_per_amount_info')"></i>
                            </div>
                            {!! Form::text('points_on_per_amount', $earning_of_point->points_on_per_amount,
                            ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start_date', __( 'lang.start_date' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('start_date', $earning_of_point->start_date, ['class' =>
                            'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('end_date', __( 'lang.end_date' ) ,[
                            'class' =>"locale_label mb-1 "
                            ]) !!}
                            {!! Form::text('end_date', $earning_of_point->end_date, ['class' => 'form-control'])
                            !!}
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
        <input type="hidden" name="is_edit_page" id="is_edit_page" value="1">
    </div>

</section>
@endsection

@section('javascript')
<script src="{{asset('js/product_selection_tree.js')}}"></script>
<script type="text/javascript">
</script>
@endsection