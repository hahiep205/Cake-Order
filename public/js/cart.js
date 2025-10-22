/*
 *** update quantity, remove item, update note
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

    // btn - sl
    const decreaseBtns = document.querySelectorAll('.btn_decrease');
    decreaseBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
            let currentQuantity = parseInt(quantitySpan.textContent);

            if (currentQuantity > 1) {
                updateQuantity(itemId, currentQuantity - 1);
            } else {
                removeItem(itemId);
            }
        });
    });

    // btn + sl
    const increaseBtns = document.querySelectorAll('.btn_increase');
    increaseBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
            let currentQuantity = parseInt(quantitySpan.textContent);

            updateQuantity(itemId, currentQuantity + 1);
        });
    });

    const removeBtns = document.querySelectorAll('.remove_btn');
    removeBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            removeItem(itemId);
        });
    });

    const noteTextareas = document.querySelectorAll('.note_textarea');
    let noteTimeout;

    noteTextareas.forEach(textarea => {
        textarea.addEventListener('input', function () {
            const itemId = this.getAttribute('data-item-id');
            const noteValue = this.value;

            clearTimeout(noteTimeout);

            noteTimeout = setTimeout(() => {
                updateNote(itemId, noteValue);
            }, 1000);
        });
    });

    function updateQuantity(itemId, newQuantity) {
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
                    // Cập nhật số lượng
                    const quantitySpan = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
                    quantitySpan.textContent = newQuantity;

                    // Cập nhật tổng tiền item
                    const itemTotalSpan = document.querySelector(`.cart_item[data-item-id="${itemId}"] .item_total`);
                    itemTotalSpan.textContent = data.item_total;

                    // tổng tiền đơn hàng
                    document.getElementById('subtotal').textContent = data.total_amount;
                    document.getElementById('total_amount').textContent = data.total_amount;

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

                decreaseBtn.disabled = false;
                increaseBtn.disabled = false;
            });
    }

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

                        const remainingItems = document.querySelectorAll('.cart_item');
                        if (remainingItems.length === 0) {
                            location.reload();
                        } else {
                            document.getElementById('items_count').textContent = data.items_count;
                            document.getElementById('subtotal').textContent = data.total_amount;
                            document.getElementById('total_amount').textContent = data.total_amount;

                        }
                    }, 300);
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