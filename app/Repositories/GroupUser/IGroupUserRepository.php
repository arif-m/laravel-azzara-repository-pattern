<?php
namespace App\Repositories\GroupUser;
use App\Models\GroupUser;

interface IGroupUserRepository
{
    public function findData($id);
    public function createData(array $attributes);
    public function deleteData($id);
    public function updateData($id, array $attributes);
}