@extends('layouts.app')
@section('title', __('lang.product_classification_tree'))
@section('style')
    <style>
        .accordion {
            margin-bottom: 0.5rem !important;
        }

        .accordion-inner {
            margin-top: 0.5rem;
        }

        .accordion-toggle {
            background-color: var(--primary-color);
            color: #222 !important;
            border: 1px solid var(--secondary-color);
            width: 100%;
            padding: 5px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.4s;
        }

        .accordion-inner .accordion-toggle {

            color: #fff !important;
            background-color: var(--secondary-color);
            transition: 0.4s;
        }

        .accordion-toggle:hover {
            text-decoration: none;
            color: #fff !important;
            background-color: var(--secondary-color);
        }

        .accordion-toggle:focus {
            text-decoration: none;
            color: #fff !important;
            background-color: var(--secondary-color);
        }

        .accordion-inner .accordion-toggle:hover {
            text-decoration: none;
            background-color: var(--primary-color);
            color: #222 !important;
            border: 1px solid var(--secondary-color);
        }

        .accordion-inner .accordion-toggle:focus {
            text-decoration: none;
            color: #fff !important;
            border: 1px solid var(--secondary-color);
            background-color: var(--secondary-color)
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">

@endsection
@section('content')

    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.product_classification_tree')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="col-md-12">

                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="row">

                                    <div class="col-md-12">
                                        <h4>{{ number_format(App\Models\Product::leftjoin('variations', 'products.id', 'variations.product_id')->count()) }}
                                            @lang('lang.items')</h4>
                                        <h4>{{ number_format(App\Models\ProductClass::count()) }} @lang('lang.product_class')</h4>
                                        <h4>{{ number_format(App\Models\Category::whereNull('parent_id')->count()) }}
                                            @lang('lang.category')
                                        </h4>
                                        <h4>{{ number_format(App\Models\Category::whereNotNull('parent_id')->count()) }}
                                            @lang('lang.sub_category')</h4>
                                        <h4>{{ number_format(App\Models\Brand::count()) }} @lang('lang.brand')</h4>
                                        <h4>{{ number_format(App\Models\Unit::count()) }} @lang('lang.unit')</h4>
                                        <h4>{{ number_format(App\Models\Color::count()) }} @lang('lang.color')</h4>
                                        <h4>{{ number_format(App\Models\Size::count()) }} @lang('lang.size')</h4>
                                        <h4>{{ number_format(App\Models\Grade::count()) }} @lang('lang.grade')</h4>
                                        <h4>{{ number_format(DB::table('media')->where('collection_name', 'product')->count()) }}
                                            @lang('lang.image')</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 no-print">

                        <div class="card mb-2">
                            <div class="card-body">
                                @foreach ($product_classes as $class)
                                    <div class="accordion" id="{{ @replace_space($class->name) }}">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle" data-toggle="collapse"
                                                    data-id="{{ @replace_space($class->name) }}"
                                                    data-parent="#{{ @replace_space($class->name) }}"
                                                    href="#collapse{{ @replace_space($class->name) }}">
                                                    <i
                                                        class="fa fa-angle-right angle-class-{{ @replace_space($class->name) }}"></i>
                                                    {{ $class->name }}
                                                    <div class="btn-group gap-5 pull-right">
                                                        <button data-container=".view_modal"
                                                            data-href="{{ action('ProductClassController@edit', $class->id) }}"
                                                            class="pull-right btn btn-modal btn-primary btn-xs"><i
                                                                class="dripicons-document-edit"></i> </button>
                                                        <button
                                                            data-href="{{ action('ProductClassController@destroy', $class->id) }}?source=pct"
                                                            data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                            class="pull-right btn delete_item btn-danger btn-xs"><i
                                                                class="dripicons-trash"></i></button>

                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapse{{ @replace_space($class->name) }}"
                                                class="accordion-body collapse">
                                                @if (session('system_mode') != 'restaurant')
                                                    <div class="accordion-inner">
                                                        @php
                                                            $i = 0;
                                                            $categories = App\Models\Category::where(
                                                                'product_class_id',
                                                                $class->id,
                                                            )
                                                                ->whereNotNull('categories.name')
                                                                ->select('categories.id', 'categories.name')
                                                                ->groupBy('categories.id')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($categories as $category)
                                                            <div class="accordion"
                                                                id="{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}"
                                                                style="margin-left: 20px;">
                                                                <div class="accordion-group">
                                                                    <div class="accordion-heading">
                                                                        <a class="accordion-toggle" data-toggle="collapse"
                                                                            data-id="{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}"
                                                                            data-parent="#{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}"
                                                                            href="#collapse{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}">
                                                                            <i
                                                                                class="fa fa-angle-right angle-class-{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}"></i>
                                                                            {{ $category->name }}
                                                                            <div class="btn-group gap-5 pull-right">
                                                                                <button data-container=".view_modal"
                                                                                    data-href="{{ action('CategoryController@edit', $category->id) }}"
                                                                                    class="pull-right btn btn-modal btn-primary btn-xs"><i
                                                                                        class="dripicons-document-edit"></i>
                                                                                </button>
                                                                                <button
                                                                                    data-href="{{ action('CategoryController@destroy', $category->id) }}?source=pct"
                                                                                    data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                                    class="pull-right btn delete_item btn-danger btn-xs"><i
                                                                                        class="dripicons-trash"></i></button>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse{{ @replace_space($class->id . 'category_' . $category->name . '_' . $i) }}"
                                                                        class="accordion-body collapse in">
                                                                        <div class="accordion-inner">
                                                                            @php
                                                                                $sub_categories = App\Models\Category::where(
                                                                                    'parent_id',
                                                                                    $category->id,
                                                                                )
                                                                                    ->whereNotNull('categories.name')
                                                                                    ->select(
                                                                                        'categories.id',
                                                                                        'categories.name',
                                                                                    )
                                                                                    ->groupBy('categories.id')
                                                                                    ->get();
                                                                                $brands = null;
                                                                                $brands = App\Models\Product::leftjoin(
                                                                                    'brands',
                                                                                    'products.brand_id',
                                                                                    'brands.id',
                                                                                )
                                                                                    ->where(
                                                                                        'products.category_id',
                                                                                        $category->id,
                                                                                    )
                                                                                    ->whereNull(
                                                                                        'products.sub_category_id',
                                                                                    )
                                                                                    ->whereNotNull('brands.id')
                                                                                    ->whereNotNull('brands.name')
                                                                                    ->select('brands.id', 'brands.name')
                                                                                    ->groupBy('brands.id')
                                                                                    ->get();
                                                                            @endphp
                                                                            @if ($brands->count() == 0 && $sub_categories->count() == 0)
                                                                                @php
                                                                                    $products = App\Models\Product::leftjoin(
                                                                                        'variations',
                                                                                        'products.id',
                                                                                        'variations.product_id',
                                                                                    )
                                                                                        ->where(
                                                                                            'category_id',
                                                                                            $category->id,
                                                                                        )
                                                                                        ->whereNotNull('products.name')
                                                                                        ->select(
                                                                                            'products.id',
                                                                                            'products.name',
                                                                                            'variations.name as variation_name',
                                                                                            'variations.sub_sku as sku',
                                                                                            'variations.default_sell_price as sell_price',
                                                                                        )
                                                                                        ->groupBy('variations.id')
                                                                                        ->get();
                                                                                @endphp
                                                                                @foreach ($products as $product)
                                                                                    @include(
                                                                                        'product_classification_tree.partials.product_inner_part',
                                                                                        [
                                                                                            'product' => $product,
                                                                                        ]
                                                                                    )
                                                                                @endforeach
                                                                            @endif

                                                                            @if (!empty($brands) && $brands->count() > 0)
                                                                                @include(
                                                                                    'product_classification_tree.partials.brand_inner_part',
                                                                                    [
                                                                                        'brands' => $brands,
                                                                                        'product_class_id' =>
                                                                                            $class->id,
                                                                                        'category_id' =>
                                                                                            $category->id,
                                                                                    ]
                                                                                )
                                                                            @endif
                                                                            @foreach ($sub_categories as $sub_category)
                                                                                <div class="accordion"
                                                                                    id="{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}"
                                                                                    style="margin-left: 20px;">
                                                                                    <div class="accordion-group">
                                                                                        <div class="accordion-heading">
                                                                                            <a class="accordion-toggle"
                                                                                                data-toggle="collapse"
                                                                                                data-id="{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}"
                                                                                                data-parent="#{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}"
                                                                                                href="#collapse{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}">
                                                                                                <i
                                                                                                    class="fa fa-angle-right angle-class-{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}"></i>
                                                                                                {{ $sub_category->name }}
                                                                                                <div
                                                                                                    class="btn-group gap-5 pull-right">
                                                                                                    <button
                                                                                                        data-container=".view_modal"
                                                                                                        data-href="{{ action('CategoryController@edit', $sub_category->id) }}"
                                                                                                        class="btn btn-modal btn-primary btn-xs"><i
                                                                                                            class="dripicons-document-edit"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        data-href="{{ action('CategoryController@destroy', $sub_category->id) }}?source=pct"
                                                                                                        data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                                                        class="btn delete_item btn-danger btn-xs"><i
                                                                                                            class="dripicons-trash"></i></button>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div id="collapse{{ @replace_space('sub_category_' . $sub_category->name . '_' . $i) }}"
                                                                                            class="accordion-body collapse in">
                                                                                            <div class="accordion-inner">
                                                                                                @php
                                                                                                    $brands = null;
                                                                                                    $brands = App\Models\Product::leftjoin(
                                                                                                        'brands',
                                                                                                        'products.brand_id',
                                                                                                        'brands.id',
                                                                                                    )
                                                                                                        ->where(
                                                                                                            'products.sub_category_id',
                                                                                                            $sub_category->id,
                                                                                                        )
                                                                                                        ->whereNotNull(
                                                                                                            'brands.id',
                                                                                                        )
                                                                                                        ->whereNotNull(
                                                                                                            'brands.name',
                                                                                                        )
                                                                                                        ->select(
                                                                                                            'brands.id',
                                                                                                            'brands.name',
                                                                                                        )
                                                                                                        ->groupBy(
                                                                                                            'brands.id',
                                                                                                        )
                                                                                                        ->get();
                                                                                                @endphp
                                                                                                @if (!empty($brands) && $brands->count() > 0)
                                                                                                    @include(
                                                                                                        'product_classification_tree.partials.brand_inner_part',
                                                                                                        [
                                                                                                            'brands' => $brands,
                                                                                                            'product_class_id' =>
                                                                                                                $class->id,
                                                                                                            'category_id' =>
                                                                                                                $category->id,
                                                                                                            'sub_category_id' =>
                                                                                                                $sub_category->id,
                                                                                                        ]
                                                                                                    )
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                @php
                                                                                    $i++;
                                                                                @endphp
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach

                                                    </div>
                                                @else
                                                    <div class="accordion-inner">
                                                        @php
                                                            $query = App\Models\Product::where(
                                                                'product_class_id',
                                                                $class->id,
                                                            );

                                                            $products = $query
                                                                ->select(
                                                                    'products.id',
                                                                    'products.name',
                                                                    'products.sku',
                                                                    'products.sell_price',
                                                                )
                                                                ->groupBy('products.id')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($products as $product)
                                                            <div class="row product_row">
                                                                <div class="col-md-3">
                                                                    <img src="@if (!empty($product->getFirstMediaUrl('product'))) {{ $product->getFirstMediaUrl('product') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                                                                        alt="photo" width="50" height="50">
                                                                    {{ $product->name }}
                                                                </div>
                                                                @php
                                                                    $expiry_date = App\Models\AddStockLine::where(
                                                                        'product_id',
                                                                        $product->id,
                                                                    )
                                                                        ->whereDate('expiry_date', '>=', date('Y-m-d'))
                                                                        ->select('expiry_date')
                                                                        ->orderBy('expiry_date', 'asc')
                                                                        ->first();
                                                                    $current_stock = App\Models\ProductStore::where(
                                                                        'product_id',
                                                                        $product->id,
                                                                    )
                                                                        ->select(
                                                                            DB::raw('SUM(product_stores.qty_available)
                                        as current_stock'),
                                                                        )
                                                                        ->first();
                                                                @endphp
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    style="color: #222;">@lang('lang.sku'):
                                                                                    {{ $product->sku }}</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    style="color: #222;">@lang('lang.expiry'):
                                                                                    @if (!empty($expiry_date))
                                                                                        {{ @format_date($expiry_date->expiry_date) }}@else{{ 'N/A' }}
                                                                                    @endif
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    style="color: #222;">@lang('lang.stock'):
                                                                                    @if (!empty($current_stock))
                                                                                        {{ preg_match('/\.\d*[1-9]+/', (string) $current_stock->current_stock) ? $current_stock->current_stock : @num_format($current_stock->current_stock) }}
                                                                                    @endif
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    style="color: #222;">@lang('lang.price'):
                                                                                    {{ @num_format($product->sell_price) }}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="btn-group gap-5 pull-right">
                                                                        <button
                                                                            data-href="{{ action('ProductController@edit', $product->id) }}"
                                                                            class="btn btn-primary btn-xs product_edit"><i
                                                                                class="dripicons-document-edit"></i>
                                                                        </button>
                                                                        <button
                                                                            data-href="{{ action('ProductController@destroy', $product->id) }}"
                                                                            data-check_password="{{ action('UserController@checkPassword', Auth::user()->id) }}"
                                                                            class="btn delete_item btn-danger btn-xs"><i
                                                                                class="dripicons-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('javascript')
    <script>
        $(document).on('click', '.accordion-toggle', function() {
            let id = $(this).data('id');
            console.log($('.angle-class-' + id).hasClass('fa-angle-right'));
            if ($('.angle-class-' + id).hasClass('fa-angle-right')) {
                $('.angle-class-' + id).removeClass('fa-angle-right');
                $('.angle-class-' + id).addClass('fa-angle-down');
            } else if ($('.angle-class-' + id).hasClass('fa-angle-down')) {
                $('.angle-class-' + id).removeClass('fa-angle-down');
                $('.angle-class-' + id).addClass('fa-angle-right');
            }
        });

        $(document).on('click', '.product_edit', function() {
            let href = $(this).data('href');

            if (href) {
                window.location = href;
            }
        })
    </script>

@endsection
