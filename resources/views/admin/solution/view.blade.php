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
       <div class="box box-primary">
             <div class="box-header with-border">
              <h3 class="box-title">{{ $page_title }}</h3>

              <div class="box-tools pull-right">
              </div>
            </div>    
   <form role="form"  method="post" 
          action="{{ url('/') }}/admin/amenities/update" enctype="multipart/form-data">
    {{ csrf_field() }}

                <input type="hidden" name="update_id" value="{{$details['comp_id']}}">
             
              <div class="box-body">
                @foreach($columns as $key => $value)
                <div class="form-group">
               
                   <div class="row">
                      <div class="col-sm-3">  
                       <label for="exampleInputEmail1">{{$value['title'] }} {{':'}}</label></div>
                        <div class="col-sm-9">

                          @if($value['type']=="file")

                              @if($details['company_logo']!=null)
                                <a href="{{$path}}{{$details[$key]}}" target="_blank">
                                   <img src="{{$path}}{{$details[$key]}}" height="100px" width="100px" />
                                </a>  
                              @else
                                <img src="{{$path}}{{'not-available.jpg'}}" height="80px" height="80px" />     
                              @endif

                          @else
                            <?= ucwords($details[$key]); ?>

                          @endif  

                          </div>
                      </div>
                  </div>

                @endforeach               
              </div>

             <div class="box-footer">
                <a href="{{ url('/') }}/admin/company" class="btn btn-warning btn-sm">Go Back</a>
              </div>
            </form>
          </div>
        </div>
      </div>

@endsection