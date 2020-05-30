<?php

namespace App\Repositories\Test;

use App\Repositories\Base\RepositoryEloquent;

class TestRepositoryEloquent extends RepositoryEloquent implements TestRepository
{
    public function getModel()
    {
        return \App\Models\Test::class;
    }

    public function handleFilter($select, $name = null)
    {
        return $this->makeSimpleQuery($select)->when($name != null, function ($query) use ($name) {
            return $query->where('name', 'like', "%{$name}%");
        });
    }
}
