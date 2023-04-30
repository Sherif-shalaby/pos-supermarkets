@php 
$index=$batch_count;
@endphp
@forelse ($products as $product)

<tr class="row_batch_details row_batch_details_{{$row_count}}" id="batch_number_row" style="background-color:rgb(246, 248, 248);">
    <td> {!! Form::label('', __('lang.new_batch'), []) !!} <br> {!!
        Form::text('batch_row['.$index.'][new_batch_number]', null, ['class' => 'form-control batchNumber','required']) !!}
    </td>
    <td colspan="1"><img src="@if(!empty($product->getFirstMediaUrl('product'))){{$product->getFirstMediaUrl('product')}}@else{{asset('/uploads/'.session('logo'))}}@endif"
        alt="photo" width="50" height="50"></td>
    <td>
        @if($product->variation_name != "Default")
        <b>{{$product->variation_name}} {{$product->sub_sku}}</b>
        @else
        {{$product->product_name}}
        @endif
        <input type="hidden" name="batch_row[{{$index}}][product_id]" value="{{$product->product_id}}"/>
        <input type="hidden" name="batch_row[{{$index}}][variation_id]" value="{{$product->variation_id}}"/>
    </td>
    <td colspan="1">
        {!! Form::label('', __('lang.manufacturing_date'), []) !!}<br>
        {!! Form::text('batch_row['.$index.'][batch_manufacturing_date]', null, ['class' => 'form-control datepicker',
        'readonly']) !!}
    </td>
    <td colspan="1"> 
        {!! Form::label('', __('lang.expiry_date'), []) !!}<br>
        {!! Form::text('batch_row['.$index.'][batch_expiry_date]', null, ['class' => 'form-control datepicker expiry_date',
        'readonly']) !!}
    </td>
    <td colspan="1">
        {!! Form::label('', __('lang.quantity'), []) !!}<br>
        
        <input type="text" class="form-control quantity quantity" min=1 name="batch_row[{{$index}}][batch_quantity]" required
            value="1"  index_id="">
         {{-- {!! Form::label('', __('lang.days_before_the_expiry_date'), []) !!}<br>
        {!! Form::text('batch_row['.$i.'][expiry_warning]', null, ['class' => 'form-control days_before_the_expiry_date']) !!} --}}
    </td>
    <td colspan="1">
        <span class="text-secondary font-weight-bold">*</span>
        <input type="text" class="form-control purchase_price purchase_price" name="batch_row[{{$index}}][batch_purchase_price]" required
            value="@if($product->purchase_price_depends == null) {{@num_format($product->default_purchase_price / $exchange_rate)}} @else {{@num_format($product->purchase_price_depends / $exchange_rate)}} @endif" index_id="">
            <input class="final_cost" type="hidden" name="batch_row[{{$index}}][batch_final_cost]" value="@if(isset($product->default_purchase_price)){{@num_format($product->default_purchase_price / $exchange_rate)}}@else{{0}}@endif"  >
    </td>
    <td colspan="1">
        <span class="text-secondary font-weight-bold">*</span>
        <input type="text" class="form-control selling_price selling_price" name="batch_row[{{$index}}][batch_selling_price]" required index_id=""
               value="@if($product->selling_price_depends == null) {{@num_format($product->sell_price)}} @else {{@num_format($product->selling_price_depends)}} @endif"  >
    </td>
    <td colspan="1">
        <button style="margin-top: 33px;" type="button" class="btn btn-secodary text-danger btn-sx remove_batch_row" ><i
            class="fa fa-times"></i></button>
    </td>
    <td colspan="2"></td>
</tr>
@empty

@endforelse

<script>
    $('.datepicker').datepicker({
        language: "{{session('language')}}",
        todayHighlight: true,
    })
</script>