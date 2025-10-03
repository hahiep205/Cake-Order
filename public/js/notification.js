// notification.js

// Tạo container khi trang load
document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.notification-container')) {
        const container = document.createElement('div');
        container.className = 'notification-container';
        document.body.appendChild(container);
    }
});

// Hàm hiển thị thông báo
function showNotification(message, type = 'success') {
    // Tạo container nếu chưa có
    let container = document.querySelector('.notification-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'notification-container';
        document.body.appendChild(container);
    }

    // Tạo phần tử thông báo
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;

    // Icon tùy theo loại
    const icon = type === 'success' 
        ? '<i class="ri-checkbox-circle-line"></i>' 
        : '<i class="ri-error-warning-line"></i>';

    // Nội dung HTML
    notification.innerHTML = `
        <div class="notification-icon">
            ${icon}
        </div>
        <div class="notification-content">
            ${message}
        </div>
        <button class="notification-close">
            <i class="ri-close-line"></i>
        </button>
    `;

    // Thêm vào đầu container (thông báo mới ở trên)
    container.insertBefore(notification, container.firstChild);

    // Xử lý nút đóng
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', function() {
        closeNotification(notification);
    });

    // Tự động đóng sau 4 giây
    setTimeout(function() {
        closeNotification(notification);
    }, 4000);
}

// Hàm đóng thông báo
function closeNotification(notification) {
    // Thêm class closing để chạy animation
    notification.classList.add('closing');
    
    // Xóa khỏi DOM sau khi animation kết thúc
    setTimeout(function() {
        if (notification.parentElement) {
            notification.parentElement.removeChild(notification);
        }
    }, 300);
}

// Export functions để sử dụng
window.showNotification = showNotification;