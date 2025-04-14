<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Session;

use App\Repositories\Menu\IMenuRepository;
use App\Repositories\GroupUser\IGroupUserRepository;
use App\Helpers\ApiResponse;

class GroupUserController extends Controller {

	protected $menuRepository;
	protected $groupUserRepository;

	public function __construct(IMenuRepository $menuRepository, IGroupUserRepository $groupUserRepository) {
		$this->middleware('auth');
		$this->menuRepository = $menuRepository;
		$this->groupUserRepository = $groupUserRepository;
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
				
		$page_title = "Group User";
		$page_description = "Manage All $page_title";
		$data = array('menu'=>$menu,'page_title'=>$page_title,'page_description'=>$page_description);
		return view('group_user.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$level = \Auth::getUser()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
				
		$page_title = "Group User";
		$page_description = "Add $page_title";
		$data = array('menu'=>$menu,'page_title'=>$page_title,'page_description'=>$page_description);

		return view('group_user.create', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		

	}

	public function edit($id)
	{
		$level = \Auth::getUser()->level;
		$menu = $this->menuRepository->getMenuByLevel($level);
		$group_user = $this->groupUserRepository->findData($id);
		
		$page_title = "Group User";
		$page_description = "Edit $page_title";
		$data = array('menu'=>$menu,'group_user'=>$group_user,'page_title'=>$page_title,'page_description'=>$page_description);

		return view('group_user.edit', $data);	
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,[
			'group' => 'required',
		]);

		$attributes = $request->only([
			'group',
			'description',
		]);

		$attributes['created_by'] = Auth::User()->name;
		$attributes['updated_by'] = Auth::User()->name;
		$attributes['published'] = 0;
		if($request['published2']=='Checked')
			$attributes['published'] = 1;

		$success = $this->groupUserRepository->createData($attributes);
	
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
			'group' => 'required',
		]);

		$attributes = $request->only([
			'group',
			'description',
		]);

		$attributes['created_by'] = Auth::User()->name;
		$attributes['updated_by'] = Auth::User()->name;
		$attributes['published'] = 0;
		if($request['published2']=='Checked')
			$attributes['published'] = 1;
		
		$success = $this->groupUserRepository->updateData($id, $attributes);
		if (!$success)
		{
			return ApiResponse::error(500, 'Error');
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
		$delete = $this->groupUserRepository->deleteData($id);
		if($delete){
			Session::flash('flash_message', 'Succesfully Deleted !');
			return ApiResponse::success(200, 'Success');
		}else {
			return ApiResponse::error(404, 'Data Not Found');
		}
	}
}