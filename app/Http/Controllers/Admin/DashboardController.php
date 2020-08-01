<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SolutionModel;
use Validator;
use Flash;
use Session;
use Artisan;
use Sentinel;

class DashboardController extends Controller
{
	public function __construct(User $user, SolutionModel $solutionDtl)
	{
    $this->arr_view_data  = [];
    $this->user           = $user;
    $this->solutionDtl    = $solutionDtl;
  }
  public function clear_app_cache()
  {
    Artisan::call('cache:clear');
    return redirect()->back();
  }
  public function index()
  {	
    $user = Sentinel::check();
    if($user)
    {	
      $total_createduser = $this->user->count();
      $total_solution    = $this->solutionDtl->count();
    
      $this->arr_view_data['page_title']        = 'DASHBOARD'; 
      $this->arr_view_data['total_createduser'] = $total_createduser<10 ? "0".$total_createduser : $total_createduser;
      $this->arr_view_data['total_solution'] = $total_solution<10 ? "0".$total_solution : $total_solution;

         return view('admin.dashboard.index',$this->arr_view_data);        	

    }
    else
    {
      return redirect(config('app.project.admin_panel_slug').'/login');
    }
  }

  public function settings()
  {
    $user = Sentinel::check();
    if($user)
    {

      $details = $this->settings->first()->toArray();
      return view('admin.dashboard.settings',compact('details'));
    }
    else
    {
      return redirect(config('app.project.admin_panel_slug'));
    }
  }


  public function setting_save(Request $request)
  {

    $user = Sentinel::check();
    if($user)
    {
         $data = $request->all();

         $heading_one = $request->input('heading_one');
         $heading_two = $request->input('heading_two');
         $descp_one = $request->input('descp_one');
         $descp_two = $request->input('descp_two');
         $po_range = $request->input('po_range');

         $updateArr  = array('descp_one' => $descp_one, 
                             'descp_two'=>$descp_two,
                             'heading_one'=>$heading_one,
                             'heading_two'=>$heading_two,
                             'po_range'=>$po_range);

         $isUpdate = $this->settings->where('id','1')->update($updateArr);


         Session::flash('success','Details save successfully');
         return redirect()->back();
    }
    else
    {
       return redirect(config('app.project.admin_panel_slug'));
    }
 }


}