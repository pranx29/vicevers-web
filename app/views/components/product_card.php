<?php
function renderProductCard($product_id, $productName, $price, $imageUrl, $discountedPrice = null)
{
    ?>
    <div class="bg-secondary p-6 rounded-cc max-w-xs flex flex-col space-y-4 transition-transform duration-200 transform hover:scale-105 active:scale-95 cursor-pointer"
        onclick="handleCardClick('<?php echo htmlspecialchars($product_id); ?>')">
        <div class="flex justify-center">
            <img src="<?php echo htmlspecialchars($imageUrl); ?>" class="h-[250px]" />
        </div>
        <div class="text-right">
            <p class="font-bold text-contentColor1">
                <?php echo htmlspecialchars($productName); ?>
            </p>
            <p class="font-medium text-contentColor1">LKR
                <?php if ($discountedPrice !== null): ?>
                    <span class="line-through"><?php echo htmlspecialchars($price); ?></span>
                    <span class="text-white"> <?php echo htmlspecialchars($discountedPrice); ?></span>
                <?php else: ?>
                    <?php echo htmlspecialchars($price); ?>
                <?php endif; ?>
            </p>
        </div>


    </div>
    <?php
}
?>

<?php
function renderProductCard2($product)
{
    $colors = $product['colors'];
    $sizes = $product['sizes'];
    ?>
    <div
        class="flex flex-col items-center justify-center w-[30%] transition-transform duration-200 transform hover:scale-105 h-[450px]">
        <div onclick="handleAddToCartClick('<?php echo htmlspecialchars($product['id']); ?>')">
            <img src="assets/images/plus-circle.svg" alt="product" class="w-12 h-12 hover:opacity-80">
        </div>
        <div class="flex flex-col gap-y-3 bg-secondary p-5 rounded-t-[75px] rounded-b-3xl text-contentColor1 flex-1">
            <div class="flex flex-col justify-start gap-y-3"
                onclick="handleCardClick('<?php echo htmlspecialchars($product['id']); ?>')">
                <div class="flex justify-center h-[250px]">
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="product" class=" object-contain">
                </div>
                <div class="flex flex-col items-end">
                    <h5 class="font-bold"><?= htmlspecialchars($product['name']) ?></h5>
                    <p class="font-medium">
                        <?php if ($product['discounted_price'] !== null): ?>
                            <span class="line-through"><?= 'LKR ' . number_format(htmlspecialchars($product['price']), 2) ?></span>
                            <span class="text-white"><?= 'LKR ' . number_format(htmlspecialchars($product['discounted_price']), 2) ?></span>
                        <?php else: ?>
                            <?= 'LKR ' . htmlspecialchars($product['price']) ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="flex gap-x-2">
                <span>Color</span>
                <?php foreach ($colors as $color): ?>
                    <label>
                        <input type="radio" name="<?= 'color' . htmlspecialchars($product['id']) ?>"
                            value="<?= htmlspecialchars($color['id']) ?>" class="hidden peer">
                        <div class="w-6 h-6 rounded-sm peer-checked:border peer-checked:border-white"
                            style="background-color: <?= htmlspecialchars($color['color_code']) ?>;"></div>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="flex gap-x-2">
                <span>Sizes</span>
                <?php foreach ($sizes as $size): ?>
                    <label>
                        <input type="radio" name="<?= 'size' . htmlspecialchars($product['id']) ?>"
                            value="<?= htmlspecialchars($size['id']) ?>" class="hidden peer">
                        <div
                            class="text-sm w-6 h-6 rounded-sm border border-white peer-checked:bg-white peer-checked:text-black flex justify-center items-center peer-default:text-white">
                            <?= htmlspecialchars($size['name']) ?>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}
function renderProductCard3($product)
{
    ?>
    <div class="product-item flex justify-between items-center gap-y-5 bg-secondary p-5 rounded-3xl">
        <div class="w-[90%] flex justify-around">
            <p class="w-1/6 text-white text-center"><?= htmlspecialchars($product['product_id']) ?></p>
            <p class="w-3/6 text-white text-center"><?= htmlspecialchars($product['product_name']) ?></p>
            <p class="w-2/6 text-white text-center"><?= htmlspecialchars($product['category_id']) ?></p>
            <p class="w-2/6 text-white text-center"><?= htmlspecialchars($product['target_gender']) ?></p>
            <p class="w-2/6 text-white text-center"><?= htmlspecialchars($product['price']) ?></p>
            <p class="w-1/6 text-white text-center"><?= htmlspecialchars($product['is_active']) ? 'Active' : 'Inactive' ?>
            </p>

        </div>
        <div class="relative">
            <button onclick="toggleMenu(event)" class="text-white rounded-full flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </button>
            <div class="menu absolute right-0 mt-2 w-48 bg-natural text-white rounded-lg shadow-lg hidden">
                <a id="" href="" class="block px-4 py-2 text-sm hover:opacity-80">Edit</a>
                <button id="open-variant-modal" class="block px-4 py-2 text-sm hover:opacity-80">Add Variant</button>
                <a href="" class="block px-4 py-2 text-sm hover:opacity-80">Delete</a>
            </div>
        </div>
    </div>


    <script>


    </script>
    <script>
        function toggleMenu(event) {
            event.stopPropagation();
            const menu = event.currentTarget.nextElementSibling;
            menu.classList.toggle('hidden');
            document.addEventListener('click', () => menu.classList.add('hidden'), { once: true });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openModalLink = document.getElementById('open-variant-modal');
            const modal = document.getElementById('varaint-modal');
            const body = document.body;
            const closeModalButton = document.getElementById('close-variant-modal');

            // Function to open the modal
            function openModal() {
                modal.classList.remove('hidden');
                body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.add('hidden');
                body.style.overflow = 'auto';
            }

            // Event listener to open the modal
            openModalLink.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior
                openModal();
            });

            closeModalButton.addEventListener('click', function () {
                closeModal();
            });
        });
    </script>


    <?php
}


