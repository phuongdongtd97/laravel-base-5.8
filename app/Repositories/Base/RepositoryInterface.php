<?php

namespace App\Repositories\Base;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function findByCondition($condition);

    public function findOrFail($id);

    public function create(array $attributes);

    public function insertGetId(array $attributes);

    public function insert(array $attributes);

    public function update($id, array $attributes);

    public function updateByCondition(array $condition, array $attributes);

    public function updateInIds($ids, array $attributes);

    public function updateOrCreate($maps, array $attributes);

    public function firstOrCreate(array $maps, array $attributes);

    public function delete($id);

    public function paginate($limit = null, $columns = ['*'], $method = "paginate");

    public function simplePaginate($limit = null, $columns = ['*']);

    public function makeSimpleQuery($select);

    public function getByParentId($parentKey, $parentId, $select = ['*']);

    public function getByFieldLike($field, $value, $select = ['*']);
}
