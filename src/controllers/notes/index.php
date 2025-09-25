<?php

list($config, $username, $password) = require base_path('config.php');
$db = new Database($config, $username, $password);

$notes = $db->query("select * from notes where user_id = 4")->findAll();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);