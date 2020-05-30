<?php

namespace App\Repositories\Base;

abstract class RepositoryEloquent implements RepositoryInterface
{

    protected $_model;

    /**
     * RepositoryEloquent constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    public function makeSimpleQuery($select)
    {
        return $this->_model->select($select);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $maps, array $attributes)
    {
        return $this->_model->firstOrCreate($maps, $attributes);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * @param $mapping
     * @param array $params
     * @return mixed
     */
    public function updateOrCreate($mapping, array $attributes)
    {
        return $this->_model->updateOrCreate($mapping, $attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * @param $condition
     * @return mixed
     */
    public function findByCondition($condition)
    {
        $result = $this->_model->where($condition)->first();
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        $result = $this->_model->findOrFail($id);
        return $result;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function insertGetId(array $attributes)
    {
        return $this->_model->insertGetId($attributes);
    }

    /**
     * @param $ids
     * @param array $attributes
     * @return mixed
     */
    public function updateInIds($ids, array $attributes)
    {
        return $this->_model->whereIn('id', $ids)->update($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function updateByCondition(array $condition, array $attributes)
    {
        return $this->_model->where($condition)->update($attributes);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $isDel = $result->delete();
            return $isDel;
        }

        return false;
    }

    /**
     * @param null $limit
     * @param array $columns
     * @param string $method
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->_model->{$method}($limit, $columns);
        return $results->appends(app('request')->query());
    }

    /**
     * Retrieve all data of repository, simple paginated
     *
     * @param null $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->paginate($limit, $columns, "simplePaginate");
    }

    public function getByParentId($parentKey, $parentId, $select = ['*'])
    {
        return $this->_model->select($select)->where($parentKey, $parentId)->get();
    }

    public function getByFieldLike($field, $value, $select = ['*'])
    {
        return $this->_model->select($select)->where($field, 'LIKE', "%$value%")->get();
    }
}
