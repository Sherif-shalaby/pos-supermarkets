@php
$recent_product = App\Models\Product::where('is_raw_material', 0)
->orderBy('created_at', 'desc')
->first();
$clear_all_input_form = App\Models\System::getProperty('clear_all_input_form');
@endphp
<div class="card mb-1">
    <div class="card-body py-1 mb-1">
        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input id="is_service" name="is_service" type="checkbox" @if (session('system_mode')=='restaurant' )
                        checked @elseif(!empty($recent_product) && $recent_product->is_service == 1) checked @endif
                    class="form-control-custom">
                    <label for="is_service">
                    </label>
                    <span class="text-center">
                        <strong>
                            @if (session('system_mode') == 'restaurant')
                            @lang('lang.or_add_new_product')
                            @else
                            @lang('lang.add_new_service')
                            @endif
                        </strong>

                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input id="active" name="active" type="checkbox" checked value="1" class="form-control-custom">
                    <label for="active">
                    </label>
                    <span class="text-center">
                        <strong>
                            @lang('lang.active')
                        </strong>

                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input id="have_weight" name="have_weight" type="checkbox" value="1" class="form-control-custom">
                    <label for="have_weight">
                    </label>
                    <span class="text-center">
                        <strong>@lang('lang.have_weight')</strong>

                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input @if (!empty($product->weighing_scale_barcode)) checked @endif id="weighing_scale_barcode"
                    name="weighing_scale_barcode" type="checkbox" value="1" class="form-control-custom">
                    <label for="weighing_scale_barcode">
                    </label>
                    <span class="text-center">
                        <strong>
                            @lang('lang.weighing_scale_barcode')
                        </strong>

                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input @if ($clear_all_input_form==null || $clear_all_input_form=='1' ) checked @endif
                        id="clear_all_input_form" name="clear_all_input_form" type="checkbox" value="1"
                        class="form-control-custom">
                    <label for="clear_all_input_form">
                    </label>
                    <span class="text-center">
                        <strong>
                            @lang('lang.clear_all_input_form')
                        </strong>

                    </span>
                </div>
            </div>

            @php
            $products_count=App\Models\Product::where('show_at_the_main_pos_page','yes')->count();
            @endphp
            <div class="col-md-2">
                <div class="i-checks toggle-pill-color flex_center flex-column">
                    <input @if (isset($products_count)&& $products_count> 40) disabled @endif
                    id="show_at_the_main_pos_page" name="show_at_the_main_pos_page" type="checkbox"
                    class="form-control-custom">
                    <label for="show_at_the_main_pos_page">
                    </label>
                    <span class="text-center">
                        <strong>@lang('lang.show_at_the_main_pos_page')</strong>

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-1">
    <div class="card-body py-1 mb-1">
        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <div class="col-12 mb-2">
                <p class="italic mb-0 @if (app()->isLocale('ar')) text-right @else text-left @endif">
                    <small>@lang('lang.required_fields_info')</small>
                </p>
            </div>


            <div class="col-md-4 mb-2 px-5">
                <div class="form-group">
                    {!! Form::label('store_ids', __('lang.store'),[ 'class' =>"locale_label mb-1"]) !!}
                    {!! Form::select('store_ids[]', $stores_select, array_keys($stores_select) , ['class' => '
                    selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%',
                    'multiple','id'=>'store_ids']) !!}
                </div>
            </div>
            <div class="col-md-4 mb-2 px-5">
                @if (session('system_mode') == 'restaurant')
                {!! Form::label('product_class_id', __('lang.category') ,[ 'class' =>"locale_label mb-1
                field_required"]) !!}
                @else
                {!! Form::label('product_class_id', __('lang.class') ,[ 'class' =>"locale_label mb-1 field_required"])
                !!}
                @endif
                <div class="input-group my-group">
                    {!! Form::select('product_class_id', $product_classes, !empty($recent_product) ?
                    $recent_product->product_class_id : false, ['class' => 'clear_input_form selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'),
                    'required']) !!}
                    <span class="input-group-btn">
                        @can('product_module.product_class.create_and_edit')
                        <button type="button" class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('ProductClassController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
                <div class="error-msg text-red"></div>
            </div>

            @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') ==
            'supermarket')
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('category_id', __('lang.category') ,[ 'class' =>"locale_label mb-1 field_required"]) !!}
                <div class="input-group my-group">
                    <input type="hidden"
                        data-category_id="{{!empty($recent_product) ? $recent_product->category_id : null}}"
                        id="category_value_id" />
                    {!! Form::select('category_id', $categories, !empty($recent_product) ? $recent_product->category_id
                    : false, ['class' => 'clear_input_form selectpicker form-control', 'data-live-search' => 'true',
                    'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), ]) !!}
                    <span class="input-group-btn">
                        @can('product_module.category.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('CategoryController@create') }}?quick_add=1&type=category"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
                <div class="error-msg text-red"></div>
            </div>
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('sub_category_id', __('lang.sub_category'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {{-- <input type="hidden"
                        data-sub_category_id="{{!empty($recent_product) ? $recent_product->sub_category_id : null}}"
                        id="sub_category_value_id" /> --}}
                    {!! Form::select('sub_category_id', [], !empty($recent_product) ? $recent_product->sub_category_id :
                    false, ['class' => 'clear_input_form selectpicker form-control', 'data-live-search' => 'true',
                    'style' => 'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                    <span class="input-group-btn">
                        @can('product_module.sub_category.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('CategoryController@create') }}?quick_add=1&type=sub_category"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
                <div class="error-msg text-red"></div>
            </div>
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('brand_id', __('lang.brand'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {!! Form::select('brand_id', $brands, !empty($recent_product) ? $recent_product->brand_id : false,
                    ['class' => 'clear_input_form selectpicker form-control', 'data-live-search' => 'true', 'style' =>
                    'width: 80%', 'placeholder' => __('lang.please_select'), 'required']) !!}
                    <span class="input-group-btn">
                        @can('product_module.brand.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('BrandController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
                <div class="error-msg text-red"></div>
            </div>
            @endif
            <div class="col-md-4 mb-2 px-5">
                <div class="form-group">
                    {!! Form::label('name', __('lang.name') ,[ 'class' =>"locale_label mb-1 field_required"]) !!}
                    <div class="input-group my-group">
                        {!! Form::text('name', null, ['class' => 'clear_input_form form-control', 'required',
                        'placeholder' => __('lang.name')]) !!}
                        <span class="input-group-btn">
                            <button class="btn btn-default bg-primary btn-flat trans_btn translation_btn" type="button"
                                data-type="product"><i class="dripicons-web text-white  fa-lg"></i></button>
                        </span>
                    </div>
                </div>
                @include('layouts.partials.translation_inputs', [
                'attribute' => 'name',
                'translations' => [],
                'type' => 'product',
                ])
            </div>
            <div class="col-md-4 mb-2 px-5">
                <div class="form-group">
                    {!! Form::label('sku', __('lang.sku'),[ 'class' =>"locale_label mb-1"]) !!}
                    {!! Form::text('sku', null, ['class' => 'clear_input_form form-control','id'=>'sku', 'placeholder'
                    => __('lang.sku')]) !!}
                </div>
            </div>
            @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') ==
            'supermarket')
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('multiple_units', __('lang.unit'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {!! Form::select('multiple_units[]', $units, !empty($recent_product) ?
                    $recent_product->multiple_units : false, ['class' => 'clear_input_form selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'),
                    'id' => 'multiple_units']) !!}
                    <span class="input-group-btn">
                        @can('product_module.unit.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('UnitController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
            </div>
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('multiple_colors', __('lang.color'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {!! Form::select('multiple_colors[]', $colors, !empty($recent_product) ?
                    $recent_product->multiple_colors : false, ['class' => 'clear_input_form selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'),
                    'id' => 'multiple_colors']) !!}
                    <span class="input-group-btn">
                        @can('product_module.color.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('ColorController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
            </div>
            @endif
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('multiple_sizes', __('lang.size'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {!! Form::select('multiple_sizes[]', $sizes, !empty($recent_product) ?
                    $recent_product->multiple_sizes : false, ['class' => 'clear_input_form selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'),
                    'id' => 'multiple_sizes']) !!}
                    <span class="input-group-btn">
                        @can('product_module.size.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('SizeController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
            </div>

            @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') ==
            'supermarket')
            <div class="col-md-4 mb-2 px-5">
                {!! Form::label('multiple_grades', __('lang.grade'),[ 'class' =>"locale_label mb-1"]) !!}
                <div class="input-group my-group">
                    {!! Form::select('multiple_grades[]', $grades, !empty($recent_product) ?
                    $recent_product->multiple_grades : false, ['class' => 'clear_input_form selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'),
                    'id' => 'multiple_grades']) !!}
                    <span class="input-group-btn">
                        @can('product_module.grade.create_and_edit')
                        <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                            data-href="{{ action('GradeController@create') }}?quick_add=1"
                            data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
            </div>

            @endif
            <div class="col-md-4 mb-2 px-5">
                <div class="form-group">
                    <label class="locale_label mb-1" for="printers">{{trans('lang.printers')}}</label>
                    <div class="input-group my-group">
                        <select id="printers" data-live-search="true" class="selectpicker form-control"
                            name="printers[]" multiple>
                            @foreach($printers as $printer)
                            <option value="{{$printer->id}}">{{$printer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-collapse collapse-id="productImage" button-class="collapse-btn d-flex mb-1 justify-content-between flex-row-reverse
    align-items-center gap-10 product_collapse_shadow" group-class="d-flex mb-2 align-items-end flex-column">
    <x-slot name="button">
        @lang('lang.add_product_image')
        <div class="collapse_arrow">
            <i class="fas fa-arrow-down"></i>
        </div>
    </x-slot>

    <div class="row px-2">

        <div class="col-12">
            <div class="variants">
                <div class='file file--upload w-100'>
                    <label for='file-input' class="w-100">
                        <i class="fas fa-cloud-upload-alt"></i>Upload
                    </label>
                    <!-- <input  id="file-input" multiple type='file' /> -->
                    <input type="file" id="file-input">
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="preview-container"></div>
        </div>
    </div>

    {{-- <div style="display: none" class="dropzone" id="my-dropzone">--}}
        {{-- <div style="display: none" class="dz-message" data-dz-message>
            <span>@lang('lang.drop_file_here_to_upload')</span>
        </div>--}}
        {{-- </div>--}}

</x-collapse>

<x-collapse collapse-id="productRecipe" button-class="collapse-btn d-flex mb-1 justify-content-between flex-row-reverse
    align-items-center gap-10 product_collapse_shadow" group-class="d-flex mb-2 align-items-end flex-column">
    <x-slot name="button">
        {{ __('lang.recipe') }}
        <div class="collapse_arrow">
            <i class="fas fa-arrow-down"></i>
        </div>
    </x-slot>

    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group">
                    @if (session('system_mode') == 'restaurant')
                    {!! Form::label('recipe', __('lang.recipe'),[ 'class' =>"locale_label mb-1"]) !!}
                    @else
                    <label class="locale_label mb-1">@lang('lang.product_details')</label>
                    @endif
                    <button type="button" class="translation_textarea_btn btn btn-sm"><i
                            class="dripicons-web text-primary fa-lg"></i></button>
                    <textarea name="product_details" id="product_details" class="form-control"
                        rows="3">{{ !empty($recent_product) ? $recent_product->product_details : '' }}</textarea>
                </div>
                <div class="col-md-4 mb-2 px-5">
                    @include('layouts.partials.translation_textarea', [
                    'attribute' => 'product_details',
                    'translations' => [],
                    ])
                </div>
            </div>
        </div>
    </div>
</x-collapse>


<x-collapse collapse-id="productRawMaterial" button-class="collapse-btn d-flex mb-1 justify-content-between flex-row-reverse
    align-items-center gap-10 product_collapse_shadow" group-class="d-flex mb-2 align-items-end flex-column">
    <x-slot name="button">
        {{ __('lang.add_raw_material') }}
        <div class="collapse_arrow">
            <i class="fas fa-arrow-down"></i>
        </div>
    </x-slot>


    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
        @if (session('system_mode') == 'restaurant' || session('system_mode') == 'garments' ||
        session('system_mode') == 'pos')
        <div class="col-md-4 mb-2 px-5">
            <div class="i-checks toggle-pill-color">
                <input id="automatic_consumption" name="automatic_consumption" type="checkbox" value="1"
                    class="form-control-custom">
                <label for="automatic_consumption">
                </label>
                <span>
                    <strong>@lang('lang.automatic_consumption')</strong>
                </span>
            </div>
        </div>
        <div class="col-md-4 mb-2 px-5">
            <div class="i-checks toggle-pill-color">
                <input @if (!empty($recent_product) && $recent_product->price_based_on_raw_material == 1) checked
                @endif
                id="price_based_on_raw_material" name="price_based_on_raw_material" type="checkbox"
                value="1" class="form-control-custom">
                <label for="price_based_on_raw_material">
                </label>
                <span>
                    <strong>@lang('lang.price_based_on_raw_material')</strong>
                </span>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered" id="consumption_table">
                <thead>
                    <tr>
                        <th style="width: 30%;">@lang('lang.raw_materials')</th>
                        <th style="width: 30%;">@lang('lang.used_amount')</th>
                        <th style="width: 30%;">@lang('lang.unit')</th>
                        <th style="width: 30%;">@lang('lang.cost')</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @include('product.partial.raw_material_row', ['row_id' => 0])
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <button class="btn btn-xs btn-primary add_raw_material_row" type="button"><i
                        class="fa fa-plus"></i></button>
            </div>
            <input type="hidden" name="raw_material_row_index" id="raw_material_row_index" value="1">
        </div>
        @endif
    </div>
</x-collapse>

<x-collapse collapse-id="productSelling" button-class="collapse-btn d-flex mb-1 justify-content-between flex-row-reverse
    align-items-center gap-10 product_collapse_shadow" group-class="d-flex mb-2 align-items-end flex-column">
    <x-slot name="button">
        {{ __('lang.discount_info') }}
        <div class="collapse_arrow">
            <i class="fas fa-arrow-down"></i>
        </div>
    </x-slot>


    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
        @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') ==
        'supermarket')
        <div class="col-md-4 mb-2 px-5">
            <div class="form-group">
                {!! Form::label('barcode_type', __('lang.barcode_type'),[ 'class' =>"locale_label mb-1"]) !!}
                {!! Form::select('barcode_type', ['C128' => 'Code 128', 'C39' => 'Code 39', 'UPCA' => 'UPC-A',
                'UPCE' => 'UPC-E', 'EAN8' => 'EAN-8', 'EAN13' => 'EAN-13'], !empty($recent_product) ?
                $recent_product->barcode_type : false, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="col-md-4 mb-2 px-5">
            <div class="form-group">
                {!! Form::label('alert_quantity', __('lang.alert_quantity'),[ 'class' =>"locale_label mb-1"]) !!}
                {!! Form::text('alert_quantity', !empty($recent_product) ?
                @num_format($recent_product->alert_quantity) : 3, ['class' => 'clear_input_form form-control',
                'placeholder' => __('lang.alert_quantity')]) !!}
            </div>
        </div>
        @endif
        <div class="col-md-4 mb-2 px-5">
            <div class="form-group">
                {!! Form::label('other_cost', __('lang.other_cost'),[ 'class' =>"locale_label mb-1"]) !!}
                {!! Form::text('other_cost', !empty($recent_product) ? @num_format($recent_product->other_cost) :
                null, ['class' => 'clear_input_form form-control', 'placeholder' => __('lang.other_cost')]) !!}
            </div>
        </div>
        @can('product_module.purchase_price.create_and_edit')
        <div class="col-md-4 supplier_div">
            <div class="form-group">
                {!! Form::label('purchase_price', session('system_mode') == 'pos' || session('system_mode') ==
                'garments' || session('system_mode') == 'supermarket' ? __('lang.purchase_price') : __('lang.cost')
                ,[ 'class' =>"locale_label mb-1 field_required"]) !!}
                {!! Form::text('purchase_price', !empty($recent_product) ?
                @num_format($recent_product->purchase_price) : null, ['class' => 'clear_input_form form-control',
                'placeholder' => session('system_mode') == 'pos' || session('system_mode') == 'garments' ||
                session('system_mode') == 'supermarket' ? __('lang.purchase_price') : __('lang.cost'), 'required'])
                !!}
            </div>
        </div>
        @endcan
        <div class="col-md-4 supplier_div">
            <div class="form-group">
                {!! Form::label('sell_price', __('lang.sell_price'),[ 'class' =>"locale_label mb-1 field_required"]) !!}
                {!! Form::text('sell_price', !empty($recent_product) ? @num_format($recent_product->sell_price) :
                null, ['class' => 'clear_input_form form-control', 'placeholder' => __('lang.sell_price'),
                'required']) !!}
            </div>
        </div>
        <div class="col-md-4 mb-2 px-5">
            {!! Form::label('tax_id', __('lang.tax'),[ 'class' =>"locale_label mb-1"]) !!}
            <div class="input-group my-group">
                {!! Form::select('tax_id', $taxes, !empty($recent_product) ? $recent_product->tax_id : false,
                ['class' => 'clear_input_form selectpicker form-control', 'data-live-search' => 'true', 'style' =>
                'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                <span class="input-group-btn">
                    @can('product_module.tax.create')
                    <button class="btn-modal btn btn-default bg-primary trans_btn btn-flat"
                        data-href="{{ action('TaxController@create') }}?quick_add=1&type=product_tax"
                        data-container=".view_modal"><i class="fa fa-plus-circle text-white fa-lg"></i></button>
                    @endcan
                </span>
            </div>
            <div class="error-msg text-red"></div>
        </div>
        <div class="col-md-4 mb-2 px-5">
            <div class="form-group">
                {!! Form::label('tax_method', __('lang.tax_method'),[ 'class' =>"locale_label mb-1"]) !!}
                {!! Form::select('tax_method', ['inclusive' => __('lang.inclusive'), 'exclusive' =>
                __('lang.exclusive')], !empty($recent_product) ? $recent_product->tax_method : false, ['class' =>
                'clear_input_form selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%',
                'placeholder' => __('lang.please_select')]) !!}
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
    </div>
</x-collapse>

<x-collapse collapse-id="productPurchase" button-class="collapse-btn d-flex mb-1 justify-content-between flex-row-reverse
    align-items-center gap-10 product_collapse_shadow" group-class="d-flex mb-2 align-items-end flex-column">
    <x-slot name="button">
        {{ __('lang.more_info') }}
        <div class="collapse_arrow">
            <i class="fas fa-arrow-down"></i>
        </div>
    </x-slot>


    <div class="row px-3 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
        <div class="col-md-12">
            <table class="table table-bordered" id="consumption_table_discount">
                <thead>
                    <tr>
                        <th style="width: 20%;">@lang('lang.discount_type')</th>
                        <th style="width: 15%;">@lang('lang.discount')</th>
                        <th style="width: 10%;">@lang('lang.discount_category')</th>
                        <th style="width: 5%;"></th>
                        <th style="width: 20%;">@lang('lang.discount_start_date')</th>
                        <th style="width: 20%;">@lang('lang.discount_end_date')</th>
                        <th style="width: 20%;">@lang('lang.customer_type') <i class="dripicons-question"
                                data-toggle="tooltip" title="@lang('lang.discount_customer_info')"></i></th>
                        <th style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @include('product.partial.raw_discount', ['row_id' => 0]) --}}
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <button class="btn btn-xs btn-primary add_discount_row" type="button"><i
                        class="fa fa-plus"></i></button>
            </div>
            <input type="hidden" name="raw_discount_index" id="raw_discount_index" value="1">
        </div>




        <input type="hidden" name="default_purchase_price_percentage" id="default_purchase_price_percentage"
            value="{{ App\Models\System::getProperty('default_purchase_price_percentage') ?? 75 }}">
        <input type="hidden" name="default_profit_percentage" id="default_profit_percentage"
            value="{{ App\Models\System::getProperty('default_profit_percentage') ?? 0 }}">

        <div class="col-md-4 mb-2 px-5">
            <div class="i-checks toggle-pill-color">
                <input id="show_to_customer" name="show_to_customer" type="checkbox" checked value="1"
                    class="form-control-custom">
                <label for="show_to_customer">
                </label>
                <span>
                    <strong>@lang('lang.show_to_customer')</strong>
                </span>
            </div>
        </div>

        <div class="col-md-12 show_to_customer_type_div">
            <div class="col-md-4 mb-2 px-5">
                <div class="form-group">
                    {!! Form::label('show_to_customer_types', __('lang.show_to_customer_types'),[ 'class'
                    =>"locale_label mb-1"]) !!}
                    <i class="dripicons-question" data-toggle="tooltip"
                        title="@lang('lang.show_to_customer_types_info')"></i>
                    {!! Form::select('show_to_customer_types[]', $customer_types, !empty($recent_product) ?
                    $recent_product->show_to_customer_types : false, ['class' => ' selectpicker form-control',
                    'data-live-search' => 'true', 'style' => 'width: 80%', 'multiple']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 10px">
            <div class="i-checks toggle-pill-color">
                <input id="different_prices_for_stores" name="different_prices_for_stores" type="checkbox" value="1"
                    class="form-control-custom">
                <label for="different_prices_for_stores">
                </label>
                <span>
                    <strong>@lang('lang.different_prices_for_stores')</strong>
                </span>
            </div>
        </div>

        <div class="col-md-12 px-2 different_prices_for_stores_div">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            @lang('lang.store')
                        </th>
                        <th>
                            @lang('lang.price')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->name }}</td>
                        <td><input type="text" class="form-control store_prices" style="width: 200px;"
                                name="product_stores[{{ $store->id }}][price]" value=""></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-12" style="margin-top: 10px">
            <div class="i-checks toggle-pill-color">
                <input id="this_product_have_variant" name="this_product_have_variant" type="checkbox" value="1"
                    class="form-control-custom">
                <label for="this_product_have_variant">
                </label>
                <span>
                    <strong>@lang('lang.this_product_have_variant')</strong>
                </span>
            </div>
        </div>

        <div class="col-md-12 this_product_have_variant_div" style="overflow: auto">
            <table class="table" id="variation_table">
                <thead>
                    <tr>
                        <th>@lang('lang.name')</th>
                        <th>@lang('lang.sku')</th>
                        <th>@lang('lang.color')</th>
                        <th>@lang('lang.size')</th>
                        <th>@lang('lang.grade')</th>
                        <th>@lang('lang.unit')</th>
                        <th>@lang('lang.number_vs_base_unit')</th>
                        {{-- @if(empty($is_service)) hide @endif --}}
                        <th class="default_purchase_price_th @if(empty($is_service)) hide @endif">
                            @lang('lang.purchase_price')</th>
                        <th class="default_sell_price_th @if(empty($is_service)) hide @endif">
                            @lang('lang.sell_price')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-xs add_row mt-2"><i
                        class="dripicons-plus"></i></button>
            </div>
        </div>
        <input type="hidden" name="row_id" id="row_id" value="0">
    </div>
</x-collapse>
