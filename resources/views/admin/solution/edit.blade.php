@extends('admin.layout.master')
@section('content')


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


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
       <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">{{ $page_title }}</h3>

              <div class="box-tools pull-right">
              </div>
            </div>    
   <form role="form"  method="post" 
          action="{{ url('/') }}/admin/solution/update" enctype="multipart/form-data">
    {{ csrf_field() }}

                <input type="hidden" name="update_id" value="{{base64_encode($details['id'])}}">
             
              <div class="box-body">
                @foreach($columns as $key => $value)
                <div class="form-group">
                  <label for="exampleInputEmail1" style="font-weight: 500">{{$value['title']}}</label>

                  @if($value['type']=="select")
 
              <select class="form-control" id="status" name="{{$value['name']}}" required="{{$value['required']}}">
        <option value="">--Select --</option>  
         @if($products)
                  @foreach($products as $prd)
                  @if($prd['name']!="" && $prd['name']!=null)
                    <option value="{{$prd['id']}}"
                       <?= $details['product_id'] == $prd['id'] ? "selected='selected'": ''  ?> >
                      {{$prd['name']}}
                    </option>     
                  @endif
                   @endforeach()
                  </select>   
              @endif
      
      </select>   

              
                  @else 
                      <input type="{{$value['type']}}" name="{{$value['name']}}" 
                            class="form-control" id="{{$value['name']}}" required="{{$value['required']}}"
                            placeholder="{{$value['placeholder']}}"
                            value="{{  old($value['name'],$details[$key])  }}"
                            @if($value['type']=='number')
                                maxlength="10" 
                            @endif/>
                  @endif
                </div>
                @endforeach

              
                 @if(!empty($details['video_list']))         
                     @include('admin.solution.edit_videos')
                 @else
                      @include('admin.solution.add_videos')
                @endif

                         


              </div>

                 
                



             <div class="box-footer">
                <button type="submit" class="btn bg-primary btn-xs" value="Update">UPDATE</button>
                <a href="{{ url('/') }}/admin/solution" class="btn btn-danger btn-xs">CANCEL</a>
              </div>
            </form>
          </div>
        </div>
      </div>


@endsection