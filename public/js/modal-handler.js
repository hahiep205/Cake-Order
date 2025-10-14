/*
*** Modal Handler - Utilities for opening/closing modals
*/

/*
*** Function đóng Modal Edit Product
*/
function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.remove('show');
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}

/*
*** Function đóng Modal Add Product
*/
function closeAddModal() {
    const modal = document.getElementById('addModal');
    modal.classList.remove('show');
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}

/*
*** Function đóng Modal Delete
*/
function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
    
    // Reset productId
    if (typeof deleteProductId !== 'undefined') {
        deleteProductId = null;
    }
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}

/*
*** Đóng modal khi click bên ngoài modal content
*/
window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const addModal = document.getElementById('addModal');
    
    if (event.target === editModal) {
        closeEditModal();
    }
    
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
    
    if (event.target === addModal) {
        closeAddModal();
    }
}

/*
*** Đóng modal khi nhấn ESC
*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeEditModal();
        closeDeleteModal();
        closeAddModal();
    }
});

/*
*** Đóng user modals khi click bên ngoài modal content
*/
window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const addModal = document.getElementById('addModal');
    
    // User Modals
    const editUserModal = document.getElementById('editUserModal');
    const deleteUserModal = document.getElementById('deleteUserModal');
    const addUserModal = document.getElementById('addUserModal');
    
    if (event.target === editModal) {
        closeEditModal();
    }
    
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
    
    if (event.target === addModal) {
        closeAddModal();
    }
    
    if (event.target === editUserModal) {
        closeEditUserModal();
    }
    
    if (event.target === deleteUserModal) {
        closeDeleteUserModal();
    }
    
    if (event.target === addUserModal) {
        closeAddUserModal();
    }
}

/*
*** Đóng modal khi nhấn ESC
*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeEditModal();
        closeDeleteModal();
        closeAddModal();
        closeEditUserModal();
        closeDeleteUserModal();
        closeAddUserModal();
    }
});