<?php

namespace App\Services;

use App\Repositories\Interfaces\LabelRepositoryInterface;



class LabelService
{
    public function __construct(
        protected LabelRepositoryInterface $Labels
    ) {}

    public function listAll()
    {
        return $this->Labels->all();
    }

    public function findById(int $id)
    {
        return $this->Labels->find($id);
    }

    public function create(array $data)
    {
        return $this->Labels->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->Labels->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->Labels->delete($id);
    }
}
