<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all(array $relations = []);
    public function find(int $id, array $relations = []);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
