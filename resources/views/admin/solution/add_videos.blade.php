  <div class="row">
       <div class="box-header with-border">
         <h3 class="box-title"> <i class="fa fa fa-video-camera"></i> ADD VIDEO  </h3>
            <a class="btn btn-primary add  btn-xs pull-right"><i class="fa fa-plus"></i> ADD NEW   </a>
        </div>    

          <div class="col-md-12">
            <table class="table" id="tbl">
              <thead>
                <tr>
                  <th id="l_name">Video Link</th>
                  <th id="">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php  $x=0; ?>
                  <tr data-index="1" id="tr_1">
                  <td>  
                      <input type="text" placeholder="Enter video url" class="form-control" name="video_link[]"
                       />
                    </td>

                  </tr>
              </tbody>
               <?php $x++; ?>

            </table>
          </div>

      </div>


<script type="text/javascript">
  $(document).on("click",".add", function()
  { 
    
    var index = parseInt($('#tbl').find("tbody").find("tr:last").data("index"))
    index = index + 1;
    var appendVal = $('#tbl').find("tbody").find("tr:last");
    var is_exist = $('#tbl').find("tbody").find("td:last").find('.apend_cls').length;
    console.log(appendVal);
    var a = appendVal.clone(true);

    a.data("index", index)
    $("tr:last").after(a);   
    if(is_exist==0)
    {
       var clsbtn = "<td><a style='cursor:pointer'  class='btn btn-danger btn-xs apend_cls remove'>X</a></td>";
       $("tr:last").append(clsbtn);    
    }
  });

    /*delete row*/ 
  $("#tbl").on('click','.remove',function()
  {
      $(this).parent().parent().remove();
 });

</script>