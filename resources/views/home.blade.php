@extends('layouts.app')

@section('content')
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <div class="swiper-slide"
                style="background-image:url('{{ asset('images/banner1.jpg') }}'); background-size:cover; background-position:center; height:80vh;">
                <div class="slide-content d-flex flex-column align-items-center justify-content-center h-100 text-white text-center"
                    style="background:rgba(0,0,0,0.4);">
                    <h1 class="display-5 fw-bold">Chăm sóc nụ cười của bạn</h1>
                    <p class="lead">Đặt lịch khám nha khoa nhanh chóng & tiện lợi</p>
                    <a href="{{ route('appointments.create') }}" class="btn btn-lg btn-light mt-3">Đặt lịch ngay</a>
                </div>
            </div>

            <div class="swiper-slide"
                style="background-image:url('{{ asset('images/banner2.jpg') }}'); background-size:cover; background-position:center; height:80vh;">
                <div class="slide-content d-flex flex-column align-items-center justify-content-center h-100 text-white text-center"
                    style="background:rgba(0,0,0,0.4);">
                    <h1 class="display-5 fw-bold">Dịch vụ nha khoa hiện đại</h1>
                    <p class="lead">Đội ngũ bác sĩ giàu kinh nghiệm</p>
                    <a href="#" class="btn btn-lg btn-light mt-3">Xem thêm</a>
                </div>
            </div>

        </div>

        <!-- Pagination & Nav -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
@endsection
