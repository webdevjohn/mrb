<?php 

namespace App\Services\SelectBoxes\Pages\CMS;

use App\Services\SelectBoxes\SelectBoxService;

class AlbumsCreateEdit extends SelectBoxService {

    public function get(): array
    {
        return  [
            'genreList' => $this->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray(),

            'labelList' => $this->createFrom('App\Models\Label')
                ->orderBy('label')
                ->display('label')
                ->asArray(),  

            'formatList' => $this->createFrom('App\Models\Format')
                ->orderBy('format')
                ->display('format')
                ->asArray(),
        ];
    }
}
