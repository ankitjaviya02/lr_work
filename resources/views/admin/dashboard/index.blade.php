@extends('admin.layout.master')
@section('content')

{{-- @if($total_unseen!=0)
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4> <i class="fa fa-bell"></i> NOTIFICATION </h4>

        <p>YOU HAVE RECEIVED NOTIFICATION. PLEASE CHECK IT IN NOTIFICATION PART.</p>
</div>
@endif --}}



<div class='row'>

  <div class='col-md-12'>
    @if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   </div>
   @endif          
   <h4> <i class="fa fa-dashboard"></i>  {{ $page_title }}</h4>
   <!-- Box -->
 </div>

 <div class="col-md-12">
  <!-- Box -->
  <div class="box">
    <div class="box-header" style="border-color: red">
      <h3 class="box-title"><label> <b>Date : </b></label> 

        <?= date("l, jS  F Y"); ?>

      </h3>
      <div class="box-tools pull-right">
      </div>
    </div>
  </div>
</div>

</div> 

<div class="row">
   <div class='col-md-12'>
        <a href="{{url('/')}}/admin/solution">
          <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 class="hm_txt">  <i class="fa fa-list"></i> {{$total_solution}}</h3>
              <h4 class="hm_txt" >Solutions</h4>
            </div>
          </div>
        </div>
      </a>
   </div>
</div>







  @endsection	