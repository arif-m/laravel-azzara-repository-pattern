<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//system
use App\Repositories\User\IUserRepository;
use App\Repositories\GroupUser\IGroupUserRepository;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
	protected $userRepository;
	protected $groupUserRepository;

	public function __construct(IUserRepository $userRepository, IGroupUserRepository $groupUserRepository){
		$this->userRepository = $userRepository;
		$this->groupUserRepository = $groupUserRepository;
	}	

	public function getDataGroupUser()
	{
		$groupUser = $this->groupUserRepository->getAllGroup();
		return Datatables::of($groupUser)->make(true);
	}

	public function getDataUser()
	{
		$user = $this->userRepository->getAllUser();
		return Datatables::of($user)->make(true);
	}
}
