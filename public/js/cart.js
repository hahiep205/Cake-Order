/*
 *** Shopping Cart JavaScript Handler
 *** Xử lý các tương tác: update quantity, remove item, update note
 */

document.addEventListener('DOMContentLoaded', function () {

    console.log('Cart script loaded');

    // Lấy CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found!');
        return;
    }
    const token = csrfToken.getAttribute('content');

    // Nút giảm số lượng
    const decreaseBtns = document.querySelectorAll('.btn_decrease');
    decreaseBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
            let currentQuantity = parseInt(quantitySpan.textContent);

            if (currentQuantity > 1) {
                updateQuantity(itemId, currentQuantity - 1);
            } else {
                // Nếu quantity = 1, mà giảm tiếp thì sẽ tự động xóa
                removeItem(itemId);
            }
        });
    });

    // Nút tăng số lượng
    const increaseBtns = document.querySelectorAll('.btn_increase');
    increaseBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
            let currentQuantity = parseInt(quantitySpan.textContent);

            updateQuantity(itemId, currentQuantity + 1);
        });
    });

    /*
     *** Xóa sản phẩm
     */
    const removeBtns = document.querySelectorAll('.remove_btn');
    removeBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            removeItem(itemId);
        });
    });

    /*
     *** Cập nhật note
     */
    const noteTextareas = document.querySelectorAll('.note_textarea');
    let noteTimeout;

    noteTextareas.forEach(textarea => {
        textarea.addEventListener('input', function () {
            const itemId = this.getAttribute('data-item-id');
            const noteValue = this.value;

            // Clear timeout cũ
            clearTimeout(noteTimeout);

            // Set timeout mới - auto save sau 1 giây
            noteTimeout = setTimeout(() => {
                updateNote(itemId, noteValue);
            }, 1000);
        });
    });

    /*
     *** Cập nhật số lượng
     */
    function updateQuantity(itemId, newQuantity) {
        // Disable buttons tạm thời
        const decreaseBtn = document.querySelector(`.btn_decrease[data-item-id="${itemId}"]`);
        const increaseBtn = document.querySelector(`.btn_increase[data-item-id="${itemId}"]`);
        decreaseBtn.disabled = true;
        increaseBtn.disabled = true;

        fetch(`/cart/update/${itemId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng trên UI
                    const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
                    quantitySpan.textContent = newQuantity;

                    // Cập nhật tổng tiền item
                    const itemTotalSpan = document.querySelector(`.cart_item[data-item-id="${itemId}"] .item_total`);
                    itemTotalSpan.textContent = data.item_total;

                    // Cập nhật tổng tiền đơn hàng
                    document.getElementById('subtotal').textContent = data.total_amount;
                    document.getElementById('total_amount').textContent = data.total_amount;

                    // Hiển thị notification
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }

                // Enable lại buttons
                decreaseBtn.disabled = false;
                increaseBtn.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to update quantity. Please try again.', 'error');

                // Enable lại buttons
                decreaseBtn.disabled = false;
                increaseBtn.disabled = false;
            });
    }

    /*
     *** Func xóa sản phẩm
     */
    function removeItem(itemId) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Xóa item khỏi DOM với animation
                    const cartItem = document.querySelector(`.cart_item[data-item-id="${itemId}"]`);
                    cartItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    cartItem.style.opacity = '0';
                    cartItem.style.transform = 'translateX(-20px)';

                    setTimeout(() => {
                        cartItem.remove();

                        // Kiểm tra nếu giỏ hàng trống
                        const remainingItems = document.querySelectorAll('.cart_item');
                        if (remainingItems.length === 0) {
                            // Reload trang để hiển thị empty state
                            location.reload();
                        } else {
                            // Cập nhật số lượng items
                            document.getElementById('items_count').textContent = data.items_count;

                            // Cập nhật tổng tiền
                            document.getElementById('subtotal').textContent = data.total_amount;
                            document.getElementById('total_amount').textContent = data.total_amount;

                        }
                    }, 300);

                    // Hiển thị notification
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to remove item. Please try again.', 'error');
            });
    }

    /*
     *** Func cập nhật note
     */
    function updateNote(itemId, noteValue) {
        fetch(`/cart/note/${itemId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                note: noteValue
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Note được lưu thành công (không hiển thị notification để tránh spam)
                    console.log('Note saved successfully');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

});