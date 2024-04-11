<?php

declare(strict_types=1);

require __DIR__ . '/Database.php';

$db = new Database();
$queries = explode(";", file_get_contents(__DIR__ . '/db.sql'));

foreach ($queries as $query) {
    $db->query($query);
}
