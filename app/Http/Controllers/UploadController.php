<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Session;

/*
use Response;
use URL;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
*/

class UploadController extends Controller {
	
	public function index()
	{
		
	}
	
	public function FileProfileUpload(Request $request)
	{
		$request->validate([
            'uploadPhoto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $fileName = time().'.'.$request->uploadPhoto->extension();

        // Public Folder
        $request->uploadPhoto->move(public_path('images'), $fileName);

		$results[] = compact('fileName');
		// return our results in a files object
		return array(
			'files' => $results
		); 
	}
	
}