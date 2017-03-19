<?php

namespace App\Repositories;


abstract class BaseRepository
{

    abstract public function getModel();

    public function NewQuery()
    {
        return $this->getModel()->newQuery();
    }

    public function getAll()
    {
        return $this->newQuery()->get();
    }

    public function findOrFail( $id )
    {
        return $this->newQuery()->findOrFail($id);
    }


}