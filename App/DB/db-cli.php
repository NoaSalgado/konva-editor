<?php

declare(strict_types=1);

require __DIR__ . '/Database.php';

$dbConfig = require __DIR__ . '/db-config.php';
extract($dbConfig);
$db = new Database($dbConfig);
$queries = explode(";", file_get_contents(__DIR__ . '/db.sql'));

foreach ($queries as $query) {
    $db->query($query);
}
