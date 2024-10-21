<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ColorController@store'), 'method' => 'post', 'id' => $quick_add ?
        'quick_add_color_form' : 'color_add_form' ]) !!}


        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.add_color' )</h4>

        </x-modal-header>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                ])
                !!}
            </div>
            <input type="hidden" name="quick_add" value="{{$quick_add }}">
            <div class="form-group">
                {!! Form::label('color_hex', __( 'lang.color_hex' ) . ':*') !!}
                {!! Form::text('color_hex', null, ['class' => 'form-control', 'placeholder' => __( 'lang.color_hex' )
                ])
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
