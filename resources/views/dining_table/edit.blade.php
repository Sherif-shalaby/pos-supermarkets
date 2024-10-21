<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('DiningTableController@update', $dining_table->id), 'method' => 'put', 'files'
        => true]) !!}

        <x-modal-header>
            <h4 class="modal-title">@lang( 'lang.edit' )</h4>

        </x-modal-header>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __('lang.name') . ':*') !!}
                {!! Form::text('name', $dining_table->name, ['class' => 'form-control', 'placeholder' =>
                __('lang.name'), 'required', 'id' => 'dining_table_name']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('dining_room_id', __('lang.dining_room') . ':*') !!}
                {!! Form::select('dining_room_id', $dining_rooms, $dining_table->dining_room_id, ['class' =>
                'form-control selectpicker', 'data-live-search' => 'true', 'required', 'placeholder' =>
                __('lang.please_select')]) !!}
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
    $('.selectpicker').selectpicker();
</script>
