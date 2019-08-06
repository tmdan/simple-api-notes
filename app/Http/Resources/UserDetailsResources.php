<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserDetailsResources extends ResourceCollection
{


    public function toArray($request)
    {
        return  UserDetailsResource::collection($this->collection);
    }


    public function with($request){
        return [
            'status'=>1
        ];
    }

}
