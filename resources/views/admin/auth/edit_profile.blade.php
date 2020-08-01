@extends('admin.layout.master')
@section('content')

<div class='row'>
  <div class='col-md-12'>
    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
      @elseif(Session::has('success'))
       <div class="alert alert-success">{{ Session::get('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    @endif
    @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <br><br>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
       <div class="box ">
             <div class="box-header with-border">
              <h3 class="box-title">{{ $page_title }}</h3>

              <div class="box-tools pull-right">
              </div>
            </div>    
   <form role="form"  method="post" 
          action="{{ url('/') }}/admin/update_profile" enctype="multipart/form-data">
    {{ csrf_field() }}

               
             
              <div class="box-body">

                  <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Current Profile</label></div>
                        <div class="col-sm-9">

                        @if($profile['profile_image']!=null)
                          <img class="img-thumbnail" src="{{$path}}{{$profile['profile_image']}}" height="100px" width="100px" /> 
                        @else
                            <img  class="img-thumbnail" src="{{url('/')}}/public/upload/default/not-available.jpg" class="user-image" alt="User Image" height="100px" width="100px">
                        @endif

                          <input type="hidden" name="old_image"  value="{{$profile['profile_image']}}">
                          </div>
                    </div>
                </div>

                  <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Update Profile: </label></div>
                        <div class="col-sm-9">
                                  <input type="file" name="profile_image" accept="image/x-png,image/gif,image/jpeg">
                          </div>
                    </div>
                </div>


                <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">First Name: </label>
                        <font color="red">*</font>
                     </div>
                        <div class="col-sm-9">
                                  <input type="text" name="first_name" placeholder="Enter First Name"
                                   value="{{$profile['first_name']}}" 
                                    class="form-control">
                          </div>
                    </div>
                </div>

                 <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Last Name:</label></div>
                        <div class="col-sm-9">
                                    <input type="text" name="lname" placeholder="Enter Last Name"  
                                     value="{{$profile['last_name']}}"  class="form-control">
                          </div>
                    </div>
                  </div>

                  <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Email ID: </label>
                       <font color="red">*</font>
                     </div>
                        <div class="col-sm-9">
                                     <input type="email"  readonly name="email" placeholder="Enter Email ID"  
                                     value="{{$profile['email']}}" class="form-control" required>
                          </div>
                    </div>
                  </div>

                    <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Contact No:</label>
                       <font color="red">*</font>
                      </div>
                        <div class="col-sm-9">
                                     <input type="text" name="contact" placeholder="Enter Contact No" 
                                     value="{{$profile['contact_no']}}"
                                      class="form-control" required>
                          </div>
                    </div>
                  </div>

              
              </div>

             <div class="box-footer">

                  <div class="row">
                      <div class="col-sm-3">  </div>

                      <div class="col-sm-9">
                        <input type="submit" name="submit" class="btn bg-purple btn-xs" value="UPDATE">  
                <a href="{{ url('/') }}/admin/dashboard" class="btn btn-danger btn-xs">CANCEL</a>
                        </div>



              
              </div>
            </form>
          </div>
        </div>
      </div>

@endsection