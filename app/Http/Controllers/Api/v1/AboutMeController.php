<?php


namespace App\Http\Controllers\Api\v1;


use App\Models\AboutMeModel;

class AboutMeController
{
    public function index(AboutMeModel $aboutMeModel)
    {
        $about = $aboutMeModel->first();
        return json_encode($about,JSON_UNESCAPED_UNICODE);
    }
}
