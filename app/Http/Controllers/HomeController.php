<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Menu\IMenuRepository;
use App\Repositories\User\IUserRepository;

class HomeController extends Controller
{
	protected $menuRepository;
	protected $userRepository;

    public function __construct(IMenuRepository $menuRepository, IUserRepository $userRepository){
        $this->menuRepository = $menuRepository;
		$this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('home');
    }
    public function profile()
	{	
		$level = \Auth::getUser()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
		
		$page_title = "User Profile";
		$page_description = "Display $page_title";
		$data = array('menu'=>$menu,'page_title'=>$page_title,'page_description'=>$page_description);

		return view('profile', $data); 
	}
	
	public function change_password()
	{	
        $level = \Auth::getUser()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
		$user = $this->userRepository->getAllUser();
		
		$page_title = "Change Password";
		$page_description = "Form $page_title";
		$data = array('menu'=>$menu,'user'=>$user,'page_title'=>$page_title,'page_description'=>$page_description);

		return view('change_password', $data); 
	}	
}
