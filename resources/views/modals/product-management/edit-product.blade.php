<!-- MODAL EDIT PRODUCT -->
<div id="editModal" class="modal">
    <div class="modal_content">
        <div class="modal_header">
            <h3>Edit Product</h3>
            <button type="button" class="modal_close" onclick="closeEditModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal_body">
                
                <div class="admin_form_group">
                    <label for="edit_product_id">Product ID <span class="required">*</span></label>
                    <input type="text" id="edit_product_id" name="product_id" required>
                </div>

                <div class="admin_form_group">
                    <label for="edit_product_name">Product Name <span class="required">*</span></label>
                    <input type="text" id="edit_product_name" name="product_name" required>
                </div>

                <div class="form_row">
                    <div class="admin_form_group">
                        <label for="edit_price">Price ($) <span class="required">*</span></label>
                        <input type="number" id="edit_price" name="price" step="0.01" min="0" required>
                    </div>

                    <div class="admin_form_group">
                        <label for="edit_stock">Stock <span class="required">*</span></label>
                        <input type="number" id="edit_stock" name="stock" min="0" required>
                    </div>
                </div>

                <div class="admin_form_group">
                    <label for="edit_description">Description</label>
                    <textarea id="edit_description" name="description" rows="4"></textarea>
                </div>

                <div class="admin_form_group">
                    <label for="edit_image">Image Filename</label>
                    <input type="text" id="edit_image" name="image" placeholder="e.g. cake1.jpg">
                </div>

            </div>

            <div class="modal_footer">
                <button type="button" class="btn_cancel pacifico" onclick="closeEditModal()">
                    Cancel
                </button>
                <button type="submit" class="btn_save pacifico">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>