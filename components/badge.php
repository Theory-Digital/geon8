<div class="badge"
    <?php if($is_empty) { ?>
        style="display:none"<?php }
    ?>
>
    <?php echo $badge_text; ?>
</div>
<style>
    .badge {
        border: solid 1px #EF5822;
        color: #EF5822;
        padding: .5rem 1rem;
        border-radius: 3px;
    }
</style>