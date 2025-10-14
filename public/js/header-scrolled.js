// Js for admin header - auto scrolled state
document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    
    // Tự động áp dụng trạng thái scrolled cho trang admin/login/register để đổi màu chữ và underline
    header.style.background = 'rgba(255, 255, 255, 0.95)';
    header.style.backdropFilter = 'blur(10px)';
    header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    header.style.padding = '0';
    
    // Đổi màu chữ sang tối
    const brand = header.querySelector('.brand');
    const navLinks = header.querySelectorAll('.nav-items a, .nav-logs a, .nav_name');
    
    if (brand) brand.style.color = '#222';
    navLinks.forEach(link => {
        link.style.color = '#222';
    });
    
    // Thêm class để đổi màu underline effect
    header.classList.add('scrolled');
});