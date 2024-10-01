<?php include BASE_URL . '/app/views/components/textinput.php'; ?>

<div class="flex gap-x-20 justify-center py-20">
    <div class="register-container w-1/3 flex flex-col gap-y-5">
        <div class="flex flex-col gap-y-3">
            <h2 class="text-white font-semibold text-4xl">
                CREATE AN ACCOUNT</h2>
            <h3 class="text-white font-thin text-3xl">PERSONAL DETAILS</h3>
        </div>
        <form class="flex flex-col gap-y-5 " action="" method="POST">
            <div class="flex flex-wrap justify-between gap-5">
                <div>
                    <label for="fname" class="block text-sm font-medium text-contentColor1">First Name</label>
                    <input type="text" name="fname" required value="<?= isset($fname) ? htmlspecialchars($fname) : '' ?>"
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
                <div>
                    <label for="lname" class="block text-sm font-medium text-contentColor1">Last Name</label>
                    <input type="text" name="lname" value="<?= isset($lname) ? htmlspecialchars($lname) : '' ?>" 
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-contentColor1">Email</label>
                <input type="email" name="email"  required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-contentColor1">Password</label>
                <input type="password" name="password" minlength="5" required value="<?= isset($password) ? htmlspecialchars($password) : '' ?>"
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>
            <div>
                <button type="submit"
                    class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                    CREATE ACCOUNT
                </button>
            </div>
        </form>
        <?php if (isset($error)): ?>
            <div class="flex justify-center items-center gap-x-2 p-5">
                <div class="text-white">
                    <svg class="" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        focusable="false">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3ZM1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM13.25 17.25C13.25 17.9404 12.6904 18.5 12 18.5C11.3096 18.5 10.75 17.9404 10.75 17.25C10.75 16.5596 11.3096 16 12 16C12.6904 16 13.25 16.5596 13.25 17.25ZM13 15V6H11V15H13Z">
                        </path>
                    </svg>
                </div>
                <span class="text-white"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>