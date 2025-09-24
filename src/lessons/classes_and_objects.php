<?php
declare(strict_types=1);

class Playlist {
    public string $name;
    /**
     * @var list<string>
     */
    public array $songs;

    /**
     * @param list<string> $songs
     */
    public function __construct(string $name, array $songs){
        $this->name = $name;
        $this->songs = $songs;
    }

    public function addSong(string $song): void {
        $this->songs[] = $song;
    }

    public function shuffle(): void {
        shuffle($this->songs);
    }
}

$playlist = [];
$playlist[] = new Playlist('80s Headbangers', ['Back in Black', 'Are You Ready', 'Highway to Hell']);

$playlist[0]->shuffle();
$playlist[0]->addSong('Thunderstruck');

var_dump($playlist);
exit;