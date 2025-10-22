/*
*** Search Functionality - Scroll to Product
*/

document.addEventListener('DOMContentLoaded', function() {
    
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.querySelector('.search-input');
    
    if (searchForm && searchInput) {

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const keyword = searchInput.value.trim().toLowerCase();
            
            if (keyword === '') {
                showNotification('Please enter a search keyword.', 'error');
                return;
            }

            searchProducts(keyword);
        });

        const searchBtn = document.querySelector('.search-btn');
        if (searchBtn) {
            searchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                searchForm.dispatchEvent(new Event('submit'));
            });
        }
    }
    
    /*
    *** search cakes and scroll to first match
    */
    function searchProducts(keyword) {
        const productsItems = document.querySelectorAll('.products-item');
        let foundProduct = null;

        for (let i = 0; i < productsItems.length; i++) {
            const productItem = productsItems[i];

            const productName = productItem.querySelector('.products-name');
            const productDescription = productItem.querySelector('.products-description');
            
            if (productName && productDescription) {
                const nameText = productName.textContent.toLowerCase();
                const descText = productDescription.textContent.toLowerCase();
                
                // Check if keyword matches name or description
                if (nameText.includes(keyword) || descText.includes(keyword)) {
                    foundProduct = productItem;
                    break; // Stop at first match
                }
            }
        }

        if (foundProduct) {
            scrollToProduct(foundProduct, keyword);
        } else {
            showNotification('No products found for "' + keyword + '"', 'error');
        }
    }
    
    /*
    *** scroll to product with smooth animation
    */
    function scrollToProduct(productElement, keyword) {

        const headerHeight = 80;
        const elementTop = productElement.getBoundingClientRect().top + window.pageYOffset;
        const scrollToPosition = elementTop - headerHeight;
        
        // Smooth scroll to product
        window.scrollTo({
            top: scrollToPosition,
            behavior: 'smooth'
        });
        
        // Show success notification
        const productName = productElement.querySelector('.products-name').textContent;
        showNotification('Found: ' + productName, 'success');
        
        // Clear search input after successful search
        setTimeout(() => {
            document.querySelector('.search-input').value = '';
        }, 1000);
    }
    
});