function updateQuantity(productId) {
    var quantityInput = document.querySelector('#update-form-' + productId + ' input[name="quantity"]');
    if (quantityInput.value > 20) {
        quantityInput.value = 20;
    }
    document.getElementById('update-form-' + productId).submit();
}