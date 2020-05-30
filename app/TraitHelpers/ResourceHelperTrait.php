<?php

namespace App\TraitHelpers;

trait ResourceHelperTrait
{
  public function handlePaginate($resource, $path = null, $appends = [], $limit = 10, $method = "paginate")
  {
    try {
      return $resource->{$method}($limit)->appends($appends)->withPath($path);
    } catch (\Exception $exception) {
      return null;
    }
  }

  public function handleLoadRelations($resource, $relationships = [])
  {
    if (empty($relationships))
      return $resource;
    foreach ($relationships as $relationship => $select) {
      $resource->load([$relationship => function ($relation) use ($select) {
        $relation->select($select);
      }]);
    }
    return $resource;
  }

}
