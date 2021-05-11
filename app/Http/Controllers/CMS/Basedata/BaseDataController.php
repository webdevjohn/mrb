<?php

namespace App\Http\Controllers\CMS\Basedata;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BaseDataController extends Controller
{    
    public function index()
    {
        $results = DB::select(
            "SELECT (SELECT COUNT(*) FROM albums) as albums, 
            (SELECT COUNT(*) FROM artists) as artists, 
            (SELECT COUNT(*) FROM formats) as formats,
            (SELECT COUNT(*) FROM genres) as genres,
            (SELECT COUNT(*) FROM labels) as labels,
            (SELECT COUNT(*) FROM playlists) as playlists,
            (SELECT COUNT(*) FROM tags) as tags,
            (SELECT COUNT(*) FROM tracks) as tracks
            "
        );

        return View('cms.basedata.index', [
            'recordCount' => $results['0']
        ]);
    }
}
