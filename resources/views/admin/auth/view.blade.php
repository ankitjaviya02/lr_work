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
       <div class="box box">
             <div class="box-header with-border">
              <h3 class="box-title" >{{ $page_title }}</h3>

              <div class="box-tools pull-right">
              </div>
            </div>    
   <form role="form"  method="post" 
          action="{{ url('/') }}/admin/amenities/update" enctype="multipart/form-data">
    {{ csrf_field() }}

               
             
              <div class="box-body">

                  <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Profile Image:</label></div>
                        <div class="col-sm-9">

                              @if($profile['profile_image']!=null)
                                <img src="{{$path}}{{$profile['profile_image']}}" height="100px" width="100px" />
                              @else
                                <img src="{{url('/')}}/public/upload/default/not-available.jpg" class="user-image" alt="User Image" height="100px" width="100px">
                              @endif  
                          </div>  
                    </div>
                </div>


                <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">First Name: </label></div>
                        <div class="col-sm-9">
                                    {{ $profile['first_name'] }} 
                          </div>
                    </div>
                </div>

                 <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Last Name:</label></div>
                        <div class="col-sm-9">
                                    {{ $profile['last_name'] }} 
                          </div>
                    </div>
                  </div>

                  <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Email ID: </label></div>
                        <div class="col-sm-9">
                                    {{ $profile['email'] }} 
                          </div>
                    </div>
                  </div>

                    <div class="form-group">
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1" style="font-weight: 500">Contact No:</label></div>
                        <div class="col-sm-9">
                                    {{ $profile['contact_no'] }} 
                          </div>
                    </div>
                  </div>

               
                
              </div>

             <div class="box-footer">
                <a href="{{ url('/') }}/admin/edit_profile" class="btn bg-purple btn-xs">EDIT PROFILE</a>
                <a href="{{ url('/') }}/admin/dashboard" class="btn btn-danger btn-xs">CANCEL</a>
              </div>
            </form>
          </div>
        </div>
      </div>

@endsection