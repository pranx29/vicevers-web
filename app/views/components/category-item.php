<!-- category-item.php -->
<?php
function renderCategoryRow($category) {
    // Ensure safe output
    $categoryName = htmlspecialchars($category['name']);
    $categoryDescription = htmlspecialchars($category['description']);
    ?>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><?php echo $categoryName; ?></td>
        <td class="px-6 py-4 whitespace-normal text-sm"><?php echo $categoryDescription; ?></td>
    </tr>
    <?php
}
?>
