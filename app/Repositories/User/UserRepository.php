<?php 
namespace App\Repositories\User;

use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserRepository implements IUserRepository
{
    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function getAllUser() {
        return $this->model->all();
    }

    public function findData($id) {
        //return $this->model->findOrFail($id);
        return $this->model->where('id', $id)->first();
    }

    public function isEmailUnique($email)
    {
        return $this->model->where('email', $email)->doesntExist();

    }

    public function isEmailUniqueWhenEdit($email, $id)
    {
        return $this->model->Where("email","=",$email)->Where('id','<>',$id)->first();
    }


    public function createData(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function updateData($id, array $attributes)
    {        
        $data = $this->model->find($id);
        if($data){
            $data->update($attributes);
            return true;
        }
        return null;
    }

    public function deleteData($id) 
    {
        $data = $this->model->findOrFail($id);
        if($data){
            $data->delete();
            return true;
        }else {
            return false;
        }
    }
}
    


        
