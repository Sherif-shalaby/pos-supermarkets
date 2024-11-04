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
                {!! Form::open(['url' => action('SmsController@saveSetting'), 'method' => 'post', 'id' => 'sms_form'
                ]) !!}
                <div class="col-md-12">
                    <div class=" row locale_dir">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="locale_label mb-1" for="sms_username">{{__('lang.username')}}</label>
                                <input type="text" class="form-control" id="sms_username" name="sms_username" required
                                    value="@if(!empty($settings['sms_username'])){{$settings['sms_username']}}@endif">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="locale_label mb-1" for="sms_password">{{__('lang.password')}}</label>
                                <input type="text" class="form-control" id="sms_password" name="sms_password" required
                                    value="@if(!empty($settings['sms_password'])){{$settings['sms_password']}}@endif">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="locale_label mb-1"
                                    for="sms_sender_name">{{__('lang.sender_name')}}</label>
                                <input type="text" class="form-control" id="sms_sender_name" name="sms_sender_name"
                                    required
                                    value="@if(!empty($settings['sms_sender_name'])){{$settings['sms_sender_name']}}@endif">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <button type="submit" name="submit" id="print" style="margin: 10px" value="save"
                        class="btn btn-primary pull-right btn-flat submit">@lang( 'lang.save' )</button>

                </div>
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