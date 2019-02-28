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
 <tr valign="middle" bgcolor="#404041"  height="25" >
  <td  style="color:#ff9600; font-family:Calibri; font-size:12px;"> &nbsp; Employee ID:</td>
  <td   style="color:#fff; font-family:Calibri; font-size:12px;"> {{$emp_id}}</td>
  <td  style="color:#ff9600; font-family:Calibri; font-size:12px;">Employee Name:</td>
  <td   style="color:#fff; font-family:Calibri; font-size:12px;" align="left"> {{$emp_name}}</td>
  <td   style="color:#ff9600; font-family:Calibri; font-size:12px;" align="center"></td>
  <td style="color:#fff !important; font-family:Calibri; font-size:12px; "> &nbsp; </td>
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
     <td width="578"style="color:#333; font-family:Calibri; font-size:14px;" bgcolor="#ff9600"><b> &nbsp; Travel Request Details</b></td>
    </tr>
   </table>
   </td>
 </tr>
 <tr>
    
  <td style=" font-size:12px;font-family:Calibri; ">
 
    <table    border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="2" align="center"  width="100%" style="color:#0d6e8c; font-family:Calibri; font-size:12px;border-top:thick #FFFFFF solid;">
      
      <tr valign="bottom">
       <td width="120" style="color:#222;" bgcolor="#dfebf4"> &nbsp; Travel Request #</td>
       <td  width="170" style="color:#0d6e8c;" bgcolor="#dfebf4"> &nbsp; {{$travel_request[0]['request_no']}}</td>
       
      </tr>
      <tr>
       <td style="color:#222; " bgcolor="#dfebf4"> &nbsp; Travel Purpose</td>
       <td style="color:#0d6e8c;  " bgcolor="#dfebf4"> &nbsp; {{$travel_request[0]['purpose']}}</td>
       
      </tr>
      <tr>
       <td style="color:#222;  " bgcolor="#dfebf4"> &nbsp; Departure Date</td>
       <td style="color:#0d6e8c;  " bgcolor="#dfebf4"> &nbsp; {{date('d/m/Y',strtotime($travel_request[0]['start_date']))}}</td>
      </tr>
      <tr>
       <td style="color:#222;  " bgcolor="#dfebf4"> &nbsp; Comments</td>
       <td style="color:#0d6e8c;  " colspan="3" bgcolor="#dfebf4"> &nbsp; {{$travel_request[0]['comment']}} </td>

      </tr>
    </table>


  
  </td>
 </tr>
 

 
 <tr>
 
 <td>


	<h4 style="font-family:Calibri; margin-top:10px; ">  &nbsp; Approval </h4>
	
    <table  width="100%" height="62" border="0"  bgcolor="#f6fbff"  cellpadding="0" cellspacing="0" align="left" style="color:#0d6e8c; font-family:Calibri; font-size:12px;  margin-left:5px;  ">
            @foreach($approval as $key => $data)
            <tr>
                @if($data->user->role_id==2)
                <td  width="20%" style="color:#222;"> &nbsp; {{$data->user->name}}(HR)</td>
                @elseif($data->user->role_id==1)
                <td width="20%" style="color:#222;"> &nbsp; {{$data->user->name}}(MD)</td>
                @endif
				
				<td width="20%" style="color:#222;">{{$approval_text}} </td>
                <td  style="color:#222; text-align:left ">: <?php if($data->comment!=''){ echo $data->comment; }else{echo '----';} ?></td>
            </tr>
            @endforeach
    </table>
    
	<br/>
	
     <table  height="62" border="0"  bgcolor="#f6fbff"  cellpadding="0" cellspacing="0" align="left"  width="100%" style="color:#0d6e8c; font-family:Calibri; font-size:12px;   border:#CCCCCC dotted thin; ">
      <tr>
       <td width="100" style="color:#222;"> &nbsp; View Request</td>
       <td  width="75" style="color:#0d6e8c; text-align:right"><img src="{{asset('img/email_images/arrow.png')}}" /> &nbsp; </td>
       <td width="100" style="color:#222; text-align:center; font-size:14px;  "><a href="{{$redirection_url}}" style="color:#000000; text-decoration:none">Click Here </a>&nbsp; </td> 
      </tr>
      
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


