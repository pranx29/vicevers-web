<!-- color-item.php -->
<?php
function renderColorItem($name, $hex)
{
    // Make sure the values are safely displayed
    $colorName = htmlspecialchars($name);
    $colorHex = htmlspecialchars($hex);
    ?>
    <tr>
        <td class="px-6 py-2 whitespace-nowrap text-sm font-medium"><?php echo $colorName; ?></td>
        <td class="px-6 py-2 whitespace-nowrap text-sm"><?php echo $colorHex; ?></td>
        <td class="px-6 py-2 whitespace-nowrap">
            <div class="w-6 h-6 rounded-sm ml-4"
                style="background-color: <?= htmlspecialchars($colorHex) ?>;"></div>
        </td>
    </tr>
    <?php
}
?>