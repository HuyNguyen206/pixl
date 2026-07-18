<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $data['created_at'] = $this->created_at->diffForHumans();
        $data['can_delete'] = \Auth::user()->can('delete', $this->resource);

        if ($this->parentRepost) {
            $data['parent_repost']['created_at'] = $this->parentRepost->created_at->diffForHumans();
        }

        return $data;
    }
}
