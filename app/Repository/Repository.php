<?php


namespace App\Repository;
use App\Http\interfaces\RepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterfaces
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        return $this->model->all();    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function store($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
// this for relations
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
