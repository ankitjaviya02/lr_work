<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <?php 
    $currentpage = collect(request()->segments())->last();  

    $user=\Sentinel::check();
    $user->inRole('admin');
    $path  = url('/') ."/public/".config('app.project.user_path');

    $name = $user->first_name;
    $email = $user->email;

    $profile = $user->profile_image;

    ?>

    <div class="user-panel">
      <div class="pull-left image">
        @if($profile!=null)
        <img src="{{$path}}{{$profile}}"  class="img-circle" alt="User Image">
        @else
        <img src="{{url('/')}}/public/upload/default/not-available.jpg" class="img-circle" alt="User Image">
        @endif
      </div>
      <div class="pull-left info">


        <p>{{$name}}</p>
        <i class="fa fa-circle text-success"></i> Online 
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header" style="background-color: #E37349">
        <font color="white">Main Navigation</font>
      </li>
      <li class="treeview <?php echo  $currentpage=='dashboard'? 'active': '' ?>"  >
        <a href="{{ url('/') }}/admin/dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>        </a>
        </li>

         <li class="treeview <?php echo  $currentpage=='solution'? 'active': '' ?>"  >
        <a href="{{ url('/') }}/admin/solution">
          <i class="fa fa-list"></i> <span>Manage Solution</span>        </a>
        </li>

     

                
              
                


                  </ul>
                </li>
              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>