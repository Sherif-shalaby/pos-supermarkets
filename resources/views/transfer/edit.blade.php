@extends('layouts.app')
@section('title', __('lang.edit_transfer'))

@section('content')
<section class="forms py-2">
    <div class="container-fluid px-2">
        <x-page-title>

            <h4>@lang('lang.edit_transfer')</h4>
        </x-page-title>
        {!! Form::open(['url' => action('TransferController@update', $transfer->id), 'method' => 'put', 'id'
        =>
        'edit_transfer_form', 'enctype' => 'multipart/form-data' ]) !!}

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sender_store_id', __('lang.sender_store'), [ 'class' =>"locale_label mb-1
                            field_required"]) !!}
                            {!! Form::select('sender_store_id', $stores,
                            $transfer->sender_store_id, ['class' => 'selectpicker form-control',
                            'data-live-search'=>"true",
                            'required',
                            'style' =>'width: 80%' , 'placeholder' => __('lang.please_select')]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('receiver_store_id', __('lang.receiver_store'), [ 'class' =>"locale_label
                            mb-1 field_required"]) !!}
                            {!! Form::select('receiver_store_id', $stores,
                            $transfer->receiver_store_id, ['class' => 'selectpicker form-control',
                            'data-live-search'=>"true",
                            'required',
                            'style' =>'width: 80%' , 'placeholder' => __('lang.please_select')]) !!}
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-12">
                        <div class="search-box input-group">
                            <button type="button" class="btn btn-secondary btn-lg" id="search_button"><i
                                    class="fa fa-search"></i></button>
                            <input type="text" name="search_product" id="search_product"
                                placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                class="form-control ui-autocomplete-input" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-10 offset-md-1">
                        <table class="table table-bordered table-striped table-condensed" id="product_table">
                            <thead>
                                <tr>
                                    <th style="width: 25%" class="col-sm-8">@lang( 'lang.products' )</th>
                                    <th style="width: 25%" class="col-sm-4">@lang( 'lang.sku' )</th>
                                    <th style="width: 25%" class="col-sm-4">@lang( 'lang.quantity' )</th>
                                    <th style="width: 12%" class="col-sm-4">@lang( 'lang.purchase_price' )</th>
                                    <th style="width: 12%" class="col-sm-4">@lang( 'lang.sub_total' )</th>
                                    <th style="width: 12%" class="col-sm-4">@lang( 'lang.action' )</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfer->transfer_lines as $product)
                                <tr>
                                    <td>
                                        {{$product->product->name}}

                                        @if($product->variation->name != "Default")
                                        <b>{{$product->variation->name}}</b>
                                        @endif
                                        <input type="hidden" name="transfer_lines[{{$loop->index}}][transfer_line_id]"
                                            value="{{$product->id}}">
                                        <input type="hidden" name="transfer_lines[{{$loop->index}}][product_id]"
                                            value="{{$product->product_id}}">
                                        <input type="hidden" name="transfer_lines[{{$loop->index}}][variation_id]"
                                            value="{{$product->variation_id}}">
                                    </td>
                                    <td>
                                        {{$product->variation->sub_sku}}
                                    </td>
                                    @php
                                    $qty_available = App\Models\ProductStore::where('variation_id',
                                    $product->variation_id)->where('store_id',
                                    $transfer->sender_store_id)->first();
                                    @endphp
                                    <td>
                                        <input type="text" class="form-control quantity" min=1
                                            max="{{$qty_available ? $qty_available->qty_available : preg_match('/\.\d*[1-9]+/', (string)$product->quantity) ? $product->quantity : @num_format($product->quantity)}}"
                                            name="transfer_lines[{{$loop->index}}][quantity]" required
                                            value="@if(isset($product->quantity)){{preg_match('/\.\d*[1-9]+/', (string)$product->quantity) ? $product->quantity : @num_format($product->quantity)}}@else{{1}}@endif">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control purchase_price"
                                            name="transfer_lines[{{$loop->index}}][purchase_price]" required
                                            value="@if(isset($product->purchase_price)){{@num_format($product->purchase_price)}}@else{{0}}@endif">
                                    </td>
                                    <td>
                                        <span class="sub_total_span">{{preg_match('/\.\d*[1-9]+/',
                                            (string)$product->sub_total) ? $product->sub_total :
                                            preg_match('/\.\d*[1-9]+/', (string)$product->sub_total) ?
                                            $product->sub_total : @num_format($product->sub_total)}}</span>
                                        <input type="hidden" class="form-control sub_total"
                                            name="transfer_lines[{{$loop->index}}][sub_total]"
                                            value="{{preg_match('/\.\d*[1-9]+/', (string)$product->sub_total) ? $product->sub_total : preg_match('/\.\d*[1-9]+/', (string)$product->sub_total) ? $product->sub_total : @num_format($product->sub_total)}}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sx remove_row"><i
                                                class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="col-md-12">
                    <div class="col-md-12 text-center">
                        <h3> @lang('lang.total'): <span
                                class="final_total_span">{{@num_format($transfer->final_total)}}</span>
                        </h3>
                        <input type="hidden" name="final_total" id="final_total" value="{{$transfer->final_total}}">
                    </div>
                </div>
            </div>
        </div>



        <div class="card mt-1 mb-0">
            <div class="card-body py-2 px-4">
                <div class="row locale_dir">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('files', __('lang.files'), ['class' =>"locale_label mb-1 "]) !!}
                            {!! Form::file('files[]', null, ['class' => '']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('notes', __('lang.notes'), ['class' =>"locale_label mb-1 field_required"])
                            !!}
                            {!! Form::textarea('notes', $transfer->notes, ['class' => 'form-control', 'rows' =>
                            3]) !!}
                        </div>
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


</section>
@endsection

@section('javascript')
<script src="{{asset('js/transfer.js')}}"></script>
<script type="text/javascript">

</script>
@endsection