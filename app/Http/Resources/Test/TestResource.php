<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/13/2019
 * Time: 2:05 AM
 */

namespace App\Http\Resources\Test;

use App\TraitHelpers\DateTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    use DateTrait;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->handleDateToString($this->created_at, 'H:i d-m-Y'),
        ];
    }

}
