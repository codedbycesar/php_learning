<?php

require 'functions.php';
// require 'router.php';
require 'Database.php';

list($config, $username, $password) = require('config.php');

$db = new Database($config, $username, $password);

$id = $_GET['id'];
$query = $db->query("SELECT id, post FROM posts WHERE id = {$id}");

dd($query);

$posts = $query ? $query->fetchAll() : [];


// class User {
//     public function __construct(public string $name, public string $email){

//     }

//     public function update(){

//     }
// }

// class Newsletter {

//     public function __construct(public NewsletterProvider $provider){

//     }

//     public function subscribe(User $user){

//         $this->provider->addToList('default', $user->email);

//         $user->update(['subscribed' => true]);
//     }
// }

// interface NewsletterProvider {
//     public function addToList(string $list, string $email): void;
// }

// class PostmarkProvider implements NewsletterProvider {
//     public function addToList(string $list, string $email): void {
        
//         $cm = new PostmarkApi();

//         $cm->addApiKey('asdgsadgasdg');

//         $list = $cm->lists->find($list);

//         $list->addToList($email);

//     }
// }

// $newsletter = new Newsletter(
//     new PostmarkProvider()
// );

// $newsletter->subscribe(new User('cesar','cesar@example.com'));