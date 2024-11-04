<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ColorController@update', $color->id), 'method' => 'put', 'id' =>
        'color_add_form' ]) !!}


        <x-modal-header>

            <h4 class="modal-title">@lang( 'lang.edit' )</h4>
        </x-modal-header>

        <div class="modal-body row locale_dir">

            <div class="col-md-6">
                {!! Form::label('name', __( 'lang.name' ) ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('name', $color->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ),
                'required' ])
                !!}
            </div>

            <div class="col-md-6">
                {!! Form::label('color_hex', __( 'lang.color_hex' ) ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('color_hex', $color->color_hex, ['class' => 'form-control', 'placeholder' => __(
                'lang.color_hex' ) ])
                !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang( 'lang.save' )</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->