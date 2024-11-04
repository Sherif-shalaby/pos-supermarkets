<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('SizeController@store'), 'method' => 'post', 'id' => $quick_add ?
        'quick_add_size_form' : 'size_add_form' ]) !!}


        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.add_size' )</h4>
        </x-modal-header>


        <div class="modal-body row locale_dir">
            <div class="col-md-6">
                {!! Form::label('name', __( 'lang.name' ) ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                ])
                !!}
            </div>
            <input type="hidden" name="quick_add" value="{{$quick_add }}">
            <div class="col-md-6">
                {!! Form::label('size_code', __( 'lang.size_code' ) ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('size_code', null, ['class' => 'form-control', 'placeholder' => __( 'lang.size_code' )])
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