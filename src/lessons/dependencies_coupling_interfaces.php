<?php

class User {
    public function __construct(public string $name, public string $email){

    }
}

class Newsletter {
    public function subscribe(User $user){

    }
}


$newsletter = new Newsletter();
$newsletter->subscribe(new User('Cesar', 'test@test.com'));

var_dump($newsletter);