/*
*** Menu Management - Add/Remove Products
*/

function addProductToMenu(productId) {
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
        const existingToken = document.querySelector('input[name="_token"]');
        if (existingToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = existingToken.value;
            form.appendChild(csrfInput);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

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
        const existingToken = document.querySelector('input[name="_token"]');
        if (existingToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = existingToken.value;
            form.appendChild(csrfInput);
        }
    }

    document.body.appendChild(form);
    form.submit();
}