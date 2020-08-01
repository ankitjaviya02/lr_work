<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SolutionModel;
use App\Models\SolutionVideoModel;
use Validator;
use Flash;
use Session;
use Artisan;
use Sentinel;
use DB;
use Woocommerce;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user, SolutionVideoModel $solutionVideo, SolutionModel $solution)
    {
        $this->arr_view_data  = [];
        $this->user           = $user;  
        $this->solutionDtl    = $solution;  
        $this->solutionvideoDtl = $solutionVideo;  
        $this->module_title                 = "solution";
        $this->module_view_folder           = "admin.solution";
        $this->module_icon                  = "fa fa-user";

         $this->columns["solution_name"]["required"] = true;
        $this->columns["solution_name"]["title"] = 'Solution Name';
        $this->columns["solution_name"]["type"] = "text";    
        $this->columns["solution_name"]["name"] = "solution_name";
        $this->columns["solution_name"]["placeholder"] = "Enter Solution Name";
        $this->columns["solution_name"]["validation"] = "";

        $this->columns["product_name"]["required"] = true;
        $this->columns["product_name"]["title"] = 'Product Name';
        $this->columns["product_name"]["type"] = "select";    
        $this->columns["product_name"]["name"] = "product_name";
        $this->columns["product_name"]["placeholder"] = "Select Product Name";
        $this->columns["product_name"]["validation"] = "";
    }

    /*public function get_products(){

        $products = DB::select("SELECT id, post_type,post_title FROM `wp_posts` WHERE post_title !='AUTO-DRAFT' and post_title != '' and post_type = 'product' or 'product_variation'");

        return $products;

    }*/

    public function index()
    {
         $user = Sentinel::check();
        if($user)
        {
            $data = $this->solutionDtl->get();
            if(sizeof($data))
            {
                $data = $data->toArray();
            }
            $products =  Woocommerce::get('products');

            $filePath = env('WOOCOMMERCE_STORE_URL').'/wp-content/uploads/';

            $this->arr_view_data['page_title']  = "Create ". $this->module_title;
            $this->arr_view_data['module_icon']         = $this->module_icon;
             $this->arr_view_data['columns']     = $this->columns;
             $this->arr_view_data['products']     = $products;
             $this->arr_view_data['data']     = $data;
             $this->arr_view_data['file_path']     = $filePath;


            return view($this->module_view_folder.'.index',$this->arr_view_data);
        }
        else
        {
            return redirect(config('app.project.admin_panel_slug'));
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Sentinel::check();
        if($user)
        {
            $data = $this->solutionDtl->get();
            if(sizeof($data))
            {
                $data = $data->toArray();
            }
             $products =  Woocommerce::get('products');

             //dd($products);
        
            $this->arr_view_data['page_title']  = "Create ". $this->module_title;
            $this->arr_view_data['module_icon']         = $this->module_icon;
            $this->arr_view_data['columns']             = $this->columns;
            $this->arr_view_data['products']       = $products;
            return view($this->module_view_folder.'.create',$this->arr_view_data);
        }
        else
        {
            return redirect(config('app.project.admin_panel_slug'));
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user = Sentinel::check();
        if($user)
        {
            $arr_rules = [];
            $arr_rules['solution_name'] = 'required';
            $arr_rules['product_name'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if ($validator->fails())
            {   
                Session::flash('error','Please enter all the required fields.');
                return back()->withInput($request->all())->withErrors($validator);
            }

            $isExist = $this->solutionDtl->where('solution_name',trim($request->input('solution_name')))
                                         ->where('product_id',trim($request->input('product_name')))
                                          ->count();

           if( $isExist > 0){
                Session::flash('error','Solution already exist with same product name');
                return back()->withInput($request->all())->withErrors($validator);
           }

           $store_data = [];
           $store_data['solution_name'] = trim($request->input('solution_name'));
           $store_data['product_id'] = trim($request->input('product_name'));

           $isSave = $this->solutionDtl->Create($store_data);
           $last_id = $isSave->id;

           $save_videos = $this->store_videos($last_id,$request,'create');

           if($save_videos){
                Session::flash('success','Solution details save successfully');
                return redirect()->back();
           }
           else{
                Session::flash('error','Something went wrong');
                return redirect()->back();
           }
        }
        else{
            return redirect(config('app.project.admin_panel_slug'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Sentinel::check();
        if($user)
        {
            $id = base64_decode($id);
             $data = $this->solutionDtl->with('video_list')->where('id',$id)->first();
             if(!empty($data)){
                $data = $data->toArray();
             }

            $products =  Woocommerce::get('products');
            
            $this->arr_view_data['page_title']  = "Edit ". $this->module_title;
            $this->arr_view_data['module_icon']         = $this->module_icon;
            $this->arr_view_data['columns']             = $this->columns;
            $this->arr_view_data['products']       = $products;
            $this->arr_view_data['details']       = $data;

            return view($this->module_view_folder.'.edit',$this->arr_view_data);
        }
        else
        {
            return redirect(config('app.project.admin_panel_slug'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Sentinel::check();
        if($user)
        {
            $id = base64_decode($request->input('update_id'));
            $solution_name = $request->input('solution_name');  
            $product_name = $request->input('product_name');

            $update_data = array('solution_name'=>$solution_name,'product_id'=>$product_name);
            $isUpdate = $this->solutionDtl->where('id','=',$id)->update($update_data);

            $updateVideos = $this->store_videos($id,$request,'update');

            if($updateVideos){
                    Session::flash('success','Solution details updated successfully');
                    return redirect()->back();
            }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
            }
        }
        else
        {
            return redirect(config('app.project.admin_panel_slug'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Sentinel::check();
        if($user)
        {
            $del_id = base64_decode($id);
            $is_delete =$this->solutionDtl->where('id',$del_id)->delete();
            $vid_delete = $this->solutionvideoDtl->where('solution_id',$del_id)->delete();

            if($is_delete == true && $vid_delete == true)
            {
                Session::flash('success','Solution details delete successfully');
                return redirect()->back();  
            }
            else{
               Session::flash('error','Something went wrong');
               return redirect()->back();  
            }

        }
        else{
             return redirect(config('app.project.admin_panel_slug'));
        }
    }

    public function store_videos($solution_id,$request,$status)
    {   
    
            if($status=='update'){
                $this->solutionvideoDtl->where('solution_id',$solution_id)->delete();
            }   

            if($request->has('video_link'))
            {
                $video_links = $request->input('video_link');
                foreach ($video_links as $key => $val)
                {   
                    if($val!=null)
                    {                    
                        $store_data = [];
                        $store_data['solution_id']   = $solution_id;
                        $store_data['video_url'] = $val;
                        $this->solutionvideoDtl->create($store_data);
                    }
                }   
                return true;
            }
            else{
                return false;
            }            
    }
}

