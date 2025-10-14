<!-- MODAL EDIT USER -->
<div id="editUserModal" class="modal">
    <div class="modal_content">
        <div class="modal_header">
            <h3>Edit User</h3>
            <button type="button" class="modal_close" onclick="closeEditUserModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal_body">
                
                <div class="admin_form_group">
                    <label for="edit_user_name">Name <span class="required">*</span></label>
                    <input type="text" id="edit_user_name" name="name" required>
                </div>

                <div class="admin_form_group">
                    <label for="edit_user_email">Email <span class="required">*</span></label>
                    <input type="email" id="edit_user_email" name="email" required>
                </div>

                <div class="form_row">
                    <div class="admin_form_group">
                        <label for="edit_user_phone">Phone</label>
                        <input type="text" id="edit_user_phone" name="phone" placeholder="0123456789" maxlength="10">
                    </div>

                    <div class="admin_form_group">
                        <label for="edit_user_role">Role <span class="required">*</span></label>
                        <select id="edit_user_role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="admin_form_group">
                    <label for="edit_user_address">Address</label>
                    <textarea id="edit_user_address" name="address" rows="3" placeholder="Enter address..."></textarea>
                </div>

                <div class="admin_form_group">
                    <label for="edit_user_password">Password <span class="optional">(Leave blank to keep current)</span></label>
                    <input type="password" id="edit_user_password" name="password" placeholder="Enter new password (min 6 characters)">
                </div>

            </div>

            <div class="modal_footer">
                <button type="button" class="btn_cancel" onclick="closeEditUserModal()">
                    Cancel
                </button>
                <button type="submit" class="btn_save">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>