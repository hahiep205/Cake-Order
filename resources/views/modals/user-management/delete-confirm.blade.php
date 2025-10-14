<!-- MODAL CONFIRM DELETE USER -->
<div id="deleteUserModal" class="modal">
    <div class="modal_content modal_content_small">
        <div class="modal_header">
            <h3><i class="ri-delete-bin-line"></i> Confirm Delete</h3>
            <button type="button" class="modal_close" onclick="closeDeleteUserModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <div class="modal_body">
            <div class="delete_warning">
                <p>Are you sure you want to delete this user?</p>
                <p style="font-weight: 600; color: #f44336;" id="deleteUserName"></p>
            </div>
        </div>

        <div class="modal_footer">
            <button type="button" class="btn_cancel" onclick="closeDeleteUserModal()">
                Cancel
            </button>
            <button type="button" class="btn_delete_confirm" onclick="confirmDeleteUser()">
                Delete
            </button>
        </div>
    </div>
</div>