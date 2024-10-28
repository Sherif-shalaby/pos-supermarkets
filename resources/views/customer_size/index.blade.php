@extends('layouts.app')
@section('title', __('lang.customer_size'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">

        <div class="col-md-12  no-print">

            <x-page-title>

                <x-slot name="buttons">

                    @can('product_module.customer_size.create_and_edit')
                    <a style="color: white" data-href="{{action('CustomerSizeController@create')}}"
                        data-container=".view_modal" class="btn btn-modal btn-info"><i class="dripicons-plus"></i>
                        @lang('lang.add_customer_size')</a>
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
                                    <th>@lang('lang.created_by')</th>
                                    <th>@lang('lang.created_at')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_sizes as $customer_size)
                                <tr>
                                    <td>{{$customer_size->name}}</td>
                                    <td>{{$customer_size->created_by_user ? $customer_size->created_by_user->name : ''
                                        }}
                                    </td>
                                    <td>{{@format_datetime($customer_size->created_at)}})</td>

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
                                                @can('customer_module.customer_sizes.create_and_edit')
                                                <li>

                                                    <a data-href="{{action('CustomerSizeController@edit', $customer_size->id)}}"
                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                            class="dripicons-document-edit"></i> @lang('lang.edit')</a>
                                                </li>
                                                <li class="divider"></li>
                                                @endcan
                                                @can('customer_module.customer_sizes.delete')
                                                <li>
                                                    <a data-href="{{action('CustomerSizeController@destroy', $customer_size->id)}}"
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