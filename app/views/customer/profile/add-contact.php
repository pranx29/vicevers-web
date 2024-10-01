<div class="w-full flex justify-center items-center p-10">
    <div class="w-full max-w-lg bg-secondary shadow-md rounded-lg p-6">
        <h2 class="text-white font-semibold text-3xl mb-4">Add Address</h2>
        <form id="add-address-form"
            action="<?= HOME_URL ?>/addresses/add?userId=<?= htmlspecialchars($user['user_id']) ?>"
            method="post" enctype="multipart/form-data">

            <!-- Error Container -->
            <?php if (isset($error) && !empty($error)): ?>
                <div id="error-container" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Street Address -->
            <div class="my-4">
                <label for="street" class="block text-sm font-medium text-contentColor1">Street</label>
                <input type="text" id="street" name="street" required
                    class="block border border-white px-2 py-1 bg-natural text-white rounded w-full outline-none placeholder-contentColor1"
                    placeholder="Enter street address" />
            </div>

            <!-- City -->
            <div class="my-4">
                <label for="city" class="block text-sm font-medium text-contentColor1">City</label>
                <input type="text" id="city" name="city" required
                    class="block border border-white px-2 py-1 bg-natural text-white rounded w-full outline-none placeholder-contentColor1"
                    placeholder="Enter city" />
            </div>

            <!-- Postal Code -->
            <div class="my-4">
                <label for="postal_code" class="block text-sm font-medium text-contentColor1">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" required
                    class="block border border-white px-2 py-1 bg-natural text-white rounded w-full outline-none placeholder-contentColor1"
                    placeholder="Enter postal code" />
            </div>

            <!-- Phone Number -->
            <div class="my-4">
                <label for="phone_number" class="block text-sm font-medium text-contentColor1">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required
                    class="block border border-white px-2 py-1 bg-natural text-white rounded w-full outline-none placeholder-contentColor1"
                    placeholder="Enter phone number" />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-5">
                <button type="submit" class="bg-white text-black px-10 py-2 rounded-full">ADD ADDRESS</button>
            </div>
        </form>
    </div>
</div>