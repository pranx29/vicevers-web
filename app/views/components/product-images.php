<?php
function renderProductImages($productImages)
{
    ?>
    <div class="product-image-container flex gap-x-5 w-1/2 flex-shrink-0">
        <div class="main-image bg-secondary p-6 rounded-3xl w-[80%]">
            <div class="flex justify-center items-center h-full">
                <img id="mainImage" src="<?php echo htmlspecialchars($productImages[0]['image_url']); ?>" alt="Product Image"
                    class="object-cover">
            </div>
        </div>
        <div class="image-variant-container w-[20%] flex flex-col gap-y-4">
            <?php foreach ($productImages as $image): ?>
                <div class="p-4 bg-secondary rounded-t-3xl rounded-b-xl transition-transform duration-300 hover:scale-105">
                    <img src="<?php echo htmlspecialchars($image['image_url']); ?>" alt="Product Image"
                        data-image="<?php echo htmlspecialchars($image['image_url']); ?>" class="variant-image">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const variantImages = document.querySelectorAll('.variant-image');
            const mainImage = document.getElementById('mainImage');
            variantImages.forEach(image => {
                image.addEventListener('click', function () {
                    mainImage.src = this.getAttribute('data-image');
                });
            });
        });
    </script>
    <?php
}
?>