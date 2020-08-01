@extends('admin.layout.master')
@section('content')

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://tinymce.cachefly.net/4.2/tinymce.min.js"></script>

<script type="text/javascript">
  $(document).ready(function()
   {
  tinymce.init({
    selector: "#descp_one,#descp_two",
    theme: "modern",
    paste_data_images: true,
    plugins:[ "textcolor,code, colorpicker,table,lists,print,autoresize,pagebreak,preview,insertdatetime"],
    toolbar: "forecolor backcolor,fontsizeselect,table,numlist bullist,print,pagebreak,preview,insertdatetime,code",
    fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px",

  });
});
</script>



<form action="{{url('/')}}/admin/setting_save" method="post">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
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
                <h3 class="box-title" style="font-weight: 500"> General Settings</h3>
                <div class="box-tools pull-right">
                </div>
            </div>   
        </div>

        <div class="box-body" >
           <div class="form-group">
           <div class="row">
            <div class="col-sm-4">  
             <label for="exampleInputEmail1" style="font-weight: 500">PO Range</label></div>
             <div class="col-sm-8">        
                 <input type="text" class="form-control" name="po_range" placeholder="Enter starting PO Range" value="{{$details['po_range']}}">
             </div>  
         </div>
     </div>

         <div class="form-group">
           <div class="row">
            <div class="col-sm-4">  
             <label for="exampleInputEmail1" style="font-weight: 500">Heading 1</label></div>
             <div class="col-sm-8">        
                 <input type="text" class="form-control" name="heading_one" value="{{$details['heading_one']}}">
             </div>  
         </div>
     </div>

          <div class="form-group">
           <div class="row">
            <div class="col-sm-4">  
             <label for="exampleInputEmail1" style="font-weight: 500">Invoice Description 1</label></div>
             <div class="col-sm-8">  
                 <textarea placeholder="Enter Description" id="descp_one" class="form-control"
                 name="descp_one">{{$details['descp_one']}}</textarea>
             </div>  
         </div>
     </div>

      <div class="form-group">
           <div class="row">
            <div class="col-sm-4">  
             <label for="exampleInputEmail1" style="font-weight: 500">Heading 2</label></div>
             <div class="col-sm-8">        
                 <input type="text" class="form-control" name="heading_two" value="{{$details['heading_two']}}">
             </div>  
         </div>
     </div>

     <div class="form-group">
         <div class="row">
          <div class="col-sm-4">  
           <label for="exampleInputEmail1" style="font-weight: 500">Invoice Description 2</label></div>
           <div class="col-sm-8">  
            <textarea placeholder="Enter Description" id="descp_two" class="form-control" name="descp_two">{{$details['descp_two']}}</textarea>
        </div>  
    </div>
</div>

<div class="form-group">
 <div class="row">
  <div class="col-sm-4">   </div>
  <div class="col-sm-8">  
     <button type="submit" class="btn bg-primary btn-sm">Update</button>
     <a href="{{ url('/') }}/admin/settings" class="btn btn-danger btn-sm">Cancel</a>
 </div>  
</div>
</div>
</div>


</div>
</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>              
@endsection