<?php

namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;


class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $Comments
    ) {}

    public function listAll()
    {
        return $this->Comments->all();
    }

    public function findById(int $id)
    {
        return $this->Comments->find($id);
    }

    public function create(array $data)
    {
        return $this->Comments->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->Comments->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->Comments->delete($id);
    }
}
