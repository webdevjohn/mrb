<?php 

namespace App\Services\SelectBoxes\Pages\CMS;

use App\Services\SelectBoxes\SelectBoxService;

class AlbumsTracksCreateEdit extends SelectBoxService {

    public function get(): array
    {
        return  [
            'artistList' => $this->createFrom('App\Models\Artist')
                ->orderBy('artist_name')
                ->display('artist_name')
                ->asArray(placeHolder: false),

            'genreList' => $this->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray(),

            'labelList' => $this->createFrom('App\Models\Label')
                ->orderBy('label')
                ->display('label')
                ->asArray(),  

            'tagList' => $this->createFrom('App\Models\Tag')
                ->orderBy('tag')
                ->display('tag')
                ->asArray(placeHolder: false),
        ];
    }
}
