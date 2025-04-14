<?php 
namespace App\Repositories\Menu;

use App\Repositories\Menu\IMenuRepository;
use App\Models\Menu;

class MenuRepository implements IMenuRepository
{
    protected $model;

    public function __construct(Menu $model) {
        $this->model = $model;
    }

    public function getMenuByLevel($level) {
        return $this->model->where('is_visible_user_right',-1)
                    ->where("menu_allowed","LIKE", "%$level%")
                    ->orderBy('sequence','ASC')
                    ->get(); ;
    }
}
    


        
