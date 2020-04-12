<?php


namespace App\Http\Controllers\Api\v1;




use App\Http\Controllers\Controller;
use App\Models\Label;

class LabelsController extends Controller
{
    /**
     * 获取标签list
     */
    public function show()
    {
       $label = Label::all();
       return json_encode($label->toArray());
    }
}
