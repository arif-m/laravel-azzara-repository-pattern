<?php
namespace App\Repositories\User;
use App\Models\User;

interface IUserRepository
{
    public function findData($id);
    //public function isEmailUnique($email);
    public function isEmailUniqueWhenEdit($email, $id);
    public function createData(array $attributes);
    public function deleteData($id);
    public function updateData($id, array $attributes);
}