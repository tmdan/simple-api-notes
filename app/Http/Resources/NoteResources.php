<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteResources extends ResourceCollection
{



    public function toArray($request)
    {
        return  NoteResource::collection($this->collection);
    }


    public function with($request){
        return [
            'status'=>1
        ];
    }

}
