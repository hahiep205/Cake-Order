<!-- Section: User Management -->
<div class="section_header">
    <h2><i class="ri-cake-line"></i> Product Management</h2>
    <button class="btn_add pacifico" onclick="openAddModal()">
        Add Product
    </button>
</div>

<div class="section_body">
    
    <!-- Hiển thị success message nếu có -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    <!-- Hiển thị error message nếu có -->
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Hiển thị validation errors nếu có -->
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('{{ $errors->first() }}', 'error');
            });
        </script>
    @endif

        
    <div class="products_table_wrapper">
        <table class="products_table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td title="{{ $product->description }}">
                            {{ Str::limit($product->description, 50) }}
                        </td>
                        <td>
                            @if($product->image)
                                <span class="image_filename" title="{{ $product->image }}">
                                    {{ Str::limit($product->image, 15) }}
                                </span>
                            @else
                                <span class="no_image">
                                    No image
                                </span>
                            @endif
                        </td>
                        <td>
                            <button class="btn_action btn_edit pacifico" onclick="editProduct({{ $product->id }})">
                                Edit
                            </button>
                            <button class="btn_action btn_delete pacifico" onclick="deleteProduct({{ $product->id }}, '{{ $product->product_name }}')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>