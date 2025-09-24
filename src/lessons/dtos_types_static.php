<?php

class Playlist {
    /**
     * @param Song[] $songs
     */

    public function __construct(public string $name, public array $songs)
    {
        
    }
}

class Song {
    public function __construct(
        public string $name, 
        public string $artist, 
        public string $album,
        public int $releaseDate){

    }
}

$songs = [
    new Song('My Heart Will Go On', 'Celine Dion', 'Titanic', 1996),
    new Song('A Whole New World', 'Alan Menken', 'Aladdin', 1992)
];

$playlist = new Playlist('90s Movie Soundtracks', $songs);

foreach($playlist->songs as $song){
    echo "$song->artist \n";
}