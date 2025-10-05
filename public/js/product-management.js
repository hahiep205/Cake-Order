/*
*** Product Management - CRUD Operations
*/

/*
*** Biến toàn cục để lưu productId khi delete
*/
let deleteProductId = null;

/*
*** Function mở Modal Edit Product
*/
function editProduct(productId) {
    // Lấy modal
    const modal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    
    // Fetch dữ liệu product từ table
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
    
    // Điền dữ liệu vào form
    document.getElementById('edit_product_id').value = productIdValue;
    document.getElementById('edit_product_name').value = productName;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_image').value = imageValue;
    
    // Set action URL cho form
    editForm.action = '/admin/products/' + productId;
    
    // Hiển thị modal
    modal.classList.add('show');
    
    // Prevent body scroll khi modal mở
    document.body.style.overflow = 'hidden';
}

/*
*** Function mở Modal Add Product
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
    
    // Hiển thị modal
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

/*
*** Function mở Modal Confirm Delete
*/
function deleteProduct(productId, productName) {
    // Lưu productId vào biến toàn cục
    deleteProductId = productId;
    
    // Hiển thị tên product trong modal
    document.getElementById('deleteProductName').textContent = productName;
    
    // Hiển thị modal
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

/*
*** Function xác nhận Delete
*/
function confirmDelete() {
    if (deleteProductId) {
        // Lấy form delete ẩn
        const deleteForm = document.getElementById('deleteForm');
        
        // Set action URL với product ID
        deleteForm.action = '/admin/products/' + deleteProductId;
        
        // Submit form
        deleteForm.submit();
    }
}