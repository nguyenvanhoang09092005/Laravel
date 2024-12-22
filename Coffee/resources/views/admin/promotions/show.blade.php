@extends('admin.layouts.layout')

@section('admin_page_title')
    Promotion Details - Admin
@endsection

@section('admin_layout')
    <style>
        <style>.promotion-single__details-tab {
            margin: 0 auto 2.375rem;
            margin-top: 5px;
            max-width: 58.125rem;
        }

        .promotion-single__details-tab>.nav-tabs {
            justify-content: center;
            text-transform: uppercase;
        }

        @media (max-width: 575.98px) {
            .promotion-single__details-tab>.nav-tabs {
                flex-direction: column;
            }

            .promotion-single__details-tab>.nav-tabs .nav-link {
                width: max-content;
            }
        }

        .promotion-single__details-tab>.tab-content {
            padding: 3.125rem 0;
        }

        .promotion-single__addtional-info {
            display: flex;
            flex-direction: column;
            gap: 11px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 500px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .promotion-single__addtional-info .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .promotion-single__addtional-info .item:last-child {
            border-bottom: none;
        }

        .promotion-single__addtional-info .h6 {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .promotion-single__addtional-info span {
            font-size: 14px;
            color: #555;
        }

        .promotion-single__addtional-info span sup {
            font-size: 12px;
            color: #777;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .nav-tabs .nav-link {
            color: white;
            background-color: transparent;
            border: none;
            font-weight: bold;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.0);
            color: #f8f9fa;
            border-radius: 5px;
        }

        .nav-tabs .nav-link.active {
            color: rgb(41, 160, 220);
            text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
            box-shadow: 0px 4px 8px rgba(41, 160, 220, 0.5);
            border-radius: 5px;
            background: rgba(41, 160, 220, 0.1);
            padding: 8px 12px;
            transition: all 0.3s ease-in-out;
        }

        .nav-tabs {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="wg-box">
                <div class="promotion-details mt-5">
                    <div class="row">
                        <div class="col-md-4 mt-5">
                            <div class="promotion-image mb-3 text-center">
                                @if ($promotion->promotion_img)
                                    <img src="{{ Storage::url($promotion->promotion_img) }}" alt="Promotion Image"
                                        class="img-fluid rounded" style="height: 500px; width: auto;">
                                @else
                                    <span class="text-muted">No Image Available</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="promotion-single__details-tab">

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-additional-info" role="tabpanel"
                                        aria-labelledby="tab-additional-info-tab">
                                        <div class="promotion-single__addtional-info">
                                            <div class="item">
                                                <label class="h6">Promotion Code</label>
                                                <span>{{ $promotion->code ?? 'N/A' }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Discount Type</label>
                                                <span>{{ ucfirst($promotion->type) }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Discount Value</label>
                                                <span>{{ $promotion->discount }}
                                                    {{ $promotion->type == 'percentage' ? '%' : '$' }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">SKU</label>
                                                <span>{{ $promotion->sku ?? 'N/A' }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Category</label>
                                                <span>{{ $promotion->category->name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Status</label>
                                                <span>{{ $promotion->status }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Expiry Date</label>
                                                <span>{{ $promotion->expiry_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('promotions.manage') }}"
                                class="btn btn-secondary tf-button style-1 w308 text-end"><i class="bi bi-arrow-left"></i>
                                Back to Promotions List</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
