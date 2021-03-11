<?php 

namespace App\Repositories\CMS;

use App\Repositories\ArtistRepository;
use Illuminate\Support\Str;

class CMSArtistRepository extends ArtistRepository {

    public function update(int $id, array $postData) 
	{
        $model = $this->model->find($id);          
        $this->saveArtist($model, $postData);

        return $model;
	}

	public function store(array $postData) 	
	{
        return $this->saveArtist($this->model, $postData);
	}

    protected function saveArtist($model, $postData = [])
    {
        $model->artist_name = $postData['artist_name'];
        $model->slug = str::slug($postData['artist_name'], '-');
        return $model->save();
    }

}