<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class SolutionVideoModel  extends Model
{		
    protected $primaryKey = 'id';
    protected $table 	  = "solution_product_video";
    protected $fillable   = ['solution_id','video_url'];
    
    public $timestamps = false;
    
    
    
}

?>