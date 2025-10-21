@extends('layouts.app')

@section('content')
<style>
    .about-container {
        padding: 0;
        margin: 0;
        
    }

    /* Hero Section */
    .hero-about {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(45, 212, 191, 0.95) 100%),
            url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=1200') center/cover;
        padding: 8rem 0 6rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-about::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
        animation: pulse 8s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.5;
        }

        50% {
            opacity: 1;
        }
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        animation: fadeInUp 0.8s ease;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .hero-content p {
        font-size: 1.3rem;
        opacity: 0.95;
        line-height: 1.8;
    }

    /* Stats Section */
    .stats-section {
        background: white;
        margin-top: -3rem;
        position: relative;
        z-index: 2;
    }

    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
    }

    .stats-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stats-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stats-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .stats-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(45, 212, 191, 0.2);
    }

    .stats-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .stats-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Story Section */
    .story-section {
        padding: 6rem 0;
        background: #f8fafc;
    }

    .story-content {
        display: flex;
        align-items: center;
        gap: 4rem;
        margin-bottom: 4rem;
    }

    .story-content.reverse {
        flex-direction: row-reverse;
    }

    .story-image {
        flex: 1;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        animation: fadeIn 1s ease;
    }

    .story-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .story-image:hover img {
        transform: scale(1.05);
    }

    .story-text {
        flex: 1;
        animation: fadeInUp 0.8s ease;
    }

    .story-text h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
    }

    .story-text p {
        font-size: 1.1rem;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    /* Values Section */
    .values-section {
        padding: 6rem 0;
        background: white;
    }

    .section-header {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 4rem;
    }

    .section-header h2 {
        font-size: 2.8rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 1rem;
    }

    .section-header p {
        font-size: 1.2rem;
        color: #64748b;
    }

    .value-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        padding: 2.5rem;
        transition: all 0.3s ease;
        height: 100%;
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
    }

    .value-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .value-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .value-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .value-card:hover {
        border-color: #2dd4bf;
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(45, 212, 191, 0.15);
    }

    .value-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .value-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
    }

    .value-card p {
        color: #64748b;
        line-height: 1.7;
        font-size: 1.05rem;
    }

    /* Team Section */
    .team-section {
        padding: 6rem 0;
        background: linear-gradient(180deg, #f8fafc 0%, white 100%);
    }

    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
    }

    .team-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .team-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .team-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .team-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(45, 212, 191, 0.2);
    }

    .team-image {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        position: relative;
        overflow: hidden;
    }

    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-card:hover .team-image img {
        transform: scale(1.1);
    }

    .team-info {
        padding: 1.5rem;
        text-align: center;
    }

    .team-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: #3b82f6;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .team-description {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .team-social {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        color: white;
        transform: translateY(-3px);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 5rem 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(45, 212, 191, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .cta-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }

    .cta-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-cta {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cta-primary {
        background: linear-gradient(135deg, #2dd4bf 0%, #3b82f6 100%);
        color: white;
        border: none;
    }

    .btn-cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(45, 212, 191, 0.4);
        color: white;
    }

    .btn-cta-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-cta-outline:hover {
        background: white;
        color: #1e293b;
        transform: translateY(-3px);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1.1rem;
        }

        .story-content,
        .story-content.reverse {
            flex-direction: column;
            gap: 2rem;
        }

        .stats-number {
            font-size: 2.5rem;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .cta-content h2 {
            font-size: 2rem;
        }

        .cta-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="about-container">
    <!-- Hero Section -->
    <section class="hero-about">
        <div class="container">
            <div class="hero-content">
                <h1>Về Chúng Tôi</h1>
                <p>
                    Với hơn 15 năm kinh nghiệm, chúng tôi tự hào là đơn vị tiên phong trong lĩnh vực
                    nha khoa tại Việt Nam, mang đến dịch vụ chăm sóc răng miệng chất lượng cao với
                    công nghệ hiện đại và đội ngũ bác sĩ chuyên nghiệp.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <div class="stats-icon mx-auto">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stats-number">10,000+</div>
                        <div class="stats-label">Khách hàng hài lòng</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <div class="stats-icon mx-auto">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="stats-number">15+</div>
                        <div class="stats-label">Năm kinh nghiệm</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <div class="stats-icon mx-auto">
                            <i class="bi bi-hospital-fill"></i>
                        </div>
                        <div class="stats-number">5</div>
                        <div class="stats-label">Chi nhánh toàn quốc</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <div class="stats-icon mx-auto">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="stats-number">98%</div>
                        <div class="stats-label">Tỷ lệ hài lòng</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="story-content">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=600" alt="Dental Clinic">
                </div>
                <div class="story-text">
                    <h2>Câu chuyện của chúng tôi</h2>
                    <p>
                        Được thành lập vào năm 2009, chúng tôi bắt đầu với một phòng khám nhỏ và
                        ước mơ mang đến dịch vụ nha khoa chất lượng cao cho mọi người.
                    </p>
                    <p>
                        Qua hơn 15 năm phát triển, chúng tôi đã mở rộng thành 5 chi nhánh trên
                        toàn quốc, phục vụ hơn 10,000 khách hàng với đội ngũ hơn 50 bác sĩ và
                        nhân viên chuyên nghiệp.
                    </p>
                    <p>
                        Sứ mệnh của chúng tôi là không chỉ chữa bệnh mà còn mang lại nụ cười
                        tự tin và hạnh phúc cho từng khách hàng.
                    </p>
                </div>
            </div>

            <div class="story-content reverse">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1629909615184-74f495363b67?w=600" alt="Modern Equipment">
                </div>
                <div class="story-text">
                    <h2>Công nghệ hiện đại</h2>
                    <p>
                        Chúng tôi đầu tư trang thiết bị y tế hiện đại nhất từ các thương hiệu
                        hàng đầu thế giới như Sirona, Planmeca, và Nobel Biocare.
                    </p>
                    <p>
                        Hệ thống X-quang kỹ thuật số 3D, máy scan răng miệng, và công nghệ CAD/CAM
                        giúp chúng tôi chẩn đoán chính xác và điều trị hiệu quả nhất.
                    </p>
                    <p>
                        Mỗi phòng khám được thiết kế theo tiêu chuẩn quốc tế, vô trùng tuyệt đối,
                        đảm bảo an toàn tối đa cho khách hàng.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-header">
                <h2>Giá trị cốt lõi</h2>
                <p>Những nguyên tắc định hướng mọi hành động của chúng tôi</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h3>Chất lượng hàng đầu</h3>
                        <p>
                            Chúng tôi cam kết mang đến dịch vụ chất lượng cao nhất với đội ngũ bác sĩ
                            giàu kinh nghiệm và trang thiết bị hiện đại, đảm bảo kết quả điều trị tốt nhất.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>An toàn tuyệt đối</h3>
                        <p>
                            An toàn của khách hàng là ưu tiên số một. Mọi quy trình đều tuân thủ nghiêm ngặt
                            tiêu chuẩn vệ sinh và vô trùng quốc tế, bảo vệ sức khỏe toàn diện.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-person-hearts"></i>
                        </div>
                        <h3>Tận tâm chăm sóc</h3>
                        <p>
                            Chúng tôi lắng nghe và thấu hiểu từng nhu cầu của khách hàng, luôn đặt sự hài lòng
                            của bạn lên hàng đầu trong mọi dịch vụ chăm sóc.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <h2>Đội ngũ bác sĩ</h2>
                <p>Những chuyên gia hàng đầu trong lĩnh vực nha khoa</p>
            </div>

            <div class="row g-4">
                @forelse ($dentists as $dentist)
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ $dentist->avatar ? asset('storage/' . $dentist->avatar) : asset('images/default-doctor.jpg') }}"
                                alt="{{ $dentist->user->name ?? 'Dentist' }}">

                        </div>
                        <div class="team-info">
                            <h3 class="team-name">{{ $dentist->user->name ?? 'N/A' }}</h3>
                            <div class="team-role">{{ $dentist->specialty ?? 'Bác sĩ nha khoa' }}</div>
                            <p class="team-description">
                                {{ $dentist->degree ? $dentist->degree . ' — ' : '' }}
                                {{ $dentist->experience_years ? $dentist->experience_years . ' năm kinh nghiệm. ' : '' }}
                                {{ $dentist->bio ?? 'Đang cập nhật thông tin.' }}
                            </p>
                            <div class="team-social">
                                @if($dentist->email)
                                <a href="mailto:{{ $dentist->email }}" class="social-link"><i class="bi bi-envelope"></i></a>
                                @endif
                                @if($dentist->phone)
                                <a href="tel:{{ $dentist->phone }}" class="social-link"><i class="bi bi-telephone"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <p>Hiện chưa có bác sĩ nào trong hệ thống.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>



    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Sẵn sàng bắt đầu hành trình?</h2>
                <p>
                    Đặt lịch hẹn ngay hôm nay để được tư vấn miễn phí và nhận ưu đãi đặc biệt
                    dành cho khách hàng mới.
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('appointments.create') }}" class="btn-cta btn-cta-primary">
                        <i class="bi bi-calendar-check"></i>
                        Đặt lịch ngay
                    </a>
                    <a href="#" class="btn-cta btn-cta-outline">
                        <i class="bi bi-telephone"></i>
                        Liên hệ: 1900 1234
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ==============================
           1️⃣ Fade-in Animation on Scroll
           ============================== */
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Áp dụng fade-in cho các phần tử có hiệu ứng
        document.querySelectorAll('.stats-card, .value-card, .team-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            fadeObserver.observe(el);
        });

        /* ==============================
           2️⃣ Counter Animation (Thống kê)
           ============================== */
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const duration = 2000; // 2 giây
            const frameRate = 30; // mỗi 30ms tăng một lần
            const increment = target / (duration / frameRate);

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + suffix;
                }
            }, frameRate);
        }

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const numbers = entry.target.querySelectorAll('.stats-number');
                        numbers.forEach(number => {
                            // Lấy giá trị ban đầu như "10,000+" hoặc "98%"
                            const text = number.textContent.trim();
                            const suffix = text.includes('+') ? '+' : (text.includes('%') ? '%' : '');
                            const numericValue = parseInt(text.replace(/\D/g, '')) || 0;

                            // Reset để bắt đầu animation
                            number.textContent = '0';
                            animateCounter(number, numericValue, suffix);
                        });
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            statsObserver.observe(statsSection);
        }

        /* ==============================
           3️⃣ Smooth Scroll for CTA Buttons
           ============================== */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop - 80, // trừ chiều cao header
                        behavior: 'smooth'
                    });
                }
            });
        });

        /* ==============================
           4️⃣ Back-to-top Button (tùy chọn)
           ============================== */
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '<i class="bi bi-arrow-up"></i>';
        backToTop.classList.add('btn', 'btn-gradient');
        backToTop.style.position = 'fixed';
        backToTop.style.bottom = '30px';
        backToTop.style.right = '30px';
        backToTop.style.borderRadius = '50%';
        backToTop.style.width = '50px';
        backToTop.style.height = '50px';
        backToTop.style.display = 'none';
        backToTop.style.zIndex = '999';
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', () => {
            backToTop.style.display = window.scrollY > 400 ? 'block' : 'none';
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

    });
</script>