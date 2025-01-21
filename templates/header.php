<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">На главную</a>
    <?php if(empty($_SESSION['AUTHORIZED'])) { ?>
            <a href="/admin_panel/">SOSAL?</a>
    <?php } else {?>
        <a href="/">Aboba</a>
    <?php } ?>
</div>

<script> <?php include('scripts/stickyHeader.js')?></script>