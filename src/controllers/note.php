<?php

list($config, $username, $password) = require('config.php');
$db = new Database($config, $username, $password);

$heading = "Note";

$currentUserId = 4;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->fetch();

if ($note['user_id'] != $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";