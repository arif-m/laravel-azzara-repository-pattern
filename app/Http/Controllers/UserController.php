<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Session;

use App\Repositories\User\IUserRepository;
use App\Repositories\Menu\IMenuRepository;

use App\Models\GroupUser;
use App\Helpers\ApiResponse;

class UserController extends Controller {

	protected $menuRepository;
	protected $userRepository;

	public function __construct(IMenuRepository $menuRepository, IUserRepository $userRepository){
		$this->middleware('auth');
		$this->menuRepository = $menuRepository;
		$this->userRepository = $userRepository;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$level = Auth::User()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
		
		$page_title = "User";
		$page_description = "Manage All $page_title";
		$data = array('menu'=>$menu,'page_title'=>$page_title,'page_description'=>$page_description);
		return view('user.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$level = Auth::User()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
					
		$group = GroupUser::where('published',1)->pluck('group', 'id');
		
		$page_title = "User";
		$page_description = "Add $page_title";
		$data = array('menu'=>$menu,'group'=>$group, 'page_title'=>$page_title,'page_description'=>$page_description);

		return view('user.create', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$level = Auth::User()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
										
		$user = $this->userRepository->findData($id);
		$page_title = "User";
		$page_description = "Reset Password";
		$data = array('menu'=>$menu,'user'=>$user,'page_title'=>$page_title,'page_description'=>$page_description);
		
		return view('user.show',$data);

	}

	public function edit($id)
	{
		$level = Auth::User()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);					
		$user = $this->userRepository->findData($id);
		$group = GroupUser::where('published',1)->pluck('group', 'id');
		
		$page_title = "User";
		$page_description = "Edit $page_title";
		$data = array('menu'=>$menu,'user'=>$user,'group'=>$group,'page_title'=>$page_title,'page_description'=>$page_description);

		return view('user.edit', $data);	
	}
	
	public function store(Request $request)
	{
		//$attributes = $request->validated();		
		$this->validate($request,[
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'group' => 'required',
			'password' => 'required|confirmed',
		]);

		$attributes = $request->only([
			'name',
			'email',
		]);
		$attributes['level'] = $request->group;
		$attributes['password'] = Hash::make($request['password']);
		$attributes['created_by'] = Auth::User()->name;
		$attributes['updated_by'] = Auth::User()->name;
		$attributes['published'] = 0;
		if($request['published2']=='Checked')
			$attributes['published'] = 1;
		
		$success = $this->userRepository->createData($attributes);
		
		if (!$success)
		{
			return ApiResponse::error(500, 'Error');
		}
		
		Session::flash('flash_message', 'Succesfully Inserted !');
		return ApiResponse::success(201, 'Success', $attributes);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{		
		$this->validate($request,[
			'name' => 'required',
			'email' => 'required|email',
			'group' => 'required',
		]);
				
		$email = $request->email;
		$email = $this->userRepository->isEmailUniqueWhenEdit($email, $id);
		if($email)
		{
			return ApiResponse::error(422, 'Email already exist');
		}

		$attributes = $request->only([
			'name',
			'email',
		]);
		$attributes['level'] = $request->group;
		$attributes['updated_by'] = Auth::User()->name;
		$attributes['published'] = 0;
		if($request['published2']=='Checked')
			$attributes['published'] = 1;

		$success = $this->userRepository->updateData($id, $attributes);
		if(!$success)
		{
			return ApiResponse::error(404, 'Data Not Found');
		}

		Session::flash('flash_message', 'Succesfully Updated !');
		return ApiResponse::success(200, 'Success', $attributes);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$delete = $this->userRepository->deleteData($id);
		if($delete){
			return ApiResponse::success(200, 'Success');
		}else {
			return ApiResponse::error(404, 'Data Not Found');
		}
	}

	public function changePassword(Request $request)
	{
		$this->validate($request,[
			'password' => 'required|confirmed'
		]);
		
		$attributes = $request->only([
			'password',
		]);

		$attributes['password'] = Hash::make($request->password);
		$userData = Auth::user();
		$id = $userData->id;
		$success = $this->userRepository->updateData($id, $attributes);
		
		if (!$success)
		{
			return ApiResponse::error(500, 'Error');
		}
		return ApiResponse::success(200, 'Success', $userData);
	}
	
	public function changePasswordByAdmin(Request $request, $id)
	{
		$this->validate($request,[
			'password' => 'required|confirmed'
		]);

		$attributes = $request->only([
			'password',
		]);

		$attributes['password'] = Hash::make($request->password);
		$userData = $this->userRepository->findData($id);
		$id = $userData->id;
		$success = $this->userRepository->updateData($id, $attributes);
		
		if (!$success)
		{
			return ApiResponse::error(500, 'Error');
		}
		return ApiResponse::success(200, 'Success', $userData);
	}
	
	public function changeImage(Request $request)
	{				
		$userData = Auth::user();
		$id = $userData->id;

		$attributes['file_path'] = $request->file_path;
		$attributes['file_name'] = $request->file_name;

		$old_file_name = $request->file_name2;
		if($old_file_name)
			unlink(public_path('/'.$request->file_path.'/'.$old_file_name));

		$success = $this->userRepository->updateData($id, $attributes);

		if (!$success)
		{
			return ApiResponse::error(500, 'Error');
		}
		return ApiResponse::success(200, 'Success', $attributes);
	}	
}