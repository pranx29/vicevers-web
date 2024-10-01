<?php include BASE_URL . '/app/views/components/textinput.php'; ?>

<div class="flex gap-x-20 justify-center py-20">
    <div class="login-container w-1/3 flex flex-col gap-y-5">
        <h2 class="text-white font-semibold text-4xl">
            LOGIN</h2>
        <form class="flex flex-col gap-y-5" action="" method="POST">
            <div>
                <input type="email" name="email" placeholder="Email Address" required
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-contentColor1 h-10">
            </div>

            <div>
                <input type="password" name="password" placeholder="Password" required
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-contentColor1 h-10">
            </div>

            <div>
                <button type="submit"
                    class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                    LOG IN
                </button>
                <div class="mt-1">
                    <a href="account/forgot-password" class="text-white text-xs">Forgot password?</a>
                </div>
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
    <div class="w-1/3 flex flex-col gap-y-5">
        <h2 class="text-white font-semibold text-4xl">
            NEED AN ACCOUNT?</h2>
        <div class="mt-2">
            <a href="account/register"
                class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full flex justify-center items-center">
                REGISTER
            </a>
        </div>
    </div>
</div>