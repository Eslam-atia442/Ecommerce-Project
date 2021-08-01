<?php


namespace App\Http\interfaces;


interface RepositoryInterfaces
{
    public function index();

    public function create(array $data);

    public function update(array $data ,$id);

    public function store($id);

    public function show($id);


}
