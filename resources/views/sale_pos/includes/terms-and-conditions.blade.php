<div
    class="d-flex col-12 px-1 mt-1 justify-content-between align-items-start @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif table_room_hide ">

    <div class="col-md-3 px-1">
        <div class="form-group ">
            {!! Form::label('terms_and_condition_id', __('lang.terms_and_conditions'), [])
            !!}
            <select name="terms_and_condition_id" id="terms_and_condition_id" class="form-control selectpicker"
                data-live-search="true">
                <option value="">@lang('lang.please_select')</option>
                @foreach ($tac as $key => $item)
                <option value="{{ $key }}" {{!empty($term)&&$term->
                    id==$key?'selected':''}}>{{ $item }}</option @endforeach </select>
        </div>
        <div class="tac_description_div"><span></span></div>
    </div>
    <div class="col-md-3 px-1">
        <div class="form-group">
            {!! Form::label('commissioned_employees', __('lang.commissioned_employees'), [])
            !!}
            {!! Form::select('commissioned_employees[]', $employees, false, ['class' =>
            'form-control selectpicker', 'data-live-search' => 'true', 'multiple', 'id' =>
            'commissioned_employees']) !!}
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center hide shared_commission_div">
        <div class="i-checks toggle-pill-color d-flex flex-column align-items-center">
            <input id="shared_commission" name="shared_commission" type="checkbox" value="1"
                class="form-control-custom">
            <label for="shared_commission">
                <strong>
                </strong>
            </label>
            <span>

                @lang('lang.shared_commission')
            </span>
        </div>
    </div>

</div>
