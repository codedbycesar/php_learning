<?php

list($config, $username, $password) = require base_path('config.php');
$db = new Database($config, $username, $password);

$currentUserId = 4;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'heading' => 'My Note',
    'note' => $note,
]);