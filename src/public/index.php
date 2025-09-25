<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';

spl_autoload_register(function ($class) {
    require base_path("Core/{$class}.php");
});

require base_path('router.php');

// $id = $_GET['id'];
// $query = "SELECT id, post FROM posts WHERE id = :id";

// $posts = $db->query($query, [':id' => $id])->fetch();

// dd($posts);

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

// class MailjetProvider implements NewsletterProvider {
//     public function addToList(string $list, string $email): void {
        
//         $cm = new PostmarkApi();

//         $cm->addApiKey('asdgsadgasdg');

//         $list = $cm->lists->find($list);

//         $list->addToList($email);

//     }
// }

// $newsletter = new Newsletter(
//     new MailjetProvider()
// );

// $newsletter->subscribe(new User('cesar','cesar@example.com'));