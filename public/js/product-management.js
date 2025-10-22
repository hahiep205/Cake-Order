/*
*** Product Management - CRUD Operations
*/

let deleteProductId = null;

function editProduct(productId) {
    const modal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');

    const row = event.target.closest('tr');
    const cells = row.querySelectorAll('td');
    
    // Lấy dữ liệu từ table cells
    const productIdValue = cells[1].textContent.trim();
    const productName = cells[2].textContent.trim();
    const price = cells[3].textContent.replace('$', '').replace(',', '').trim();
    const stock = cells[4].textContent.trim();
    const description = cells[5].getAttribute('title');
    
    // Lấy image từ cell thứ 6
    const imageCell = cells[6];
    const imageSpan = imageCell.querySelector('.image_filename');
    let imageValue = '';
    if (imageSpan) {
        imageValue = imageSpan.getAttribute('title');
    }

    document.getElementById('edit_product_id').value = productIdValue;
    document.getElementById('edit_product_name').value = productName;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_image').value = imageValue;

    editForm.action = '/admin/products/' + productId;

    modal.classList.add('show');

    document.body.style.overflow = 'hidden';
}

/*
*** Add Product
*/
function openAddModal() {
    const modal = document.getElementById('addModal');
    
    // Reset form về trạng thái ban đầu
    document.getElementById('add_product_id').value = '';
    document.getElementById('add_product_name').value = '';
    document.getElementById('add_price').value = '';
    document.getElementById('add_stock').value = '';
    document.getElementById('add_description').value = '';
    document.getElementById('add_image').value = '';

    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function deleteProduct(productId, productName) {
    deleteProductId = productId;
    document.getElementById('deleteProductName').textContent = productName;
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function confirmDelete() {
    if (deleteProductId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '/admin/products/' + deleteProductId;
        deleteForm.submit();
    }
}

/*
*** Preview Image
*/
function showImagePreview(imageName) {
    // Lấy modal và image element
    const modal = document.getElementById('imagePreviewModal');
    const previewImage = document.getElementById('previewImage');
    
    // Set image source
    if (imageName && imageName.trim() !== '') {
        previewImage.src = '/product_img/' + imageName;
        previewImage.alt = 'Product Image: ' + imageName;
    } else {
        previewImage.src = '/img/no-image.png';
        previewImage.alt = 'No image available';
    }

    modal.classList.add('show');

    document.body.style.overflow = 'hidden';

    previewImage.onerror = function() {
        this.src = '/img/no-image.png';
        this.alt = 'Image not found';
    };
}

function closeImagePreviewModal() {
    const modal = document.getElementById('imagePreviewModal');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
    const previewImage = document.getElementById('previewImage');
    previewImage.src = '';
}