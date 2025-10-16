<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;




class UserService
{
    public function __construct(
        protected UserRepositoryInterface $Users
    ) {}

    public function listAll()
    {
        return $this->Users->all();
    }

    public function findById(int $id)
    {
        return $this->Users->find($id);
    }

    public function create(array $data)
    {
        return $this->Users->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->Users->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->Users->delete($id);
    }
}
