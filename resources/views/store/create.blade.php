<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('StoreController@store'), 'method' => 'post', 'id' => $quick_add ?
        'quick_add_store_form' : 'store_add_form' ]) !!}


        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.add_store' )</h4>

        </x-modal-header>

        <div class="modal-body row locale_dir">
            <div class="col-md-6">
                {!! Form::label('name', __( 'lang.name' ),[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('location', __( 'lang.location' ),[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => __( 'lang.location' ) ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('phone_number', __( 'lang.phone_number' ),[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __(
                'lang.phone_number' ) ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('email', __( 'lang.email' ),[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __( 'lang.email' ) ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('manager_name', __( 'lang.manager_name' )
                ,[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('manager_name', null, ['class' => 'form-control', 'placeholder' => __(
                'lang.manager_name' ) ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('manager_mobile_number', __( 'lang.manager_mobile_number' ),[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::text('manager_mobile_number', null, ['class' => 'form-control', 'placeholder' => __(
                'lang.manager_mobile_number' ) ])
                !!}
            </div>
            <div class="col-md-12">
                {!! Form::label('details', __( 'lang.details' ),[
                'class' =>"locale_label mb-1 "
                ]) !!}
                {!! Form::textarea('details', null, ['class' => 'form-control', 'placeholder' => __( 'lang.details' ),
                'rows' => '3' ])
                !!}
            </div>
            <input type="hidden" name="quick_add" value="{{$quick_add }}">
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang( 'lang.save' )</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->