<!-- MODAL ADD PRODUCT -->
<div id="addModal" class="modal">
    <div class="modal_content">
        <div class="modal_header">
            <h3>Add New Product</h3>
            <button type="button" class="modal_close" onclick="closeAddModal()">
                <i class="ri-close-line"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            
            <div class="modal_body">
                
                <div class="admin_form_group">
                    <label for="add_product_id">Product ID <span class="required">*</span></label>
                    <input type="text" id="add_product_id" name="product_id" placeholder="e.g. ABC-2509" required>
                </div>

                <div class="admin_form_group">
                    <label for="add_product_name">Product Name <span class="required">*</span></label>
                    <input type="text" id="add_product_name" name="product_name" placeholder="e.g. Chocolate Cake" required>
                </div>

                <div class="form_row">
                    <div class="admin_form_group">
                        <label for="add_price">Price ($) <span class="required">*</span></label>
                        <input type="number" id="add_price" name="price" step="0.01" min="0" placeholder="0.00" required>
                    </div>

                    <div class="admin_form_group">
                        <label for="add_stock">Stock <span class="required">*</span></label>
                        <input type="number" id="add_stock" name="stock" min="0" placeholder="0" required>
                    </div>
                </div>

                <div class="admin_form_group">
                    <label for="add_description">Description</label>
                    <textarea id="add_description" name="description" rows="4" placeholder="Enter product description..."></textarea>
                </div>

                <div class="admin_form_group">
                    <label for="add_image">Image Filename</label>
                    <input type="text" id="add_image" name="image" placeholder="e.g. cake1.jpg">
                </div>

            </div>

            <div class="modal_footer">
                <button type="button" class="btn_cancel" onclick="closeAddModal()">
                    Cancel
                </button>
                <button type="submit" class="btn_save">
                    Add Product
                </button>
            </div>
        </form>

    </div>
</div>