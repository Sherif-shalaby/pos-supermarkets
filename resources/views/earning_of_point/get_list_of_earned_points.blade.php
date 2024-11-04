@extends('layouts.app')
@section('title', __('lang.list_of_earn_point_by_transactions'))

@section('content')
<section class="forms py-2">

    <div class="container-fluid px-2 no-print">

        <x-page-title>

            <h4 class="print-title">@lang('lang.list_of_earn_point_by_transactions')</h4>

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
                                <th>@lang('lang.store')</th>
                                <th>@lang('lang.cashier')</th>
                                <th>@lang('lang.customer')</th>
                                <th>@lang('lang.invoice_no')</th>
                                <th>@lang('lang.product_grant_the_points')</th>
                                <th>@lang('lang.value')</th>
                                <th>@lang('lang.paid_amount')</th>
                                <th>@lang('lang.point_earned')</th>
                                <th>@lang('lang.balance')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{@format_datetime($transaction->transaction_date)}}
                                </td>
                                <td>{{$transaction->store->name ?? ''}}</td>
                                <td>{{ucfirst($transaction->created_by_user->name ?? '')}}</td>
                                <td>{{$transaction->customer->name ?? ''}}</td>
                                <td style="color: rgb(85, 85, 231)"><a
                                        data-href="{{action('SellController@show', $transaction->id)}}"
                                        data-container=".view_modal"
                                        class="btn btn-modal">{{$transaction->invoice_no}}</a></td>
                                <td>
                                    @php
                                    $sell_lines = App\Models\TransactionSellLine::where('transaction_id',
                                    $transaction->id)->where('point_earned', 1)->get();
                                    @endphp
                                    @foreach ($sell_lines as $line)
                                    {{$line->product->name}},
                                    @endforeach
                                </td>
                                <td>{{@num_format($transaction->final_total)}}</td>
                                <td>{{@num_format($transaction->transaction_payments->sum('amount'))}}</td>
                                <td>{{@num_format($transaction->rp_earned)}}</td>
                                <td>{{@num_format($transaction->customer->total_rp)}}</td>

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