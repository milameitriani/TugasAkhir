<?php 

namespace App\Repositories;

interface RepositoryInterface
{

    public function get(): Object;

    public function create(array $data): Object;

    public function find(int $id): Object;

    public function update(int $id, array $data);

    public function delete(int $id): Void;

    public function count(): Int;

}

 ?>