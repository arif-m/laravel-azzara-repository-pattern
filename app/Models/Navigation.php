<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model {
	protected $table = 'tb_menu';
	protected $fillable = array('name','uri','route','group','parent_id',
								'menu_allowed','icon','sequence','is_visible','is_visible_user_right','published');
}

