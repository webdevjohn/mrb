<?php 

namespace App\Services\SelectBoxes\Groups\CMS\Albums;

use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use Webdevjohn\SelectBoxes\SelectBoxService;

class CreateEdit extends SelectBoxService {

    public function get(): array
    {
        return  [
            'genreList' => $this->createFrom(Genre::class)
                ->display('genre')
                ->orderBy('genre')
                ->asArray(),

            'labelList' => $this->createFrom(Label::class)
                ->display('label')
                ->orderBy('label')
                ->asArray(),  

            'formatList' => $this->createFrom(Format::class)
                ->display('format')
                ->orderBy('format')
                ->asArray(),
        ];
    }
}
