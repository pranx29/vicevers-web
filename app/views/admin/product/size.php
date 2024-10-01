<div class="w-full h-screen flex justify-center p-10 gap-x-5">
    <!-- Display All Sizes in Table -->
    <div class="w-full h-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Size List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead>
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Size Name</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-contentColor1">Size Label</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once BASE_URL . '/app/views/components/size-item.php';
                foreach ($sizes as $size) {
                    renderSizeItem($size['name'], $size['label']);
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Size Form -->
    <div class="h-full w-full flex items-start">
        <div class="w-full bg-secondary shadow-md rounded-lg p-6">
            <h2 class="text-white font-semibold text-3xl mb-4">ADD SIZE</h2>
            <form action="size/add" method="GET">
                <div class="mb-4">
                    <label for="sizeName" class="block text-sm font-medium text-contentColor1">Size Name</label>
                    <input type="text" id="sizeName" name="sizeName" required class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10">
                </div>
                <div class="mb-4">
                    <label for="sizeLabel" class="block text-sm font-medium text-contentColor1">Size Label</label>
                    <input type="text" id="sizeLabel" name="sizeLabel" required class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                        Add Size
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
