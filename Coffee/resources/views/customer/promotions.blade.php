@extends('customer.dashboard')

@section('customer_content')
    <section id="promotions" class="promotions">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Khuyến mãi</h2>
                <h3>Kiểm tra chương trình <span>Khuyến mãi</span></h3>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="promotions-flters">
                        <li data-filter="*" class="filter-active">Tất cả</li>
                        <li data-filter=".filter-in-stock">Đang còn</li>
                        <li data-filter=".filter-out-stock">Đã hết</li>
                    </ul>

                </div>
            </div>

            <div class="row promotions-container" data-aos="fade-up" data-aos-delay="200">
                <!-- In Stock Section -->
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($promotionsInStock as $promotion)
                            <div class="col-lg-4 col-md-6 promotions-item filter-in-stock">
                                <img src="{{ asset('storage/' . $promotion->promotion_img) }}" class="img-fluid"
                                    alt="Promotion Image">
                                <div class="promotions-info">
                                    <h4>{{ $promotion->code }}</h4>
                                    <p>Status: {{ $promotion->status }}</p>
                                    <a href="{{ asset('storage/' . $promotion->promotion_img) }}"
                                        data-gallery="promotionsGallery" class="promotions-lightbox preview-link"
                                        title="Promotion Image">
                                        <i class="bx bx-plus"></i>
                                    </a>
                                    <a href="{{ route('promotions.show', $promotion->id) }}" class="details-link"
                                        title="More Details">
                                        <i class="bx bx-link"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Out of Stock Section -->
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($promotionsOutStock as $promotion)
                            <div class="col-lg-4 col-md-6 promotions-item filter-out-stock">
                                <img src="{{ asset('storage/' . $promotion->promotion_img) }}" class="img-fluid"
                                    alt="Promotion Image">
                                <div class="promotions-info">
                                    <h4>{{ $promotion->code }}</h4>
                                    <p>Status: {{ $promotion->status }}</p>
                                    <a href="{{ asset('storage/' . $promotion->promotion_img) }}"
                                        data-gallery="promotionsGallery" class="promotions-lightbox preview-link"
                                        title="Promotion Image">
                                        <i class="bx bx-plus"></i>
                                    </a>
                                    <a href="{{ route('promotions.show', $promotion->id) }}" class="details-link"
                                        title="More Details">
                                        <i class="bx bx-link"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
