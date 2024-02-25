    <div class="col-md-4 mb-2">
        {!! Form::label('customer_type_id', __('lang.customer_type') . '*', [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::select('customer_type_id', $customer_types, false, [
            'class' => 'selectpicker form-control',
            'data-live-search' => 'true',
            'required',
            'placeholder' => __('lang.please_select'),
        ]) !!}
    </div>

    <div class="col-md-4 mb-2">
        {!! Form::label('name', __('lang.name'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::text('name', null, [
            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            'placeholder' => __('lang.name'),
        ]) !!}
    </div>

    <div class="col-md-4 mb-2">
        {!! Form::label('mobile_number', __('lang.mobile_number') . '*', [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::text('mobile_number', null, [
            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            'placeholder' => __('lang.mobile_number'),
            'required',
        ]) !!}
    </div>

    <div class="col-md-4 mb-2">
        {!! Form::label('address', __('lang.address'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::textarea('address', null, [
            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            'rows' => 3,
            'style' => 'height:30px',
            'placeholder' => __('lang.address'),
        ]) !!}
    </div>

    <div class="col-md-4 mb-2">
        {!! Form::label('email', __('lang.email'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::email('email', null, [
            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            'placeholder' => __('lang.email'),
        ]) !!}
    </div>

    <div class="col-md-4 mb-2">
        {!! Form::label('photo', __('lang.photo'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
        {!! Form::file('image', [
            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            'style' => 'height:30px',
        ]) !!}
    </div>

    @if (session('system_mode') == 'garments')
        @can('customer_module.customer_sizes.create_and_edit')
            <div class="col-md-12">
                <button type="button" class="add_size_btn btn btn-primary mb-5">@lang('lang.add_size')</button>
            </div>
            <div class="col-md-12 mb-5 add_size_div hide">
                <div class="form-group">
                    {!! Form::label('name', __('lang.name') . ':*') !!}
                    {!! Form::text('size_data[name]', null, ['class' => 'form-control', 'placeholder' => __('lang.name')]) !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr class="">
                                    <th>@lang('lang.length_of_the_dress')</th>
                                    <th>@lang('lang.cm')</th>
                                    <th>@lang('lang.inches')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getAttributeListArray as $key => $value)
                                    <tr>
                                        <td>
                                            <label for="">{{ $value }}</label>
                                        </td>
                                        <td>
                                            <input type="number" data-name="{{ $key }}"
                                                name="size_data[{{ $key }}][cm]" class="form-control cm_size"
                                                step="any" placeholder="@lang('lang.cm')">
                                        </td>
                                        <td>
                                            <input type="number" data-name="{{ $key }}"
                                                name="size_data[{{ $key }}][inches]"
                                                class="form-control inches_size" step="any"
                                                placeholder="@lang('lang.inches')">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        @include('customer_size.partial.body_graph')
                    </div>
                </div>
            </div>
        @endcan
    @endif

    @if (empty($quick_add))
        <div class="col-md-12">
            <h3>@lang('lang.important_dates')</h3>
        </div>
        <div class="col-md-12">
            <div class="row">
                <table class="table table-bordered" id="important_date_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 25%;">@lang('lang.important_date')</th>
                            <th style="width: 25%;">@lang('lang.date')</th>
                            <th style="width: 25%;">@lang('lang.notify_before_days')</th>
                            <th style="width: 25%;"><button type="button" class="add_date btn btn-success btn-xs"><i
                                        class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="important_date_index" id="important_date_index" value="0">
    @endif

    <input type="hidden" name="quick_add" value="{{ $quick_add }}">

    <div class="modal-title referal-title position-relative"
        style="
            display: flex;
            justify-content: end;
            gap: 6px;
            padding-right: 46px;
            width: 100%
        ">
        <h4>@lang('lang.referral')
            <span class=" header-modal-pill"></span>
        </h4>
        <span class="referal-border"></span>
    </div>


    <input type="hidden" name="ref_index" value="1" id="ref_index">
    <div class="col-md-12" id="referral_div">
        <div class="row referred_row justify-content-center">
            <input type="hidden" name="" class="ref_row_index" value="0">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('referred_type', __('lang.referred_type'), [
                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                    ]) !!}
                    {!! Form::select(
                        'ref[0][referred_type]',
                        ['customer' => __('lang.customer'), 'supplier' => 'Supplier', 'employee' => __('lang.employee')],
                        null,
                        [
                            'class' => 'form-control selectpicker referred_type',
                            'data-live-search' => 'true',
                            'placeholder' => 'please select',
                        ],
                    ) !!}
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="form-group">
                    {!! Form::label('referred_by', __('lang.referred_by'), [
                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                    ]) !!}
                    {!! Form::select('ref[0][referred_by][]', $customers, false, [
                        'class' => 'form-control selectpicker referred_by',
                        'data-live-search' => 'true',
                        'data-actions-box' => 'true',
                        'multiple',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-12 referred_details">
            </div>
        </div>


    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <button type="button" class="add_referrals btn btn-main px-5 py-1">@lang('lang.add_new')</button>
    </div>
