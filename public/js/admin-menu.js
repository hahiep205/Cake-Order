/*
*** Admin Panel - Menu Toggle Script
*/

document.addEventListener('DOMContentLoaded', function() {
    
    // Lấy tất cả menu items
    const menuItems = document.querySelectorAll('.menu_item');
    
    // Lấy tất cả content sections
    const contentSections = document.querySelectorAll('.content_section');
    
    // Xử lý khi click vào menu item
    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            
            // Lấy section name từ data-section attribute
            const sectionName = this.getAttribute('data-section');
            
            // Xóa class active khỏi tất cả menu items
            menuItems.forEach(function(menu) {
                menu.classList.remove('active');
            });
            
            // Thêm class active vào menu item được click
            this.classList.add('active');
            
            // Ẩn tất cả content sections
            contentSections.forEach(function(section) {
                section.classList.remove('active');
            });
            
            // Hiển thị section tương ứng
            const targetSection = document.getElementById('section_' + sectionName);
            if (targetSection) {
                targetSection.classList.add('active');
            }
            
        });
    });
    
});