@extends('customer.dashboard')

@section('customer_content')
    <!-- ======= Liên Hệ Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2 style="margin-bottom: 4em">Liên Hệ</h2>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Địa Chỉ Của Chúng Tôi</h3>
                        <p>144 Lê Tấn Trung, Thọ Quang, Sơn Trà, Đà Nẵng.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Gửi Email Cho Chúng Tôi</h3>
                        <p>nguyenvanhoang09092005@gmail.com</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Gọi Cho Chúng Tôi</h3>
                        <p>+84 356 151 897</p>
                    </div>
                </div>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3748.5699829770824!2d108.24425937496883!3d16.095330538738928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314217f07c3922ad%3A0xac1534d054d6a1b4!2zMTQ0IEzDqiBU4bqlbiBUcnVuZywgVGjhu40gUXVhbmcsIFPGoW4gVHLDoCwgxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e1!3m2!1svi!2s!4v1732884626044!5m2!1svi!2s"
                        frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Tên Của Bạn" required>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email Của Bạn" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Chủ Đề"
                                required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Tin Nhắn" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Đang tải</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Tin nhắn của bạn đã được gửi. Cảm ơn bạn!</div>
                        </div>
                        <div class="text-center"><button type="submit">Gửi Tin Nhắn</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Liên Hệ Section -->
@endsection
