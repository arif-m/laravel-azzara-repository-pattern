<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	protected $table = 'tb_menu';
	protected $fillable = array('name', 'description', 'allowed' ); 
	
	public function induk()
	{
		return $this->belongsTo('App\Models\Navigation');
	}
}
