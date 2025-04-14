<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRight extends Model {

	protected $table = 'tb_menu';
	protected $fillable = array('name', 'description', 'allowed' ); 

}