<?php

namespace App\Repositories;


interface ContentRepositoryInterface
{
    public function all(array $filters = null);
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
