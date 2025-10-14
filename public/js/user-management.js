/*
*** User Management - CRUD Operations
*/

/*
*** Biến toàn cục để lưu userId khi delete
*/
let deleteUserId = null;

/*
*** Function mở Modal Edit User
*/
function editUser(userId) {
    // Lấy modal
    const modal = document.getElementById('editUserModal');
    const editForm = document.getElementById('editUserForm');
    
    // Fetch dữ liệu user từ table
    const row = event.target.closest('tr');
    const cells = row.querySelectorAll('td');
    
    // Lấy dữ liệu từ table cells
    const userName = cells[1].textContent.trim();
    const userEmail = cells[2].textContent.trim();
    const userPhone = cells[3].textContent.trim();
    const userAddress = cells[4].getAttribute('title');
    
    // Lấy role từ badge
    const roleCell = cells[5];
    const roleBadge = roleCell.querySelector('.role_badge');
    let userRole = 'user';
    if (roleBadge && roleBadge.classList.contains('role_admin')) {
        userRole = 'admin';
    }
    
    // Điền dữ liệu vào form
    document.getElementById('edit_user_name').value = userName;
    document.getElementById('edit_user_email').value = userEmail;
    document.getElementById('edit_user_phone').value = userPhone === '-' ? '' : userPhone;
    document.getElementById('edit_user_address').value = userAddress === '-' ? '' : userAddress;
    document.getElementById('edit_user_role').value = userRole;
    document.getElementById('edit_user_password').value = ''; // Clear password field
    
    // Set action URL cho form
    editForm.action = '/admin/users/' + userId;
    
    // Hiển thị modal
    modal.classList.add('show');
    
    // Prevent body scroll khi modal mở
    document.body.style.overflow = 'hidden';
}

/*
*** Function mở Modal Add User
*/
function openAddUserModal() {
    const modal = document.getElementById('addUserModal');
    
    // Reset form về trạng thái ban đầu
    document.getElementById('add_user_name').value = '';
    document.getElementById('add_user_email').value = '';
    document.getElementById('add_user_phone').value = '';
    document.getElementById('add_user_address').value = '';
    document.getElementById('add_user_role').value = 'user';
    document.getElementById('add_user_password').value = '';
    
    // Hiển thị modal
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

/*
*** Function mở Modal Confirm Delete User
*/
function deleteUser(userId, userName) {
    // Lưu userId vào biến toàn cục
    deleteUserId = userId;
    
    // Hiển thị tên user trong modal
    document.getElementById('deleteUserName').textContent = userName;
    
    // Hiển thị modal
    const modal = document.getElementById('deleteUserModal');
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

/*
*** Function xác nhận Delete User
*/
function confirmDeleteUser() {
    if (deleteUserId) {
        // Lấy form delete ẩn
        const deleteForm = document.getElementById('deleteForm');
        
        // Set action URL với user ID
        deleteForm.action = '/admin/users/' + deleteUserId;
        
        // Submit form
        deleteForm.submit();
    }
}

/*
*** Function đóng Modal Edit User
*/
function closeEditUserModal() {
    const modal = document.getElementById('editUserModal');
    modal.classList.remove('show');
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}

/*
*** Function đóng Modal Add User
*/
function closeAddUserModal() {
    const modal = document.getElementById('addUserModal');
    modal.classList.remove('show');
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}

/*
*** Function đóng Modal Delete User
*/
function closeDeleteUserModal() {
    const modal = document.getElementById('deleteUserModal');
    modal.classList.remove('show');
    
    // Reset userId
    deleteUserId = null;
    
    // Enable body scroll lại
    document.body.style.overflow = 'auto';
}