<div class="w-full h-screen flex justify-center p-10 gap-x-5">
    <!-- Display All Categories in Table -->
    <div class="w-full h-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Category List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead class="border-b border-contentColor1">
                <tr>
                    <th class="px-6 py-3 whitespace-nowrap text-left text-md font-semibold text-contentColor1">Category
                        Name</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Description</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                require_once BASE_URL . '/app/views/components/category-item.php';
                foreach ($categories as $category) {
                    renderCategoryRow($category);
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Add Category Form -->
    <div class="h-full w-full flex items-start">
        <div class="w-full bg-secondary shadow-md rounded-lg p-6">
            <h2 class="text-white font-semibold text-3xl mb-4">ADD CATEGORY</h2>
            <form action="category/add" method="GET">
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-contentColor1">Category Name</label>
                    <input type="text" id="categoryName" name="categoryName" required class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10">
                </div>
                <div class="mb-4">
                    <label for="categoryDescription" class="block text-sm font-medium text-contentColor1">Category
                        Description</label>
                    <textarea id="categoryDescription" name="categoryDescription" rows="3" class="mt-1 block w-full
                        rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none
                        placeholder-contentColor1 h-10" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

</div>