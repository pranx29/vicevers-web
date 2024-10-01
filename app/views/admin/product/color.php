<div class="w-full h-screen flex justify-center p-10 gap-x-5">
    <!-- Display All Colors in Table -->
    <div class="w-full h-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Color List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead class="">
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Color Name</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-contentColor1">Hex Code</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-contentColor1">Preview</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                require_once BASE_URL . '/app/views/components/color-item.php';
                foreach ($colors as $color) {
                    renderColorItem($color['name'], $color['code']);
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Add Color Form -->
    <div class="h-full w-full flex items-start">
        <div class="w-full bg-secondary shadow-md rounded-lg p-6">
            <h2 class="text-white font-semibold text-3xl mb-4">ADD COLOR</h2>
            <form action="color/add" method="GET">
                <div class="mb-4">
                    <label for="colorName" class="block text-sm font-medium text-contentColor1">Color Name</label>
                    <input type="text" id="colorName" name="colorName" required class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10">
                </div>
                <div class="mb-4">
                    <label for="colorHex" class="block text-sm font-medium text-contentColor1">Hex Code</label>
                    <input type="text" id="colorHex" name="colorHex" required class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10" placeholder="#000000"
                        pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" title="Please enter a valid hex code">>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                        Add Color
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>