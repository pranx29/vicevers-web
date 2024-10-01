<?php include BASE_URL . '/app/views/components/textinput.php'; ?>

<div class="flex flex-col gap-x-20 py-20">

    <div class="flex justify-between px-20">
        <div class="profile flex gap-x-8">
            <a href="account" class="nav-link text-contentColor1 font-semibold text-4xl">
                MY PROFILE
            </a>
            <a href="account/orders" class="nav-link text-contentColor1 font-semibold text-4xl">
                MY ORDERS
            </a>
        </div>
        <div class="flex items-center">
            <a href="account/logout" class="text-contentColor1 font-semibold text-xs underline">
                LOG OUT
            </a>
        </div>
    </div>

    <div class="flex flex-col gap-y-5">
        <?php require_once BASE_URL . '/app/views/' . $views2 . '.php'; ?>
    </div>
</div>

<script>
    const currentPath = window.location.pathname.split('/Ecommerce/').pop();
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('text-white');
        }
    });
</script>