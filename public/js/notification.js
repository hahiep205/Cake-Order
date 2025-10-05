/*
*** Function hiển thị notification
*** @param {string} message - Nội dung thông báo
*** @param {string} type - 'success' hoặc 'error'
*** @param {number} duration - Thời gian hiển thị (ms)
*/
function showNotification(message, type = 'success', duration = 3500) {
    // Lấy hoặc tạo container
    let container = document.getElementById('notificationContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'notificationContainer';
        container.className = 'notification-container';
        document.body.appendChild(container);
    }
    
    // Icon tương ứng với từng loại
    const icons = {
        success: 'ri-checkbox-circle-line',
        error: 'ri-close-circle-line'
    };
    
    // Tạo notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    notification.innerHTML = `
        <i class="${icons[type]} notification-icon"></i>
        <div class="notification-content">${message}</div>
        <button class="notification-close" onclick="closeNotification(this)">
            <i class="ri-close-line"></i>
        </button>
    `;
    
    // Thêm vào đầu container (notification mới ở trên)
    container.insertBefore(notification, container.firstChild);
    
    // Tự động xóa sau duration
    setTimeout(function() {
        closeNotification(notification);
    }, duration);
}

/*
*** Function đóng notification
*** @param {Element} element - Button hoặc notification element
*/
function closeNotification(element) {
    // Nếu element là button, lấy parent notification
    const notification = element.classList 
        ? (element.classList.contains('notification') ? element : element.closest('.notification'))
        : element.closest('.notification');
    
    if (notification) {
        // Thêm class closing để animation
        notification.classList.add('closing');
        
        // Xóa sau khi animation kết thúc
        setTimeout(function() {
            notification.remove();
        }, 500);
    }
}