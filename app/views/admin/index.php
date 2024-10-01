<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>
<main class="ml-80 mt-24 h-screen">
    <?php
            if (isset($views)) {
                require_once BASE_URL . '/app/views/' . $views . '.php';
            }
        ?>
</main>
<?php include 'partials/footer.php'; ?>


