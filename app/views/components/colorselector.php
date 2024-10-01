<!-- color-picker.php -->
<?php

function renderColorPicker($colors = [], $availableColors = []) {
    ?>
    <div class="my-4 p-4 bg-gray-800 rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <label for="color-picker" class="text-white text-lg font-semibold">Color</label>
            <button id="add-color-btn" class="flex items-center bg-gray-600 hover:bg-gray-700 text-white rounded-md p-2">
                <img src="assets/images/add.svg" alt="color-picker" class="w-6 h-6" />
                <span class="ml-2 text-sm">Add Color</span>
            </button>
        </div>

        <!-- Popup Menu -->
        <div id="color-popup" class="absolute bg-gray-900 border border-gray-600 rounded-md p-4 hidden shadow-lg z-50">
            <ul class="space-y-2">
                <?php foreach ($availableColors as $color) : ?>
                    <li>
                        <button class="color-option text-white w-full text-left p-2 hover:bg-gray-700 rounded-md" data-color="<?php echo htmlspecialchars($color['name']); ?>">
                            <?php echo htmlspecialchars($color['name']); ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div id="color-list" class="bg-gray-700 border-2 border-gray-600 rounded-md p-4 space-y-6">
            <?php foreach ($colors as $color) : ?>
                <div class="color-section space-y-4" data-color-id="<?php echo htmlspecialchars($color['id']); ?>">
                    <div class="flex items-center space-x-4">
                        <span class="text-white font-medium"><?php echo htmlspecialchars($color['name']); ?></span>
                        <div class="flex items-center space-x-2">
                            <input type="file" name="image_<?php echo htmlspecialchars($color['id']); ?>" id="color_image_<?php echo htmlspecialchars($color['id']); ?>" class="hidden" />
                            <label for="color_image_<?php echo htmlspecialchars($color['id']); ?>" class="cursor-pointer text-gray-400 hover:text-white">
                                <img src="assets/images/upload.svg" alt="upload" class="w-6 h-6" />
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <?php foreach ($color['swatches'] as $swatch) : ?>
                            <div class="p-2 bg-white rounded-md">
                                <img src="<?php echo htmlspecialchars($swatch); ?>" alt="<?php echo htmlspecialchars($color['name']); ?>" class="w-20 h-20 object-cover" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addColorBtn = document.getElementById('add-color-btn');
            const colorPopup = document.getElementById('color-popup');
            const colorList = document.getElementById('color-list');

            addColorBtn.addEventListener('click', function () {
                const rect = addColorBtn.getBoundingClientRect();
                colorPopup.style.top = `${rect.bottom + window.scrollY}px`;
                colorPopup.style.left = `${rect.left + window.scrollX}px`;
                colorPopup.classList.toggle('hidden');
            });

            colorPopup.addEventListener('click', function (event) {
                if (event.target.classList.contains('color-option')) {
                    const colorName = event.target.dataset.color;
                    // Create a new color section
                    const colorId = 'color_' + new Date().getTime();
                    const newColorSection = `
                        <div class="color-section space-y-4" data-color-id="${colorId}">
                            <div class="flex items-center space-x-4">
                                <span class="text-white font-medium">${colorName}</span>
                                <div class="flex items-center space-x-2">
                                    <input type="file" name="image_${colorId}" id="color_image_${colorId}" class="hidden" />
                                    <label for="color_image_${colorId}" class="cursor-pointer text-gray-400 hover:text-white">
                                        <img src="assets/images/upload.svg" alt="upload" class="w-6 h-6" />
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-4">
                                <!-- Placeholder for new swatches -->
                            </div>
                        </div>
                    `;
                    colorList.insertAdjacentHTML('beforeend', newColorSection);
                    colorPopup.classList.add('hidden'); // Hide the popup after selection
                }
            });

            // Close the popup if clicking outside of it
            document.addEventListener('click', function (event) {
                if (!colorPopup.contains(event.target) && event.target !== addColorBtn) {
                    colorPopup.classList.add('hidden');
                }
            });
        });
    </script>
    <?php
}
?>
