<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ApiTopics extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {


//        $data = parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'topic_id' => $this->topic_id,
            'category_id' => $this->category_id,
            'avatar' => $this->avatar,
        ];

    }
}
