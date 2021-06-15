<?php 

namespace App\Services\SelectBoxes\Groups\CMS\Albums\Tracks;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Tag;
use Webdevjohn\SelectBoxes\SelectBoxService;

class CreateEdit extends SelectBoxService {

    public function get(): array
    {
        return  [
            'artistList' => $this->createFrom(Artist::class)
                ->display('artist_name')
                ->orderBy('artist_name')
                ->asArray(placeHolder: false),

            'genreList' => $this->createFrom(Genre::class)
                ->display('genre')
                ->orderBy('genre')
                ->asArray(),

            'labelList' => $this->createFrom(Label::class)
                ->display('label')
                ->orderBy('label')
                ->asArray(),  

            'tagList' => $this->createFrom(Tag::class)
                ->display('tag')
                ->orderBy('tag')
                ->asArray(placeHolder: false),
        ];
    }
}
