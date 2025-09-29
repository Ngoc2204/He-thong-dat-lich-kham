<footer class="bg-blue-900 text-white pt-12 pb-6">
    <div class="container mx-auto px-6">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- About Section -->
            <div>
                <img src="{{ asset('images/logo2.png') }}" alt="The Mona" class="h-12 mb-4">
                <p class="text-gray-300 text-sm leading-relaxed">
                    Phòng khám nha khoa chuyên nghiệp với đội ngũ bác sĩ giàu kinh nghiệm, sẵn lòng phục vụ và chăm sóc cho hàm răng của bạn
                </p>
                <!-- Social Icons -->
                <div class="flex items-center space-x-3 mt-4">
                    <a href="https://facebook.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-800 rounded-lg hover:bg-blue-700 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-800 rounded-lg hover:bg-blue-700 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-800 rounded-lg hover:bg-blue-700 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://pinterest.com" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-800 rounded-lg hover:bg-blue-700 transition">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <!-- Services Section -->
            <div>
                <h4 class="font-bold text-lg mb-4 border-b-2 border-teal-400 pb-2 inline-block">Dịch vụ</h4>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="" class="hover:text-teal-400 transition">Vệ Sinh Răng Miệng</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Trám Răng Thẩm Mỹ</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Khám Răng Tổng Quát</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Niềng Răng Thẩm Mỹ</a></li>
                </ul>
            </div>

            <!-- Knowledge Section -->
            <div>
                <h4 class="font-bold text-lg mb-4 border-b-2 border-teal-400 pb-2 inline-block">Kiến thức</h4>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="" class="hover:text-teal-400 transition">Thông tin kiến thức</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Hỏi đáp bác sĩ</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Phản tích</a></li>
                    <li><a href="" class="hover:text-teal-400 transition">Tin tức</a></li>
                </ul>
            </div>

            <!-- Map Section -->
            <div>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0633837640277!2d106.62523731533467!3d10.807456061663108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752be1a73056ab%3A0x5b92e36c90f48537!2zMTQwIEzDqiBUcuG7jW5nIFThuqluLCBUw6J5IFRo4bqhbmgsIFTDom4gUGjDuiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1234567890"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
                <a href="" class="text-teal-400 text-sm hover:underline mt-2 inline-block">Xem bản đồ lớn hơn</a>
            </div>
        </div>

        <!-- Contact Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-t border-blue-800">
            <!-- Phone -->
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-phone-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Liên hệ ngay</p>
                    <a href="tel:+84123456789" class="text-teal-400 font-semibold text-lg hover:text-teal-300">(+84) 0123-456-789</a>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Email</p>
                    <a href="mailto:info@email.com" class="text-white hover:text-teal-400">info@email.com</a>
                </div>
            </div>

            <!-- Address -->
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Địa chỉ</p>
                    <p class="text-white">140 Lê Trọng Tấn, P. Tây Thạnh, Q.Tân Phú, TP.HCM</p>
                </div>
            </div>
        </div>
    </div>
</footer>