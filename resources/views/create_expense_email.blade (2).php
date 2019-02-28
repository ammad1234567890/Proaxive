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
                            <td width="578"style="color:#333; font-family:Calibri; font-size:14px;" bgcolor="#ff9600">
                                <b> &nbsp;  {{$type}}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style=" font-size:12px;font-family:Calibri; ">
                    <table    border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="2" align="center"  width="570px" style="color:#0d6e8c; font-family:Calibri; font-size:12px;border-top:thick #FFFFFF solid;">
                        <tr valign="bottom">
                            <td width="120" style="color:#222;" bgcolor="#dfebf4"> &nbsp; Expense Claim # </td>
                            <td  width="170" style="color:#0d6e8c;" bgcolor="#dfebf4"> &nbsp; {{$travel_expense_id}}</td>
                        </tr>  					 <tr valign="bottom">
                            <td width="120" style="color:#222;" bgcolor="#dfebf4"> &nbsp; Employee # </td>
                            <td  width="170" style="color:#0d6e8c;" bgcolor="#dfebf4"> &nbsp; {{$employee}}</td>
                        </tr>
                        <tr>
                            <td style="color:#222; " bgcolor="#dfebf4"> &nbsp; Travel Purpose</td>
                            <td style="color:#0d6e8c;  " bgcolor="#dfebf4"> &nbsp; {{$purpose}}</td>
                        </tr>
                        <tr>
                            <td style="color:#222;  " bgcolor="#dfebf4"> &nbsp; Total Amount</td>
                            <td style="color:#0d6e8c;  " colspan="3" bgcolor="#dfebf4"> &nbsp; {{$amount}} </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            <tr>
                <td>
				<br>
				
                    <table  height="62" border="0"  bgcolor="#f6fbff"  cellpadding="0" cellspacing="0" align="left"  width="100%" style="color:#0d6e8c; font-family:Calibri; font-size:12px;  margin-left:5px; border:#CCCCCC dotted thin; ">
                        <tr>
                            <td width="100" style="color:#222;"> &nbsp; View Details </td>
                            <td  width="75" style="color:#0d6e8c; text-align:right"><img src="{{asset('img/email_images/arrow.png')}}" /> &nbsp; </td>
                            <td width="50" style="color:#222; text-align:center "><a href="{{$redirection_url}}" style="color:#000000; text-decoration:none">Click Here </a>&nbsp; </td> 
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
                                This is a system generated email. Please do not reply to this message.
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


