<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectRepositoryInterface;




class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $projects
    ) {}

    public function listAll()
    {
        return $this->projects->all();
    }

    public function findById(int $id)
    {
        return $this->projects->find($id);
    }

    public function create(array $data)
    {
        return $this->projects->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->projects->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->projects->delete($id);
    }
}
