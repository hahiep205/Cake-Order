
document.addEventListener('DOMContentLoaded', function() {
    
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    
    // Handle payment method change
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.value === 'Banking') {
                showNotification('Currently we only support Cash on Delivery (COD) payment method.', 'error');
                // Auto select COD
                document.querySelector('input[name="payment_method"][value="COD"]').checked = true;
            }
        });
    });
    
});