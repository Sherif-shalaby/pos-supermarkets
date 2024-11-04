@extends('layouts.app')
@section('title', __('lang.earning_of_point_system'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">

        <x-page-title>

            <h3 class="print-title">@lang('lang.earning_of_point_system')</h3>

            <x-slot name="buttons">

                <a style="color: white" href="{{action('EarningOfPointController@create')}}" class="btn btn-primary"><i
                        class="dripicons-plus"></i>
                    @lang('lang.earning_of_point_system')</a>
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
                                <th>@lang('lang.date_and_time')</th>
                                <th>@lang('lang.created_by')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.stores')</th>
                                <th>@lang('lang.customer_types')</th>
                                <th>@lang('lang.products')</th>
                                <th>@lang('lang.points_on_per_amount_sale')</th>
                                <th>@lang('lang.start_date')</th>
                                <th>@lang('lang.expiry_date')</th>
                                <th class="notexport">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($earning_of_points as $earning_of_point)
                            <tr>
                                <td>{{$earning_of_point->created_at}}</td>
                                <td>{{ucfirst($earning_of_point->created_by_user->name ?? '')}}</td>
                                <td>{{$earning_of_point->number}}</td>
                                <td>{{implode(', ', $earning_of_point->stores->pluck('name')->toArray())}}</td>
                                <td>{{implode(', ', $earning_of_point->customer_types->pluck('name')->toArray())}}</td>
                                <td>{{implode(', ', $earning_of_point->products->pluck('name')->toArray())}}</td>
                                <td>{{@num_format($earning_of_point->points_on_per_amount)}}</td>
                                <td>@if(!empty($earning_of_point->start_date)){{@format_date($earning_of_point->start_date)}}@endif
                                </td>
                                <td>@if(!empty($earning_of_point->end_date)){{@format_date($earning_of_point->end_date)}}@endif
                                </td>
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
                                            @can('loyalty_points.earning_of_points.delete')
                                            <li>

                                                <a data-href="{{action('EarningOfPointController@show', $earning_of_point->id)}}"
                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                        class="dripicons-document"></i> @lang('lang.view')</a>
                                            </li>
                                            <li class="divider"></li>
                                            @endcan
                                            @can('loyalty_points.earning_of_points.view')
                                            <li>
                                                <a
                                                    href="{{action('EarningOfPointController@edit', $earning_of_point->id)}}"><i
                                                        class="dripicons-document-edit btn"></i>@lang('lang.edit')</a>
                                            </li>
                                            <li class="divider"></li>
                                            @endcan
                                            @can('loyalty_points.earning_of_points.delete')
                                            <li>
                                                <a data-href="{{action('EarningOfPointController@destroy', $earning_of_point->id)}}"
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
</section>

@endsection

@section('javascript')
<script>

</script>
@endsection