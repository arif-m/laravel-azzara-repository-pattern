<?php 
namespace App\Repositories\GroupUser;

use App\Repositories\GroupUser\IGroupUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\GroupUser;

class GroupUserRepository implements IGroupUserRepository 
{
    protected $model;

    public function __construct(GroupUser $model) {
        $this->model = $model;
    }

    public function getAllGroup(){
        return $this->model->all();
    }
    public function findData($id) {
        return $this->model->findOrFail($id);
        //return $this->model->where('id', $id)->first();
    }

    public function createData(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function updateData($id, array $attributes)
    {
        $groupUser = $this->model->find($id);
        if($groupUser) {
            $groupUser->update($attributes);
            return true;
        }
        return null;
    }

    public function deleteData($id){
        $deleteData = $this->model->findOrFail($id);
        if($deleteData){
            $deleteData->delete();
            return true;
        }else {
            return false;
        }
    }
}
    


        
