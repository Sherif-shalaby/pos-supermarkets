@extends('layouts.app')
@section('title', __('lang.expense_category'))

@section('content')
<style>
    .close {
        width: 15px;
        height: 15px;
        background: #bb3434;
        float: right;
        opacity: 1;

        color: #fff !important;
        font-size: 11px;
        font-weight: 300;
        font-family: monospace;
        padding: 1px 4px;
        border-radius: 9px;
        margin-top: 5px;
        cursor: pointer;
    }

    .close:hover {
        width: 15px;
        height: 15px;
        background: #bb3434;
        float: right;
        opacity: 0.7;

        color: #fff !important;
        font-size: 11px;
        font-weight: 300;
        font-family: monospace;
        padding: 1px 4px;
        border-radius: 9px;
        margin-top: 5px;
        cursor: pointer;
    }
</style>


<section class="forms py-2">
    <div class="container-fluid px-2">


        <x-page-title>


            <h3 class="print-title">@lang('lang.expense_categories')</h3>

            <x-slot name="buttons">

                <a class="btn btn-primary ml-3" href="{{action('ExpenseCategoryController@create')}}">
                    <i class="fa fa-plus"></i> @lang( 'lang.add_expense_category' )</a>
            </x-slot>
        </x-page-title>


        <div
            class="top-controls py-1 d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap">

        </div>
        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>@lang('lang.sr_no')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.beneficiaries')</th>
                                <th class="sum">@lang('lang.money_paid')</th>
                                <th class="notexport">@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($expense_categories as $expense_category)
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>
                                    {{$expense_category->name}}
                                </td>
                                <td>
                                    @foreach ($expense_category->beneficiaries as $item)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <li style="color: rgb(74, 74, 253)">{{$item->name}} </li>
                                        </div>
                                        <div class="col-md-6">
                                            @can('expense.expense_beneficiaries.delete')
                                            <a data-href="{{action('ExpenseBeneficiaryController@destroy', $item->id)}}"
                                                data-check_password="{{action('UserController@checkPassword', Auth::user()->id)}}"
                                                class="delete_item close" class=" close">x</a>
                                            @endcan
                                        </div>

                                    </div>
                                    @endforeach
                                </td>
                                <td>{{@num_format($expense_category->expenses->sum('final_total'))}}</td>
                                <td>
                                    @can('expense.expense_categories.create_and_edit')
                                    <a data-href="{{action('ExpenseCategoryController@edit', $expense_category->id)}}"
                                        data-container=".view_modal"
                                        class="btn btn-danger btn-modal text-white edit_job"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    @endcan
                                    @can('expense.expense_categories.delete')
                                    <a data-href="{{action('ExpenseCategoryController@destroy', $expense_category->id)}}"
                                        data-check_password="{{action('UserController@checkPassword', Auth::user()->id)}}"
                                        class="btn btn-danger text-white delete_item"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right"><strong>@lang('lang.total')</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
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