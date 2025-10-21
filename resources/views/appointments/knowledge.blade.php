@extends('layouts.app')

@section('content')
    <div class="knowledge-page">
        <!-- Header Section -->
        <div class="knowledge-header text-center mb-5">
            <div class="icon-wrapper mb-3">
                <i class="bi bi-book"></i>
            </div>
            <h2 class="fw-bold mb-2">Kiến thức nha khoa</h2>
            <p class="text-muted">Cập nhật thông tin và kiến thức chăm sóc răng miệng</p>
        </div>

        <!-- Search & Filter Section -->
        <div class="search-filter-section mb-5">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Tìm kiếm bài viết...">
                    </div>
                </div>
                <div class="col-lg-4">
                    <select class="form-select category-select">
                        <option value="">Tất cả chủ đề</option>
                        <option value="care">Chăm sóc răng miệng</option>
                        <option value="treatment">Điều trị nha khoa</option>
                        <option value="prevention">Phòng ngừa bệnh lý</option>
                        <option value="kids">Nha khoa trẻ em</option>
                        <option value="cosmetic">Nha khoa thẩm mỹ</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Featured Article -->
        <div class="featured-article mb-5">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="featured-image" style="background-image: url('https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800');">
                        <span class="featured-badge">Nổi bật</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-content">
                        <span class="category-badge">Chăm sóc răng miệng</span>
                        <h3 class="featured-title">10 Cách Chăm Sóc Răng Miệng Hiệu Quả Hàng Ngày</h3>
                        <p class="featured-excerpt">
                            Khám phá những phương pháp chăm sóc răng miệng đơn giản nhưng hiệu quả giúp bạn duy trì nụ cười trắng sáng và sức khỏe răng miệng tốt nhất.
                        </p>
                        <div class="article-meta">
                            <span><i class="bi bi-calendar3"></i> 15/10/2025</span>
                            <span><i class="bi bi-eye"></i> 1,234 lượt xem</span>
                            <span><i class="bi bi-clock"></i> 5 phút đọc</span>
                        </div>
                        <a href="#" class="btn btn-read-more">
                            Đọc tiếp <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="articles-section">
            <h4 class="section-title mb-4">
                <i class="bi bi-grid-3x3-gap text-primary me-2"></i>
                Bài viết mới nhất
            </h4>

            <div class="row g-4">
                <!-- Article Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=600');">
                            <span class="category-tag">Điều trị</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">Niềng Răng Invisalign: Giải Pháp Chỉnh Nha Thẩm Mỹ</h5>
                            <p class="article-excerpt">
                                Tìm hiểu về công nghệ niềng răng trong suốt Invisalign, ưu điểm và quy trình điều trị hiện đại.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 14/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1609840114035-3c981960afdd?w=600');">
                            <span class="category-tag">Phòng ngừa</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">Cách Phòng Ngừa Sâu Răng Hiệu Quả Cho Trẻ Em</h5>
                            <p class="article-excerpt">
                                Hướng dẫn cha mẹ cách chăm sóc răng miệng cho trẻ, phòng ngừa sâu răng từ sớm.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 13/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600');">
                            <span class="category-tag">Thẩm mỹ</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">Bọc Răng Sứ: Những Điều Cần Biết Trước Khi Quyết Định</h5>
                            <p class="article-excerpt">
                                Thông tin chi tiết về quy trình bọc răng sứ, ưu nhược điểm và cách chăm sóc sau điều trị.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 12/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Card 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=600');">
                            <span class="category-tag">Chăm sóc</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">5 Sai Lầm Thường Gặp Khi Đánh Răng</h5>
                            <p class="article-excerpt">
                                Những sai lầm phổ biến khi vệ sinh răng miệng và cách khắc phục để bảo vệ răng tốt hơn.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 11/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Card 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=600');">
                            <span class="category-tag">Trẻ em</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">Khi Nào Nên Đưa Trẻ Đi Khám Nha Khoa Lần Đầu?</h5>
                            <p class="article-excerpt">
                                Hướng dẫn thời điểm thích hợp và cách chuẩn bị tâm lý cho trẻ trước buổi khám đầu tiên.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 10/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Card 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="article-card">
                        <div class="article-image" style="background-image: url('https://images.unsplash.com/photo-1588776814546-daab30f310ce?w=600');">
                            <span class="category-tag">Điều trị</span>
                        </div>
                        <div class="article-body">
                            <h5 class="article-title">Cấy Ghép Implant: Quy Trình Và Chi Phí</h5>
                            <p class="article-excerpt">
                                Giải đáp mọi thắc mắc về cấy ghép implant, từ quy trình, thời gian đến chi phí điều trị.
                            </p>
                            <div class="article-footer">
                                <span class="article-date"><i class="bi bi-calendar3"></i> 09/10/2025</span>
                                <a href="#" class="read-link">Đọc thêm <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <style>
        /* Main Container */
        .knowledge-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 20px 40px;
            min-height: 100vh;
        }

        /* Header Section */
        .knowledge-header {
            animation: fadeInDown 0.6s ease-out;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
            animation: pulse 2s infinite;
        }

        .icon-wrapper i {
            font-size: 2.5rem;
            color: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Search & Filter */
        .search-filter-section {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box i {
            position: absolute;
            left: 20px;
            font-size: 1.2rem;
            color: #94a3b8;
            z-index: 1;
        }

        .search-box .form-control {
            padding-left: 55px;
            height: 55px;
            border: 2px solid #e0e7ff;
            border-radius: 15px;
            font-size: 15px;
            background: white;
            transition: all 0.3s ease;
        }

        .search-box .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .category-select {
            height: 55px;
            border: 2px solid #e0e7ff;
            border-radius: 15px;
            font-size: 15px;
            font-weight: 500;
            background: white;
            transition: all 0.3s ease;
        }

        .category-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        /* Featured Article */
        .featured-article {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .featured-image {
            height: 100%;
            min-height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .featured-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        .featured-content {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .category-badge {
            display: inline-block;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0369a1;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            width: fit-content;
        }

        .featured-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .featured-excerpt {
            color: #64748b;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .article-meta {
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .article-meta span {
            color: #94a3b8;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .article-meta i {
            color: #667eea;
        }

        .btn-read-more {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            padding: 14px 35px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            width: fit-content;
            display: inline-flex;
            align-items: center;
        }

        .btn-read-more:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Articles Section */
        .articles-section {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .section-title {
            font-weight: 700;
            color: #1e293b;
        }

        /* Article Card */
        .article-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .article-image {
            height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .category-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #667eea;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .article-body {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .article-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-excerpt {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }

        .article-date {
            color: #94a3b8;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .read-link {
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .read-link:hover {
            gap: 10px;
            color: #764ba2;
        }

        /* Pagination */
        .pagination-wrapper .pagination {
            background: white;
            border-radius: 15px;
            padding: 10px 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .pagination-wrapper .page-link {
            border: none;
            color: #667eea;
            font-weight: 600;
            margin: 0 5px;
            border-radius: 10px;
            padding: 10px 16px;
            transition: all 0.3s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            color: #667eea;
        }

        .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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

        /* Responsive */
        @media (max-width: 992px) {
            .knowledge-page {
                padding: 100px 15px 30px;
            }

            .featured-image {
                min-height: 300px;
            }

            .featured-content {
                padding: 35px;
            }

            .featured-title {
                font-size: 1.5rem;
            }

            .featured-excerpt {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .icon-wrapper {
                width: 60px;
                height: 60px;
            }

            .icon-wrapper i {
                font-size: 2rem;
            }

            .featured-content {
                padding: 25px;
            }

            .article-meta {
                gap: 15px;
            }

            .search-box .form-control,
            .category-select {
                height: 50px;
            }
        }
    </style>
@endsection