<?php

require_once BASE_URL . '/app/views/components/product-images.php';
require_once BASE_URL . '/app/views/components/product-details.php';

// Define your images
$productImages = [
    'assets/images/clothing/ps1.png',
    'assets/images/clothing/ps2.png',
    'assets/images/clothing/ps3.png',
    'assets/images/clothing/ps4.png',
    'assets/images/clothing/ps5.png'
];

?>

<div class="p-20 flex gap-10">
    <?php renderProductImages($product['images']);
    renderProductDetails($product);
    ?>

</div>

<script>
    function handleAddToCartClick() {

        const productId = document.getElementById('product').getAttribute('data-product-id');
        
        const selectedColor = document.querySelector('input[name="color"]:checked');
        const selectedSize = document.querySelector('input[name="size"]:checked');

        if (!selectedColor || !selectedSize) {
            alert('Please select a color and size.');
            return;
        } else {
            const colorId = selectedColor.value;
            const sizeId = selectedSize.value;
            const quantity = 1;

            const url = `cart/add?productId=${encodeURIComponent(productId)}&sizeId=${encodeURIComponent(sizeId)}&colorId=${encodeURIComponent(colorId)}&quantity=${encodeURIComponent(quantity)}`;

            console.log('Request URL:', url);

            fetch(url, { method: 'GET' })
                .then(response => response.text())
                .then(data => {
                    let parsedData = JSON.parse(data);
                    if (parsedData.success) {
                        let itemsCountElement = document.getElementById('items-count');
                        itemsCountElement.innerText = parseInt(itemsCountElement.innerText) + 1;
                        console.log(parsedData.message);

                    } else {
                        alert(parsedData.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });

        }
    }
</script>