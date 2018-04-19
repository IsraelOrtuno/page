<?php

namespace Devio\Seo;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'meta' => [
                'title'       => $this->meta->title ?? '',
                'description' => $this->meta->description ?? '',
                'canonical'   => $this->meta->canonical ?? '',
                'robots'      => $this->meta->robots ?? []
            ],
        ];
    }
}