@extends('layouts.app')
@section('title', __('lang.service_fee'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <div class="col-md-12  no-print">


            <x-page-title>
                <x-slot name="buttons">
                    @can('settings.service_fee.create_and_edit')
                    <a style="color: white" data-href="{{action('ServiceFeeController@create')}}"
                        data-container=".view_modal" class="btn btn-modal btn-info"><i class="dripicons-plus"></i>
                        @lang('lang.add_service_fee')</a>
                    @endcan
                </x-slot>
            </x-page-title>

            <div
                class="top-controls py-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">

            </div>
            <div class="card mt-1 mb-0">
                <div class="card-body py-2 px-4">
                    <div class="table-responsive">
                        <table id="store_table" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.rate')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service_fees as $service_fee)
                                <tr>
                                    <td>{{$service_fee->name}}</td>
                                    <td>{{@num_format($service_fee->rate)}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">@lang('lang.action')
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                user="menu">
                                                @can('settings.service_fee.create_and_edit')
                                                <li>

                                                    <a data-href="{{action('ServiceFeeController@edit', $service_fee->id)}}"
                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                            class="dripicons-document-edit"></i> @lang('lang.edit')</a>
                                                </li>
                                                <li class="divider"></li>
                                                @endcan
                                                @can('settings.service_fee.delete')
                                                <li>
                                                    <a data-href="{{action('ServiceFeeController@destroy', $service_fee->id)}}"
                                                        data-check_password="{{action('UserController@checkPassword', Auth::user()->id)}}"
                                                        class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                        @lang('lang.delete')</a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div
                class="bottom-controls mt-1 p-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">
                <!-- Pagination and other controls can go here -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascript')

@endsection