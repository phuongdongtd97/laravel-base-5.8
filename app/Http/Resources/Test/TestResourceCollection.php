<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/13/2019
 * Time: 2:08 AM
 */

namespace App\Http\Resources\Test;

use Illuminate\Http\Resources\Json\ResourceCollection;


class TestResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return TestResource::collection($this->collection);
    }

    public function with($request)
    {
        return [
            'status' => true,
        ];
    }
}
