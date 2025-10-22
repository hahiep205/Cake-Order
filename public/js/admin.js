// <!-- Auto Switch Section Handler -->

const urlParams = new URLSearchParams(window.location.search);
const section = urlParams.get('section');

// Nếu có tham số section, chuyển sang section ngay
if (section) {

    window.addEventListener('DOMContentLoaded', function () {
        // Xóa active class khỏi tất cả menu items
        document.querySelectorAll('.menu_item').forEach(item => {
            item.classList.remove('active');
        });

        // content sections
        document.querySelectorAll('.content_section').forEach(contentSection => {
            contentSection.classList.remove('active');
        });

        // Thêm active class cho menu item tương ứng
        const menuItem = document.querySelector(`.menu_item[data-section="${section}"]`);
        if (menuItem) {
            menuItem.classList.add('active');
        }

        // display content section
        const contentSection = document.getElementById(`section_${section}`);
        if (contentSection) {
            contentSection.classList.add('active');
            contentSection.offsetHeight;
        }
    }, { once: true });
}

// Js for admin header - auto scrolled state
document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');

    // Tự động áp dụng trạng thái scrolled cho trang admin
    header.style.background = 'rgba(255, 255, 255, 0.95)';
    header.style.backdropFilter = 'blur(10px)';
    header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    header.style.padding = '0';

    const brand = header.querySelector('.brand');
    const navLinks = header.querySelectorAll('.nav-items a, .nav-logs a, .nav_name');

    if (brand) brand.style.color = '#222';
    navLinks.forEach(link => {
        link.style.color = '#222';
    });

    header.classList.add('scrolled');
});