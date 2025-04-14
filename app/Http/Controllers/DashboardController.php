<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Menu\IMenuRepository;

class DashboardController extends Controller
{
    protected $menuRepository;

    public function __construct(IMenuRepository $menuRepository){
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $level = Auth::User()->level;
        $menu = $this->menuRepository->getMenuByLevel($level);

        $page_title = "Dashboard";
        $page_description = "Control panel";

        $data = array('menu'=>$menu,'page_title'=>$page_title,'page_description'=>$page_description);
        return view('dashboard.index', $data);
    }
}
