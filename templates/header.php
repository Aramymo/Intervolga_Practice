<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">На главную</a>
    <?php print_r($_SESSION) ?>
    <?php if(empty($_SESSION['AUTHORIZED'])) { ?>
            <a href="/auth" class="home_button">Вход</a>
    <?php } else {?>
        <script> <?php include_once('scripts/logout.js')?></script>
        <a href="/admin_panel/" class="home_button">Админка</a>
        <button onclick="deauthorize()" class="btn home_button">Выход</button>
    <?php } ?>
</div>

<script> <?php include_once('scripts/stickyHeader.js')?></script>