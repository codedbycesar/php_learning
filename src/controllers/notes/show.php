<?php

use Core\Database;

list($config, $username, $password) = require base_path('config.php');
$db = new Database($config, $username, $password);

$currentUserId = 45;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $note = $db->query("select * from notes where id = :id", [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query("delete from notes where id = :id", [
        'id' => $_GET['id']
    ]);

    header('location: /notes');
    exit();

} else {

    $note = $db->query("select * from notes where id = :id", [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    view("notes/show.view.php", [
        'heading' => 'My Note',
        'note' => $note,
    ]);
}
