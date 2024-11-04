@extends('layouts.app')
@section('title', __('lang.settings'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <x-page-title>

            <h4>@lang('lang.settings')</h4>


            <x-slot name="buttons">

            </x-slot>
        </x-page-title>
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                {!! Form::open(['url' => action('EmailController@saveSetting'), 'method' => 'post', 'id' =>
                'sms_form'
                ]) !!}
                <div class="col-md-12">
                    <div class=" row locale_dir">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="locale_label mb-1" for="sender_email">{{__('lang.email')}}</label>
                                <input type="text" class="form-control" id="sender_email" name="sender_email" required
                                    value="@if(!empty($settings['sender_email'])){{$settings['sender_email']}}@endif">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" id="print" style="margin: 10px" value="save"
                    class="btn btn-primary pull-right btn-flat submit">@lang( 'lang.save' )</button>

                {!! Form::close() !!}


            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection