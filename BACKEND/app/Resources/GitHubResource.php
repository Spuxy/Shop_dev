<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GitHubResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'is_private' => $this->private
        ];
    }
}
