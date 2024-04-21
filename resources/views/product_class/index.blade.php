@extends('layouts.app')
@section('title', __('lang.product_class'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 px-1  no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.product_classes')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    @can('product_module.product_class.create_and_edit')
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-center p-2">
                                <a style="color: white" data-href="{{ action('ProductClassController@create') }}"
                                    data-container=".view_modal" class="btn btn-modal btn-main col-md-3"><i
                                        class="dripicons-plus"></i>
                                    @lang('lang.add')</a>
                            </div>
                        </div>
                    @endcan

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="store_table" class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.image')</th>
                                            <th>@lang('lang.name')</th>
                                            <th>@lang('lang.description')</th>
                                            <th>@lang('lang.sort')</th>
                                            <th>@lang('lang.products_count')</th>
                                            <th>@lang('lang.categories_count')</th>
                                            <th>@lang('lang.active')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_classes as $product_class)
                                            <tr>
                                                <td><img src="@if (!empty($product_class->getFirstMediaUrl('product_class'))) {{ $product_class->getFirstMediaUrl('product_class') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                                                        alt="photo" width="50" height="50">
                                                <td>{{ $product_class->name }}</td>
                                                <td>{{ $product_class->description }}</td>
                                                <td>{{ $product_class->sort }}</td>
                                                <td>{{ $product_class->products_count }}</td>
                                                <td>{{ $product_class->categories_count }}</td>
                                                <td>
                                                    @if ($product_class->status == 1)
                                                        @lang('lang.yes')
                                                    @else
                                                        @lang('lang.no')
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-default btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">@lang('lang.action')
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                            user="menu">

                                                            @can('product_module.product_class.create_and_edit')
                                                                <li>

                                                                    <a data-href="{{ action('ProductClassController@edit', $product_class->id) }}"
                                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.edit')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @if ($product_class->name != 'Extras')
                                                                @can('product_module.product_class.delete')
                                                                    <li>
                                                                        <a data-href="{{ action('ProductClassController@destroy', $product_class->id) }}"
                                                                            data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                            class="btn text-red delete_item"><i
                                                                                class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a>
                                                                    </li>
                                                                @endcan
                                                            @endif
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
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')

@endsection
