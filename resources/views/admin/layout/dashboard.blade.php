@extends('layout.master')
@section('content')

 <div class='row'>
        <div class='col-md-12'>
            @if(Session::has('error'))
             <div class="alert alert-danger">{{ Session::get('error') }}
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
           @endif 
        <h4>{{ $page_title }}</h4>
            <!-- Box -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Date :</b> <?php echo date('d-M-Y'); ?>  </h3>
                    <div class="box-tools pull-right">
                       
                    </div>
                </div>
            </div>

          {{--    <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"> <b>Goal :</b> I will have salary +20000K by next year</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div> --}}

            {{--  <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"> <b>Thought :</b> You Become, What you think most of the time.</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div> --}}
        </div>

        
@endsection	