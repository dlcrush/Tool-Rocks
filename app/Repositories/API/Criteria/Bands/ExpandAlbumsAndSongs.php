<?php

namespace App\Repositories\API\Criteria\Bands;

use App\Repositories\API\Criteria\Criteria;
use App\Repositories\API\Contracts\Repository;

class ExpandAlbumsAndSongs extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->with('albums.songs');
        return $query;
    }

}
