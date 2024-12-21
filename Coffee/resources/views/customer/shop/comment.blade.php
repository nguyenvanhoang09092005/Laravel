@extends('customer.dashboard')

@section('customer_content')
    <style>
        /* Định dạng tổng thể */
        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .order-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-item-details {
            flex: 1;
        }

        .product-name {
            font-weight: bold;
            font-size: 16px;
        }

        .product-quantity {
            color: #666;
        }

        .product-reviews {
            margin-top: 20px;
        }

        .rating:not(:checked)>input {
            position: absolute;
            appearance: none;
        }

        .rating:not(:checked)>label {
            float: right;
            cursor: pointer;
            font-size: 30px;
            color: #666;
        }

        .rating:not(:checked)>label:before {
            content: "★";
        }

        .rating>input:checked+label:hover,
        .rating>input:checked+label:hover~label,
        .rating>input:checked~label:hover,
        .rating>input:checked~label:hover~label,
        .rating>label:hover~input:checked~label {
            color: #e58e09;
        }

        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #ff9e0b;
        }

        .rating>input:checked~label {
            color: #ffa723;
        }



        .review-text {
            margin-top: 10px;
        }

        .review-text textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            resize: vertical;
        }

        .submit-review-button {
            background-color: #003df5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 15px;
        }

        .submit-review-button:hover {
            background-color: #0258f7;
        }
    </style>

    <section class="product-single container" style="margin-top: 85px;">
        <div class="section-title" data-aos="fade-up">
            <h2>Đánh giá sản phẩm</h2>
        </div>

        <div class="order-items-list">
            @foreach ($order->items as $item)
                <div class="order-item">
                    <!-- Hiển thị ảnh sản phẩm -->
                    <img loading="lazy" src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->product->product_name }}" />

                    <div class="order-item-details">
                        <!-- Hiển thị tên sản phẩm -->
                        <div class="product-name">{{ $item->product->product_name }}</div>

                        <!-- Hiển thị số lượng sản phẩm -->
                        <div class="product-quantity">Số lượng: {{ $item->quantity }}</div>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form đánh giá sản phẩm -->
                <div class="product-reviews">
                    <form action="{{ route('Customer.product.review', $item->product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="Rất tốt"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="Tốt"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="Bình thường"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="Kém"></label>
                            <input type="radio" id="star1" name="rating" value="1" checked />
                            <label for="star1" title="Rất kém"></label>
                        </div>
                        <div class="review-text">
                            <textarea name="review" rows="4" placeholder="Viết đánh giá..." required></textarea>
                        </div>
                        <button type="submit" class="submit-review-button">Gửi đánh giá</button>
                    </form>

                </div>
            @endforeach
        </div>
    </section>
@endsection
