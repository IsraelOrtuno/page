<?php

namespace Devio\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'slug' => $this->slug ?? '',
            'meta' => [
                'title'       => $this->meta->title ?? '',
                'description' => $this->meta->description ?? '',
                'canonical'   => $this->meta->canonical ?? '',
                'robots'      => $this->meta->robots ?? []
            ],
        ];
    }
}