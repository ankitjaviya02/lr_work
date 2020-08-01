<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class SolutionModel  extends Model
{		
    protected $primaryKey = 'id';
    protected $table 	  = "solution";
    protected $fillable   = ['solution_name','product_id'];
    
    public $timestamps = false;
    
    public function video_list(){
    	return $this->hasMany('App\Models\SolutionVideoModel','solution_id','id');
    }
    
    
}	

?>