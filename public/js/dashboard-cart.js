document.addEventListener('DOMContentLoaded', function () {

    console.log('Dashboard cart script loaded');

    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found!');
        return;
    }
    const token = csrfToken.getAttribute('content');
    console.log('CSRF Token found');

    const addToCartButtons = document.querySelectorAll('.add_to_cart_button');
    console.log('Add to cart buttons found:', addToCartButtons.length);

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {

            if (this.disabled) {
                showNotification('Please login to add products to cart.', 'error');
                return;
            }

            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');

            console.log('Adding to cart:', productId, productName);

            this.disabled = true;
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i>';

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data);

                    if (data.success) {
                        showNotification(`${productName} added to cart successfully!`, 'success');
                        updateCartCount(data.cart_count);

                        setTimeout(() => {
                            this.disabled = false;
                            this.innerHTML = originalHTML;
                        }, 1000);
                    } else {
                        showNotification(data.message, 'error');
                        this.disabled = false;
                        this.innerHTML = originalHTML;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to add product to cart. Please try again.', 'error');
                    this.disabled = false;
                    this.innerHTML = originalHTML;
                });
        });
    });

    function updateCartCount(count) {
        const cartCountBadge = document.getElementById('cart_count_badge');
        if (cartCountBadge) {
            cartCountBadge.textContent = count;
            if (count > 0) {
                cartCountBadge.style.display = 'block';
            }
            cartCountBadge.style.transform = 'scale(1.3)';
            setTimeout(() => {
                cartCountBadge.style.transform = 'scale(1)';
            }, 300);
        }
    }

});

const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);