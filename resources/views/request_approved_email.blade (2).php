<html>
   <head>
         <meta charset="text/html">
     </head>

<body  topmargin="0" bottommargin="0">
<table border="0" cellpadding="0" cellspacing="0" align="center"  width="580px"  style="border-bottom:thick #FFFFFF solid; margin-top:0px;"  >
 <tr>
   <td colspan="6" style="border-top:#3e8eb9 solid thin;">
   <img src="{{asset('img/email_images/logo_2.png')}}"/>
   </td>
 </tr>

 <tr>
  <td colspan="6"><img src="{{asset('img/email_images/dropshadow.png')}}" /></td>
 </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center"  width="580" style=" border:thin solid #eee;">
 <tr height="25">
  <td width="578" >
   <table border="0" bordercolor="#6ea2cc" cellpadding="0" cellspacing="0">
    <tr height="25">
     <td width="578" style="color:#333; font-family:Calibri; font-size:14px;" bgcolor="#ff9600"><b> &nbsp; Travel Request Approved Travel# {{$info['request_no']}}!</b></td>
    </tr>
   </table>
   </td>
 </tr>
 
 
 <tr>
  <td>
    <table width="570" style="color:#0d6e8c; font-family:Calibri; font-size:11px;">
       <tr height="30" >
       <td style=" color:#333">
     &nbsp;   <br />

       </td>
      </tr>
       </table>
  </td>
 </tr>
 
 <tr>
 
 <td>
   <table  height="62" border="0"  bgcolor="#f6fbff"  cellpadding="0" cellspacing="0" align="left"  width="360px" style="color:#0d6e8c; font-family:Calibri; font-size:12px;  margin-left:5px; border:#CCCCCC dotted thin; ">
      @foreach($approval as $key => $data)
            <tr>
                <td style="width:30%;"><b>{{$data->user->name}}</b></td>
                <td style="width:70%;">: {{$data->comment}}</td>
            </tr>
    @endforeach
      
    </table>

    

    
 </td>
 
 </tr>
 
 <tr>
  <td>
     <table width="570" style="color:#0d6e8c; font-family:Calibri; font-size:11px;">
       <tr height="30" >
       <td width="40"  style=" color:#0d6e8c">
       &nbsp; NOTE:
       </td>
       <td style=" color:#333">
       This is a system generated email. Please do not reply to this message
       </td>
      </tr>
       </table>
  </td>
 </tr>
 
 <tr>
 <td>
 <table  border="0" cellpadding="0" cellspacing="0" align="center"  width="576"    >
<tr bgcolor="#404041" height="20" >
<td   width="576px" style="color:#FFFFFF; font-family:Calibri; font-size:11px; text-align:center">Copyright © 2019 Proaxive. All Right Reserved.</td>
</tr>
</table> 
 
 </td>
 </tr>
 
</table>




</body>
</html>
