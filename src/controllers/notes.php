<?php

list($config, $username, $password) = require('config.php');
$db = new Database($config, $username, $password);

$heading = "Notes";

$notes = $db->query("select * from notes where user_id = 4")->fetchAll();

require "views/notes.view.php";