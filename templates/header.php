<div class="sticky-header" id="sticky_header">
    <a href="/" class="header_button">На главную</a>
    <div id="pages"></div>
    <?php if(empty($_SESSION['AUTHORIZED'])) { ?>
            <a href="/auth" class="header_button">Вход</a>
    <?php } else {?>
        <script> <?php include_once('scripts/logout.js')?></script>
        <div>
            <a href="/admin_panel/" class="header_button">Админка</a>
            <button onclick="deauthorize()" class="header_button">Выход</button>
        </div>
    <?php } ?>
</div>

<script> <?php include_once('scripts/stickyHeader.js')?></script>