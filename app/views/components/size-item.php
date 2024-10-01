<!-- size-item.php -->
<?php
function renderSizeItem($sizeName, $sizeLabel) {
    // Ensure safe output
    $sizeName = htmlspecialchars($sizeName);
    $sizeLabel = htmlspecialchars($sizeLabel);
    ?>
    <tr class=""> <!-- Optional: Add separator -->
        <td class="px-6 py-4 whitespace-normal text-sm"><?php echo $sizeName; ?></td>
        <td class="px-6 py-4 whitespace-normal text-sm"><?php echo $sizeLabel; ?></td>
    </tr>
    <?php
}
?>
