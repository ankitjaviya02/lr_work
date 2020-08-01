<!DOCTYPE html>
  <html>


  <head>
    <meta charset="UTF-8">
    <title>{{ config('app.project.name') }} {{' | Admin'}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{url('/') }}/front/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{url('/') }}/front/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet"/>
 
  </head>

<style type="text/css">
.final
{
  border: 0px solid #ccc; 

}

</style>

      
  <body  style= "background-image: linear-gradient(#8686df , pink);">    <div class="login-box">
      <div class="login-logo">
        <a href="{{url('/') }}">
            <font color="white">  
                <h2 style="font-size: 20px; font-weight: 500">
                 {{config('app.project.name')}} | Admin Panel
                </h2> 
               </a>
         </font>
      </div><!-- /.login-logo -->
        @if(Session::has('error'))
      <div class="alert alert-danger">
       <strong>Error !</strong> {{Session::get('error') }}
         <button type="button" class="close" style="margin-top: 0px !important;padding: 0px !important;" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
        @endif
       
      <div class="login-box-body">

          <h4 style="font-size: 25px; font-weight: 200" align="center">Login to your account </h4> <hr/>
        <form action="{{url('/') }}/admin/process_login" method="post">
          {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="email" autofocus style="background-color: #f5f6f7;height: 40px;font-size: 16px;"  
             class="form-control final" placeholder="Username" required="" />
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control final"
            style="background-color: #f5f6f7;height: 40px;font-size: 16px;"
             placeholder="Password"  required=""/>
            
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn bg-purple btn-block  btn-sm btn-flat"
              style="height: 35px;font-size: 17px; font-family: calibri; background-color: #0090ff!important"
               >Sign In</button>
  


            </div><!-- /.col -->

           

          </div>
        </form>
        <br/>
     <br>
      </div><!-- /.login-box-body -->
      <br>
     </div><!-- /.login-box -->
    <!-- jQuery 2.1.3 -->
    <script src="{{url('/') }}/front/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{url('/') }}/front/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> -->


  </body>
</html> 