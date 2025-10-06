<!-- MODAL CONFIRM DELETE -->
<div id="deleteModal" class="modal">
    <div class="modal_content modal_content_small">
        <div class="modal_header">
            <h3><i class="ri-delete-bin-line"></i> Confirm Delete</h3>
            <button type="button" class="modal_close" onclick="closeDeleteModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <div class="modal_body">
            <div class="delete_warning">
                <p>Are you sure you want to delete this product?</p>
                <p style="font-weight: 600;" id="deleteProductName"></p>
            </div>
        </div>

        <div class="modal_footer">
            <button type="button" class="btn_cancel pacifico" onclick="closeDeleteModal()">
                Cancel
            </button>
            <button type="button" class="btn_delete_confirm pacifico" onclick="confirmDelete()">
                Delete
            </button>
        </div>
    </div>
</div>