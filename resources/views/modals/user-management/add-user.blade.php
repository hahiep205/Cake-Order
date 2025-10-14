<!-- MODAL ADD USER -->
<div id="addUserModal" class="modal">
    <div class="modal_content">
        <div class="modal_header">
            <h3>Add New User</h3>
            <button type="button" class="modal_close" onclick="closeAddUserModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="modal_body">
                
                <div class="admin_form_group">
                    <label for="add_user_name">Name <span class="required">*</span></label>
                    <input type="text" id="add_user_name" name="name" placeholder="e.g. John Doe" required>
                </div>

                <div class="admin_form_group">
                    <label for="add_user_email">Email <span class="required">*</span></label>
                    <input type="email" id="add_user_email" name="email" placeholder="e.g. john@email.com" required>
                </div>

                <div class="form_row">
                    <div class="admin_form_group">
                        <label for="add_user_phone">Phone</label>
                        <input type="text" id="add_user_phone" name="phone" placeholder="0123456789" maxlength="10">
                    </div>

                    <div class="admin_form_group">
                        <label for="add_user_role">Role <span class="required">*</span></label>
                        <select id="add_user_role" name="role" required>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="admin_form_group">
                    <label for="add_user_address">Address</label>
                    <textarea id="add_user_address" name="address" rows="3" placeholder="Enter address..."></textarea>
                </div>

                <div class="admin_form_group">
                    <label for="add_user_password">Password <span class="required">*</span></label>
                    <input type="password" id="add_user_password" name="password" placeholder="Minimum 6 characters" required>
                </div>

            </div>

            <div class="modal_footer">
                <button type="button" class="btn_cancel" onclick="closeAddUserModal()">
                    Cancel
                </button>
                <button type="submit" class="btn_save">
                    Add User
                </button>
            </div>
        </form>

    </div>
</div>