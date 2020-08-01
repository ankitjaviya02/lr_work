@extends('admin.layout.master')
@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>              

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

  <div class="box box-warning">
   <div class="box-header with-border">
    <h3 class="box-title" style="font-weight: 500">  {{ $page_title }}</h3>

    <div class="box-tools pull-right">
    </div>
  </div>   	
  <form role="form"  
        method="post"
        action="{{ url('/') }}/admin/solution/store" 
        enctype="multipart/form-data"
        data-parsley-validate autocomplete="off">
        {{ csrf_field() }}

   <div class="box-body">
    @foreach($columns as $key => $value)
    <div class="form-group">
      <label for="exampleInputEmail1" style="font-weight: 500"  >{{$value['title']}}</label>

      @if($value['required']==true)
      <font color="red">*</font>
      @endif  

      @if($value['type']=="select")

      <select class="form-control"  name="{{$value['name']}}" required="{{$value['required']}}">
        <option value="">--Select --</option>
              @if($products)
                  @foreach($products as $prd)
                  @if($prd['name']!=null && $prd['name']!="")
                    <option value="{{$prd['id']}}"
                       <?= old($value['name']) == $prd['id'] ? "selected='selected'": ''  ?> >
                      {{$prd['name']}}</option>     
                  @endif
                   @endforeach()
                  </select>   
              @endif
      @else
      <input type="{{$value['type']}}" name="{{$value['name']}}" 
      class="form-control" id="{{$value['name']}}" 
      
      @if($value['required']==true)
          required
      @endif     
      value="{{ old($value['name'])}}" 
      placeholder="{{$value['placeholder']}}"
      @if($value['type']=='number') 
      maxlength="10" 
      @endif />
      @endif
    </div>
    @endforeach      

     @include('admin.solution.add_videos')

  </div>
  <div class="box-footer">
    <button type="submit" class="btn bg-primary btn-xs">Create</button>
    <a href="{{ url('/') }}/admin/solution" class="btn btn-danger btn-xs">Cancel</a>
  </div>
</form>
</div>
</div>
</div>

 
@endsection