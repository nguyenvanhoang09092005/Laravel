@extends('customer.dashboard')

@section('customer_content')
    <section id="hero">
        <div id="banner" class="d-flex align-items-center">
            <div class="container " data-aos="zoom-out" data-aos-delay="100">
                <h1>Chào mừng đến với <span>Da Cuoi</span></h1>
                <div class="d-flex">
                    <p style="font-size: 1.5rem;">
                        Coffee Đá Cuội nơi bạn thưởng thức ly cà phê đậm
                        đà.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ======= About Section ======= -->
    <div id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Giới Thiệu</h2>
                <h3>Tìm Hiểu Thêm <span>Về Chúng Tôi</span></h3>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{ asset('images/tải xuống (1).jpg') }}" class="img-fluid" style="overflow: hidden"
                        width="100%" height="auto" alt="Quán cà phê">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="100">
                    <h3>Chất lượng cà phê tuyệt vời, không gian thư giãn, dịch vụ tận tâm.</h3>
                    <p class="fst-italic">
                        Chúng tôi cung cấp những ly cà phê ngon nhất, được pha chế từ những hạt cà phê nguyên chất, mang đến
                        cho bạn một trải nghiệm thú vị và thư giãn.
                    </p>
                    <ul>
                        <li>
                            <i class="bx bx-store-alt"></i>
                            <div>
                                <h5>Không gian ấm cúng, thoải mái</h5>
                                <p>Chúng tôi tạo ra không gian lý tưởng để bạn thư giãn và tận hưởng cà phê cùng bạn bè hoặc
                                    đồng nghiệp.</p>
                            </div>
                        </li>
                        <li>
                            <i class="bx bx-images"></i>
                            <div>
                                <h5>Menu đa dạng, phục vụ tận tình</h5>
                                <p>Chúng tôi cung cấp một thực đơn phong phú, từ cà phê đến các món ăn nhẹ, phục vụ nhanh
                                    chóng và chu đáo.</p>
                            </div>
                        </li>
                    </ul>
                    <p>
                        Với cam kết chất lượng và sự hài lòng của khách hàng, chúng tôi luôn nỗ lực mang đến những sản phẩm
                        và dịch vụ tốt nhất. Hãy đến và thưởng thức những ly cà phê tuyệt vời cùng chúng tôi!
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
