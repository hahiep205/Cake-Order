/*
*** Menu Management - Add/Remove Products
*/

/*
*** Function Add Product to Menu (tăng stock lên 1)
*/
function addProductToMenu(productId) {
    // Tạo form để submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/menu/add/' + productId;

    // Thêm CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken.content;
        form.appendChild(csrfInput);
    } else {
        // Fallback: lấy từ form có sẵn
        const existingToken = document.querySelector('input[name="_token"]');
        if (existingToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = existingToken.value;
            form.appendChild(csrfInput);
        }
    }

    // Thêm form vào body và submit
    document.body.appendChild(form);
    form.submit();
}

/*
*** Function Remove Product from Menu (set stock = 0)
*/
function removeProductFromMenu(productId) {
    // Tạo form để submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/menu/remove/' + productId;

    // Thêm CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken.content;
        form.appendChild(csrfInput);
    } else {
        // Fallback: lấy từ form có sẵn
        const existingToken = document.querySelector('input[name="_token"]');
        if (existingToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = existingToken.value;
            form.appendChild(csrfInput);
        }
    }

    // Thêm form vào body và submit
    document.body.appendChild(form);
    form.submit();
}