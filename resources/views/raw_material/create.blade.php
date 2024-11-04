@extends('layouts.app')
@section('title', __('lang.raw_materials'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <x-page-title>

            <h4>@lang('lang.add_new_raw_material')</h4>

        </x-page-title>
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <p class="italic mb-0"><small>@lang('lang.required_fields_info')</small></p>
            </div>
        </div>

        {!! Form::open(['url' => action('RawMaterialController@store'), 'id' => 'product-form', 'method'
        =>
        'POST', 'class' => '', 'enctype' => 'multipart/form-data']) !!}
        @include('raw_material.partial.create_raw_material_form')
        <input type="hidden" name="active" value="1">
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="button" value="{{trans('lang.submit')}}" id="submit-btn"
                                class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>


</section>

<div class="modal fade" id="product_cropper_modal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <x-modal-header>

                <h5 class="modal-title">@lang('lang.crop_image_before_upload')</h5>
            </x-modal-header>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="product_sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="product_preview_div"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="product_crop" class="btn btn-primary col-6">@lang('lang.crop')</button>
                <button type="button" class="btn btn-default col-6" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{asset('js/product.js')}}"></script>
<script src="{{asset('js/raw_material.js')}}"></script>
<script type="text/javascript">

</script>
@endsection