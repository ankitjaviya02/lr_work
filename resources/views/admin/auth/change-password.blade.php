@extends('admin.layout.master')
@section('content')

<style type="text/css">
  label{
    font-weight: 500;
  }

</style>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
<div class='row'>
	<div class='col-md-12'>
		@if (Session::has('error'))
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

       <div class="box border border-secondary">
             <div class="box-header with-border">
              <h3 class="box-title">  {{ $page_title }}</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   	
	 <form role="form"  method="post" action="{{ url('/') }}/admin/update_password"
    enctype="multipart/form-data" data-parsley-validate>
	 	{{ csrf_field() }}
           
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Current Password <font color="red">*</font> </label>
          <input type="password"  class="form-control" name="current_password" id="current_password" class="input-box" />
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">New Password <font color="red">*</font> </label>
          <input type="password" class="form-control" name="new_password" id="new_password" class="input-box" />
                          
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Confirm Password <font color="red">*</font> </label>
          <input type="password" name="confirm_password" class="form-control" />

        </div>
      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
        <a href="{{url('/')}}/admin/dashboard" class="btn btn-default btn-xs">Cancel</a>
       </div>
    </form>
  </div>
</div>
</div>

@endsection