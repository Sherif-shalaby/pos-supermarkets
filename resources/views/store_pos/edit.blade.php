<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('StorePosController@update', $store_pos->id), 'method' => 'put', 'id' =>
        'store_pos_edit_form' ]) !!}

        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.edit_pos_for_store' )</h4>

        </x-modal-header>

        <div class="modal-body row locale_dir">
            <div class="col-md-6">
                {!! Form::label('store_id', __('lang.store') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::select('store_id', $stores,
                $store_pos->store_id, ['class' => 'selectpicker form-control',
                'data-live-search'=>"true", 'required',
                'style' =>'width: 80%' , 'placeholder' => __('lang.please_select')]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('name', __( 'lang.name' ) ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::text('name', $store_pos->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ),
                'required'
                ])
                !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('user_id', __('lang.user') ,[
                'class' =>"locale_label mb-1 field_required"
                ]) !!}
                {!! Form::select('user_id', $users,
                $store_pos->user_id, ['class' => 'selectpicker form-control',
                'data-live-search'=>"true", 'required',
                'style' =>'width: 80%' , 'placeholder' => __('lang.please_select')]) !!}
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary col-6">@lang( 'lang.save' )</button>
            <button type="button" class="btn btn-default col-6" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $('.selectpicker').selectpicker('render');
</script>