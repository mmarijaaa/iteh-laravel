<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public static $wrap = 'book';
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id'=>$this->resource->id,
            'name'=>$this->resource->name,
            'author'=>new AuthorResource($this->resource->author),
            'genre'=>new GenreResource($this->resource->genre),
            'description'=>$this->resource->description,
            'user'=>new UserResource($this->resource->user)

        ];
    }
}
