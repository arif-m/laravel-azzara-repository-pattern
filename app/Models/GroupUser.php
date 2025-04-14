<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\User;

class GroupUser extends Model {

	protected $table = 'tb_group';
	protected $fillable = array('group', 'description'); 

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

}