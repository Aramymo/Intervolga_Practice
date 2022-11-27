<?php
    use App\SQLiteConnection;
    use App\SQLiteQuery;
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $reviews = $sqlite->getAllWithoutPages();
?>