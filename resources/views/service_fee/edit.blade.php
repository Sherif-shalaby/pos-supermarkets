<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ServiceFeeController@update', $service_fee->id), 'method' => 'put', 'id' =>
        'service_fee_add_form']) !!}


        <x-modal-header>

            <h4 class="modal-title">@lang( 'lang.edit' )</h4>
        </x-modal-header>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __('lang.name') . ':*') !!}
                {!! Form::text('name', $service_fee->name, ['class' => 'form-control', 'placeholder' => __('lang.name'),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('rate', __('lang.rate') . ':*') !!}
                {!! Form::text('rate', $service_fee->rate, ['class' => 'form-control', 'placeholder' =>
                __('lang.rate')]) !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang( 'lang.save' )</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
