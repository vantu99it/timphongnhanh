<div class="page-division">
    <!-- Trang đầu -->
    <?php if ($current_page > 1){
        $first_page = 1;
        ?>
        <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$first_page?>">Trang đầu</a>
    <?php }
    // prev
    if ($current_page > 1){
        $prev_page = $current_page - 1;
    ?>
    <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$prev_page?>"><i class="fa-solid fa-angles-left"></i></a>
    <?php } ?>

    <!-- các trang -->
    <?php for ($num = 1; $num <= $totalPages  ; $num++) { ?>
        <?php if ($num != $current_page){?>
        <?php if ($num > $current_page - 2 && $num <$current_page + 2){?>
            <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
        <?php }}else{ ?>
            <strong  class="page-item current_page"><?=$num?></strong>
        <?php } ?>
    <?php } ?>
    <!-- Trang cuối -->
    <?php if ($current_page < $totalPages - 1){
        $next_page = $current_page + 1;
    ?>
        <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$next_page?>"><i class="fa-solid fa-angles-right"></i></a>
    <?php } 
        if ($current_page < $totalPages - 1){
        $end_page = $totalPages;
        ?>
        <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$end_page?>">Trang cuối</a>
    <?php } ?>
</div>