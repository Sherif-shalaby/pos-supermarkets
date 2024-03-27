@forelse ($products as $product)
    @php
        $i = $index;
    @endphp
    @if ($product->product_stores->first()->qty_available > 0)
        <tr class="product_row">
            <td><img src="@if (!empty($product->getFirstMediaUrl('product'))) {{ $product->getFirstMediaUrl('product') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                    alt="photo" width="50" height="50"></td>
            <td>
                @if ($product->variation_name != 'Default')
                    <b>{{ $product->variation_name }} {{ $product->sub_sku }}</b>
                @else
                    {{ $product->product_name }}
                @endif
            </td>
            <td>
                <span
                    id="product_stock_{{ $product->id }}">{{ $product->product_stores->first()->qty_available }}</span>
            </td>
            <td>
                <input type="hidden" id="product_id" name="product_id[]" value="{{ $product->id }}">
                <input type="text" class="form-control quantity product_{{ $product->id }}"
                    id="input_product_{{ $product->id }}" name="product_quentity[{{ $product->id }}][quantity]"
                    required
                    value="@if (isset($product->quantity)) {{ preg_match('/\.\d*[1-9]+/', (string) $product->quantity) ? $product->quantity : @num_format($product->quantity) }}@else{{ 1 }} @endif"
                    index_id="{{ $i }}">
            </td>
            <td>
                {{ $product->units->pluck('name')[0] ?? '' }}
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm remove_product_row"
                    data-index="{{ $i }}"><i class="fa fa-times"></i></button>
            </td>
        </tr>
    @else
    @endif



@empty

@endforelse
<script>
    $('.datepicker').datepicker({
        language: "{{ session('language') }}",
        todayHighlight: true,
    })
</script>
