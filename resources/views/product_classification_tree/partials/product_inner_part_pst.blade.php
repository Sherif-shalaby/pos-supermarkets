<div class="row product_row">
    <div class="col-md-1">
        <input id="product_selected{{ $product->id }}" name="pct[product_selected][]" type="checkbox"
            value="{{ $product->variation_id }}" @if (in_array($product->variation_id, $product_selected)) checked @endif
            class="my-new-checkbox product_checkbox">
    </div>
    <div class="col-md-5">
        <img src="@if (!empty($product->getFirstMediaUrl('product'))) {{ $product->getFirstMediaUrl('product') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
            alt="photo" width="50" height="50">
        <a href="">
            @if ($product->variation_name == 'Default')
                {{ $product->name }}
            @else
                {{ $product->variation_name }}
            @endif
        </a>
    </div>
    @php
        $expiry_date = App\Models\AddStockLine::where('variation_id', $product->variation_id)
           ->whereDate('expiry_date', '>=', date('Y-m-d'))
           ->select('expiry_date')
           ->orderBy('expiry_date', 'asc')
           ->first();
       $current_stock = App\Models\ProductStore::where('variation_id', $product->variation_id)
           ->select(DB::raw('SUM(product_stores.qty_available) as current_stock'))
           ->first();
       $stockLines=\App\Models\AddStockLine::where('variation_id',$product->variation_id)
       ->whereColumn('quantity',">",'quantity_sold')->first();

       $default_sell_price= $stockLines? $stockLines->sell_price : $product->sell_price;

    @endphp
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <label style="color: #222;">@lang('lang.sku'):
                        {{ $product->sku }}</label>
                </div>
                <div class="col-md-12">
                    <label style="color: #222;">@lang('lang.expiry'):
                        @if (!empty($expiry_date))
                            {{ @format_date($expiry_date->expiry_date) }}@else{{ 'N/A' }}
                        @endif
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <label style="color: #222;">@lang('lang.stock'):
                        @if (!empty($current_stock))
                            {{preg_match('/\.\d*[1-9]+/', (string)$current_stock->current_stock) ? $current_stock->current_stock : @num_format($current_stock->current_stock)  }}
                        @endif
                    </label>
                </div>
                <div class="col-md-12">
                    <label style="color: #222;">@lang('lang.price'):
                        {{ @num_format($default_sell_price) }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
