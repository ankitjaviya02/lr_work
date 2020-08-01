  <div class="row">
       <div class="box-header with-border">
         <h3 class="box-title"> <i class="fa fa fa-language"></i> EDIT VIDEO  </h3>

          <span style="margin-left: 20px;color:red;">(Must be required  single video url)</span>
            <a class="btn btn-info add  btn-xs pull-right"><i class="fa fa-plus"></i> ADD NEW   </a>
        </div>    

          <div class="col-md-12">
            <table class="table" id="tbl">
              <thead>
                <tr>
                  <th id="l_name">Video URL</th>
                  <th id="">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php  $x=0; ?>
                    @if($details['video_list'])
                         @foreach($details['video_list'] as $vid)
                            <tr data-index="{{$x}}" id="{{$x}}">
                             
                              <td>                                          
                                    <input type="text" class="form-control" name="video_link[]" value="{{$vid['video_url']}}" />
                              </td>

                              <td>
                               <a onclick="delete_lang({{$vid['id']}})" style='cursor:pointer'  class='btn btn-danger btn-xs apend_cls remove'>X</a>
                              </td>
                            </tr>
                              <?php $x++; ?>
                        @endforeach
                    @endif
              </tbody>
             

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


function  delete_lang(id)
{
    console.log(id);

      $.ajax({
            url: "{{ url('/admin/album/delete_album_language') }}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            data: {album_lang_id : id }, 
            success:function(response) 
            {   
                if(response.msg=='success')
                  console.log(response.msg);
                else
                    console.log(response.msg);
            }
      });
}

</script>