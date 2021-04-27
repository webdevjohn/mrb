<?php

use App\Services\SelectBoxes\Pages\CMS\AlbumsCreateEdit;
use App\Services\SelectBoxes\Pages\CMS\AlbumsTracksCreateEdit;
use App\Services\SelectBoxes\Pages\CMS\TracksCreateEdit;

return [
    'cms.albums.create' => AlbumsCreateEdit::class,
    'cms.albums.edit' => AlbumsCreateEdit::class,

    'cms.albums.tracks.create' => AlbumsTracksCreateEdit::class,
    'cms.albums.tracks.edit' => AlbumsTracksCreateEdit::class,
    
    'cms.tracks' => TracksCreateEdit::class
];
