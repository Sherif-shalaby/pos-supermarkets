@extends('layouts.app')
@section('title', __('lang.modules'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <div class="col-md-12  no-print">

            <x-page-title>

                <h4>@lang('lang.modules')</h4>


                <x-slot name="buttons">

                </x-slot>
            </x-page-title>
            {!! Form::open(['url' => action('SettingController@updateModuleSettings'), 'method' => 'post', 'enctype' =>
            'multipart/form-data']) !!}
            <div class="row">
                @foreach ($modules as $key => $name)
                @if(session('system_mode') != 'restaurant' && session('system_mode') != 'garments' &&
                session('system_mode') != 'pos')
                @if($key == 'raw_material_module')
                @continue
                @endif
                @endif
                <div class="col-md-3">
                    <div class="card mt-1 mb-0">
                        <div class="card-body py-2 px-4 flex_center">
                            <div class="i-checks toggle-pill-color flex_center flex-column">
                                <input id="{{$loop->index}}" name="module_settings[{{$key}}]" type="checkbox" @if(
                                    !empty($module_settings[$key]) ) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="{{$loop->index}}">
                                </label>
                                <span>
                                    <strong>{{__('lang.'.$key)}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</section>

@endsection

@section('javascript')
<script>

</script>
@endsection