/*
*** Function hiển thị notification
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

    const icons = {
        success: 'ri-checkbox-circle-line',
        error: 'ri-close-circle-line'
    };

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
    
    // Tự động xóa sau
    setTimeout(function() {
        closeNotification(notification);
    }, duration);
}

function closeNotification(element) {
    const notification = element.classList 
        ? (element.classList.contains('notification') ? element : element.closest('.notification'))
        : element.closest('.notification');
    
    if (notification) {
        notification.classList.add('closing');

        setTimeout(function() {
            notification.remove();
        }, 500);
    }
}