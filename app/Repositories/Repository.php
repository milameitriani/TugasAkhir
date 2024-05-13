<?php 

namespace App\Repositories;

abstract class Repository implements RepositoryInterface
{

    public $model;

    public function __construct()
    {
        $this->setModel();
    }

    private function setModel(): Void
    {
        $this->model = app()->make($this->getModel());
    }

    abstract protected function getModel(): String;

    public function get(): Object
    {
        return $this->model->get();
    }

    public function create(array $data): Object
    {
        return $this->model->create($data);
    }

    public function find(int $id): Object
    {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        
        $model->update($data);

        return $model;
    }

    public function delete(int $id): Void
    {
        $this->find($id)->delete();
    }

    public function count(): Int
    {
        return $this->model->count();
    }

}

 ?>