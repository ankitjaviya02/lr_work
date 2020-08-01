<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title></title>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#666; text-align:justify;">
      <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         
         <tr>
            <td bgcolor="#FFFFFF" style="padding:15px; border:1px solid #e5e5e5;">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <!---->
                              <td  align="center"
                                   style="text-align:center; color:black;background-color:#007AD8;">
                                   <h2 style="color: white;">INVOICE</h2>
                                 </td>
                            
                           </tr>
                        </table>
                     </td>
                  </tr>

                  <tr>
                     <td height="10">
                       <h2 align="center">Forget Password  </h2> 
                       <p style="font-size: 14px;font-family: Calibri">Dear, {{$fname}}</p>

                       <p style="font-size: 14px;font-family: Calibri">  
                       We got a request to a forget your account password. </p>

                      <font style="font-size: 14px; font-family: Calibri"> 
                         Your New Password is : <b> {{ $password }} </b>
                              <br/> <br/> 
                       </font>       

                          
                  </tr>

                  <tr>
                     <td height="10">
                      <p align="left">Thanks, <br/>
                                     {{ config('app.project.name') }} & Team.
                             </p>
                     </td>
                  </tr>


                  <tr>
                     <td  height="1" bgcolor="#ddd"></td>
                  </tr>

                  <tr>
                     <td height="10">
                      <font color="black" style="font-size: 12px; font-family: Calibri; font-style: bold;">
                       <p align="center"> <i> Don't reply to this email. It was automatically generated. </i> </p>
                     </font>
                     </td>
                  </tr>

                   <tr>
                     <td style="text-align:center; color:black;background-color:#007AD8;"> 
                        Copyright <?= date('Y'); ?> by 
                        {{ config('app.project.name') }} .com  All Right Reserved.

                     </td>
                  </tr>
               </table>
            </td>
         </tr>
       
      </table>
        </div>      
      </div>       
   </body>
</html>