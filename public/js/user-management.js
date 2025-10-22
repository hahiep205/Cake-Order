/*
*** User Management - CRUD Operations
*/

let deleteUserId = null;

/*
*** mở Modal Edit User
*/
function editUser(userId) {
    // Lấy modal
    const modal = document.getElementById('editUserModal');
    const editForm = document.getElementById('editUserForm');

    const row = event.target.closest('tr');
    const cells = row.querySelectorAll('td');
    
    // Lấy dữ liệu từ table cells
    const userName = cells[1].textContent.trim();
    const userEmail = cells[2].textContent.trim();
    const userPhone = cells[3].textContent.trim();
    const userAddress = cells[4].getAttribute('title');
    
    // Lấy role
    const roleCell = cells[5];
    const roleBadge = roleCell.querySelector('.role_badge');
    let userRole = 'user';
    if (roleBadge && roleBadge.classList.contains('role_admin')) {
        userRole = 'admin';
    }

    document.getElementById('edit_user_name').value = userName;
    document.getElementById('edit_user_email').value = userEmail;
    document.getElementById('edit_user_phone').value = userPhone === '-' ? '' : userPhone;
    document.getElementById('edit_user_address').value = userAddress === '-' ? '' : userAddress;
    document.getElementById('edit_user_role').value = userRole;
    document.getElementById('edit_user_password').value = '';

    editForm.action = '/admin/users/' + userId;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

/*
*** mở Modal Add User
*/
function openAddUserModal() {
    const modal = document.getElementById('addUserModal');

    document.getElementById('add_user_name').value = '';
    document.getElementById('add_user_email').value = '';
    document.getElementById('add_user_phone').value = '';
    document.getElementById('add_user_address').value = '';
    document.getElementById('add_user_role').value = 'user';
    document.getElementById('add_user_password').value = '';

    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function deleteUser(userId, userName) {

    deleteUserId = userId;

    document.getElementById('deleteUserName').textContent = userName;

    const modal = document.getElementById('deleteUserModal');
    modal.classList.add('show');

    document.body.style.overflow = 'hidden';
}

function confirmDeleteUser() {
    if (deleteUserId) {

        const deleteForm = document.getElementById('deleteForm');

        deleteForm.action = '/admin/users/' + deleteUserId;

        deleteForm.submit();
    }
}

function closeEditUserModal() {
    const modal = document.getElementById('editUserModal');
    modal.classList.remove('show');

    document.body.style.overflow = 'auto';
}

function closeAddUserModal() {
    const modal = document.getElementById('addUserModal');
    modal.classList.remove('show');

    document.body.style.overflow = 'auto';
}

function closeDeleteUserModal() {
    const modal = document.getElementById('deleteUserModal');
    modal.classList.remove('show');

    deleteUserId = null;

    document.body.style.overflow = 'auto';
}