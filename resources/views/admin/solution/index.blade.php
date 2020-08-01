@extends('admin.layout.master')
@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
       <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title"> <i class="{{$module_icon}}"></i> {{ $page_title}}{{'s'}}
              </h3>

                  <a href="{{ url('/') }}/admin/solution/create" class="btn btn-primary
                   btn-xs pull-right"> Add Solution</a>

                          </div>    
   <form role="form"  method="post" action="{{ url('/') }}/admin/solution/store"
    enctype="multipart/form-data">
    {{ csrf_field() }}
        
              <div class="box-body">

                  <table id="example2" class="table">
                    <thead>
                      <tr>
                         <th>Name</th>
                         <th>Product Name</th>
                         <th>Custom Field (Uploaded File)</th>
                         <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                      @if(sizeof($data)>0)
                        @foreach($data as $art)                      
                       <tr>  
                        <td>
                          {{ucfirst($art['solution_name']) }}
                        </td>
                     
                        <td>

                          @php
                          if($art['product_id']!=null)
                            $a = DB::table('wp_posts')->select('post_title')->where('ID',$art['product_id'])->first();
                          else
                            $a = null;
                          @endphp
                          @if($a!=null)
                              {{ucfirst($a->post_title)}}
                          @endif
                          
                        </td>

                        <td>
                        @foreach($products as $pd)
                            @if($pd['id']== $art['product_id'])
                              @foreach($pd['meta_data'] as $mdata)
                          <?php     $copy = $mdata; ?>
                                 @if($mdata['key']!="" && $mdata['value']!="")
                                    @php 
                                      $x = DB::table('wp_postmeta')->where('post_id',$mdata['value'])->first();
                                    @endphp
                                    <a target="_blank" href="{{$file_path}}{{$x->meta_value}}"> Open File </a>

                                   <?php  if (next($copy )) {  echo ',';  }   ?>
                                    @else
                                     {{'NA'}}
                                 @endif
                              @endforeach

                            @endif
                        @endforeach                          
                       </td>

                                                  <td>
                            <a href="{{url('/').'/admin/solution/edit/'.base64_encode($art['id'])}}" 
                            class="editbtn" title="Edit">
                                <i class="fa fa-pencil"></i></a>
                            <a href="{{url('/').'/admin/solution/delete/'.base64_encode($art['id'])}}" 
                                class="deletebtn" onclick="return confirm_delete()" title="Delete">
                                <i class="fa fa-trash"></i></a>    

                        </td>



                           
                    </tr>
                     @endforeach 

                     @else
                    
                      @endif

                  </tbody>
              </table>
              </div>
            </form>
          </div>
        </div>
      </div>

<script type="text/javascript">
function confirm_delete()
{
  if(confirm('ARE YOU SURE TO DELETE THIS RECORD?'))
  {
    return true;
  }
  else
  { 
     return false;
  }   
}
</script>

<script type="text/javascript">
      $(function () {

        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
      });
    </script>


@endsection