<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Flash;
use Sentinel;
use Reminder;
use Session;
use URL;
use Mail;

class AuthController extends Controller
{
  public $arr_view_data;
  public $admin_panel_slug;

  public function __construct(User $userdtl)
  {
    $this->UserModel          = Sentinel::createModel();

    $this->user = $userdtl;

    $this->arr_view_data = [];
    $this->admin_panel_slug = config('app.project.admin_panel_slug');
    $this->profile_path         = public_path() . config('app.project.user_path');
    $this->profile_public_path = url('/') ."/public/".config('app.project.user_path');
    
  }
  public function login()
  { 
    $page_title = "Admin Login";
    $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
    $this->arr_view_data['page_title'] = "Login";

    return view('admin.auth.login',$this->arr_view_data);
  }

  public function create_admin()
  {
    Sentinel::register([
     'email'    => 'admin@test.com',
     'password' => '123456',
   ]);
  }

  public function process_login(Request $request)
  {


    $validator = Validator::make($request->all(), [
      'email' => 'required|max:255',
      'password' => 'required',
    ]);

    if ($validator->fails())
    {
      return redirect(config('app.project.admin_panel_slug').'/login')->withErrors($validator)->withInput($request->all());
    }

    $credentials = [
      'email'    => $request->input('email'),
      'password' => $request->input('password'),
    ];
    $check_authentication = Sentinel::authenticate($credentials);



    if($check_authentication)
    {
      $user = Sentinel::check();
      if($user->inRole('admin'))
      {
        return redirect(config('app.project.admin_panel_slug').'/dashboard');
      }
      else
      {
        Session::flash('error','Not Sufficient Privileges');
        return redirect()->back();
      }

    }
    else
    {
      Session::flash('error','Invalid Login Credential');
      return redirect()->back();
    }

  }

  public function logout()
  {
    Sentinel::logout();
    return redirect(url($this->admin_panel_slug));
  }
  public function forget_password()
  {   
    $page_title = "Change Password";
    $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
    $this->arr_view_data['page_title'] = "Change Password";
    return view('admin.auth.forget_password',$this->arr_view_data);
  }

  public function process_forgot_password(Request $request)
  {

    $arr_rules['email']      = "required";
    $validator = Validator::make($request->all(),$arr_rules);

    if($validator->fails())
    {
      Session::flash('error','Please enter valid email_id');
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $email = $request->input('email');
    $user  = Sentinel::findByCredentials(['email' => $email]);

    if($user==null)
    {
      Session::flash('error',"Email Id not found");
      return redirect()->back();
    }

    $reminder = Reminder::create($user);
     $password = str_random(6);

    $user = $this->get_user_details($email);

    $fname = $user->first_name != "" ?  $user->first_name : 'User';

      $new_credentials['password'] = $password;
      if(Sentinel::update($user,$new_credentials))
      {       

         $data = array('name'=>$fname,'password'=>$password);
    //    return view('admin.auth.forgot_email', compact('fname','password'));

//         dd($data);

         Mail::send('admin.auth.forgot_email', compact('fname','password'), function($message) use($email)
         {
           $message->to($email, $email)->subject('Recover password for your account.');
           $message->from('demoinfo01@gmail.com','admin');
         });
    
      Session::flash('success','Password detail has been sent successfully');
      return redirect()->back();
     }
    }

  private function forget_password_send_mail($email)
  {
    $user = $this->get_user_details($email);
    if($user)
    {
      $fname        = $user->first_name;
      $email        = $user->email;

      $new_credentials = [];
      
    
  }

}

 public function get_user_details($email)
 {
    $credentials = ['email' => $email];
    $user = Sentinel::findByCredentials($credentials); // check if user exists
    if($user)
    {
      return $user;
    }
    return FALSE;
  }

  public function change_password()
  { 
    $page_title = "Change Password";
    $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
    $this->arr_view_data['page_title'] = "Change Password";
    return view('admin.auth.change-password',$this->arr_view_data);
  }

  public function update_password(Request $request)
  {
    $arr_rules = array();
    $arr_rules['current_password'] = "required";
    $arr_rules['new_password'] = "required|min:6";

    $new_pass = $request->input('new_password');
    $creden = $request->input('current_password');
    $confirm = $request->input('confirm_password');

    $validator = Validator::make($request->all(),$arr_rules);
    if($validator->fails())
    {
      return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

    if(trim($new_pass)!= trim($confirm))
    {
      Session::flash('error','New password and confirm password not match');
    }
    $user = Sentinel::check();
    
    $credentials = [];
    $credentials['password'] = $request->input('current_password');
    if($creden==$new_pass)
    {
      Session::flash('error','Old password and new password should not be same');
    }
    elseif(Sentinel::validateCredentials($user,$credentials))
    {
      $new_credentials = [];
      $new_credentials['password'] = $request->input('new_password');

      if(Sentinel::update($user,$new_credentials))
      {
        Session::flash('success','Password Change Successfully');
      }
      else
      {
        Session::flash('error','Problem Occurred, While Changing Password');
      }
    }
    else
    {
      Session::flash('error','Invalid Old Password');
    }

    return redirect()->back();
  }

  public function profile()
  { 
    $user = Sentinel::check();
    if($user->inRole('admin'))
    { 
      $page_title = "Profile Detail";
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title'] = "Profile Detail";
      $this->arr_view_data['path']       = $this->profile_public_path;
      $this->arr_view_data['profile'] = $user->toArray();

      return view('admin.auth.view',$this->arr_view_data);
    }
    else
    {
      return redirect(url($this->admin_panel_slug));
    } 
  }

  public function edit_profile()
  { 
    $user = Sentinel::check();
    if($user->inRole('admin'))
    { 
      $page_title = "Edit Profile Detail";
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title'] = "Edit Detail";
      $this->arr_view_data['path']       = $this->profile_public_path;
      $this->arr_view_data['profile'] = $user->toArray();

      return view('admin.auth.edit_profile',$this->arr_view_data);
    }
    else
    {
      return redirect(url($this->admin_panel_slug));
    } 
  }

  public function update_profile(Request $request)
  {
    $arr_rules['first_name']        = "required";
    $arr_rules['contact']           = "required|numeric|min:10|regex:/^[0-9]+$/";
    $arr_rules['email']             = "required";

    $validator = Validator::make($request->all(),$arr_rules);

    if($validator->fails())
    {
      Session::flash('error','Please fill all details in proper manner');
      return redirect()->back();
    }

    if($request->hasFile('profile_image'))
    {
     $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension());
     $file_name = $request->file('profile_image')->getClientOriginalName();
     $image_size = getimagesize($request->file('profile_image'));

     if(in_array($file_extension, ['png','jpeg','jpg']))
     {
      $file_name = time().uniqid(). '.'.$file_extension;
      $isUpload = $request->file('profile_image')->move($this->profile_path, $file_name);   
    }
  }
  else
  {
    $file_name = $request->input('old_image');  
  } 

  $user = Sentinel::check();
  $id = $user->id;

  $update_data = array('first_name' =>  trim($request->input('first_name')),
   'last_name' =>  $request->input('lname'),
   'contact_no' =>  $request->input('contact'),
   'email' =>  $request->input('email'),
   'profile_image' =>  $file_name);

  
  $update_record = $this->user->where('id','=',$id)->update($update_data);
  if($update_record)
  {
    Session::flash('success','Profile has been updated successfully');
    return redirect('admin/profile');
  }
  else
  {
    Session::flash('error','Someting is wrong');
    return redirect()->back();    
  }
  
}



/*
  public function process_forgot_password(Request $request)
  {

    $arr_rules['email']      = "required";

    $validator = Validator::make($request->all(),$arr_rules);

    if($validator->fails())
    {
      Flash::error('Please enter valid email_id');
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $email = $request->input('email');

    $user  = Sentinel::findByCredentials(['email' => $email]);

    if($user==null)
    {
      Flash::error("Invaild Email Id");
      return redirect()->back();
    }

    if($user->inRole('admin')==false)
    {
      Flash::error('We are unable to process this Email Id');
      return redirect()->back();
    }


    $reminder = Reminder::create($user);


    $email_status = $this->forget_password_send_mail($email,$reminder->code);

    if ($email_status)
    {
      Session::flash('Password reset link send successfully to your email id');
      return redirect()->back();
    }
    else
    {
      Session::flash('Error while sending password reset link');
      return redirect()->back();
    }
  }

  private function forget_password_send_mail($email, $reminder_code)
  {
    $user = $this->get_user_details($email);

    if($user)
    {
      $obj_email_template = $this->EmailTemplateModel->where('id','7')->first();
      if($obj_email_template)
      {
        $arr_email_template = $obj_email_template->toArray();

        $content = $arr_email_template['template_html'];

        $content        = str_replace("##FIRST_NAME##",$user->first_name,$content);
        $content        = str_replace("##EMAIL##",$user->email,$content);

        $reminder_url = '<a target="_blank" style="background:#fa8612; color:#fff; text-align:center;border-radius: 4px; padding: 15px 18px; text-decoration: none;" href=" '.URL::to($this->admin_panel_slug.'/validate_admin_reset_password_link/'.base64_encode($user->id).'/'.base64_encode($reminder_code) ).'">Reset Password</a><br/>' ;
        $content        = str_replace("##REMINDER_URL##",$reminder_url,$content);

        $content = view('email.front_general',compact('content'))->render();
        $content = html_entity_decode($content);

        // return response($content);
        // echo $content;
        // exit;
        $send_mail = Mail::send(array(),array(), function($message) use($user,$arr_email_template,$content)
        {
          $message->from($arr_email_template['template_from_mail'], $arr_email_template['template_from']);
          $message->to($user->email, $user->first_name)
          ->subject($arr_email_template['template_subject'])
          ->setBody($content, 'text/html');
        });
        //dd($send_mail);
        return $send_mail;
      }
    }

  }

  public function get_user_details($email)
  {
    $credentials = ['email' => $email];
    $user = Sentinel::findByCredentials($credentials); // check if user exists

    if($user)
    {
      return $user;
    }
    return FALSE;
  }

  public function validate_reset_password_link($enc_id, $enc_reminder_code)
  {
    $user_id       = base64_decode($enc_id);
    $reminder_code = base64_decode($enc_reminder_code);
    //dd($enc_reminder_code);
    $user = Sentinel::findById($user_id);

    if(!$user)
    {
      Flash::error('Invalid User Request');
      return redirect()->back();
    }

    if(Reminder::exists($user))
    { 
      //dd(Reminder::exists($user));
     // dd('here');
      return view('admin.auth.reset_password',compact('enc_id','enc_reminder_code'));
    }
    else
    {
    // dd('repeat');
      Flash::error('Reset Password Link Expired');
      return redirect()->back();
    }
  }

  public function reset_password(Request $request)
  {
    $arr_rules                      = array();
    $arr_rules['password']          = "required";
    $arr_rules['confirm_password']  = "required";
    $arr_rules['enc_id']            = "required";
    $arr_rules['enc_reminder_code'] = "required";

    $validator = Validator::make($request->all(),$arr_rules);

    if($validator->fails())
    {
      return redirect()->back();
    }

    $enc_id            = $request->input('enc_id');
    $enc_reminder_code = $request->input('enc_reminder_code');
    $password          = $request->input('password');
    $confirm_password  = $request->input('confirm_password');
    
    //dd($enc_reminder_code);
    if($password  !=  $confirm_password )
    {
      Flash::error('Passwords Do Not Match.');
      return redirect()->back();
    }

    $user_id       = base64_decode($enc_id);
    $reminder_code = base64_decode($enc_reminder_code);

    $user = Sentinel::findById($user_id);

    if(!$user)
    {
      Flash::error('Invalid User Request');
      return redirect()->back();
    }
    if(Reminder::complete($user, $reminder_code, $password))
    {
      Flash::success('Password reset successfully');
      return redirect($this->admin_panel_slug.'/login');

    }
    else
    {
      Flash::error('Reset Password Link Expired');
      return redirect()->back();
    }

  }
 */

}