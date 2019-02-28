<html>
     <head>
         <meta charset="text/html">
     </head>
    <body>
        <img src="{{asset('img/proaxive-x.ico')}}"/>
        <h4>Hi, your request status of travel# {{$info['request_no']}}</h4>
        <h3>{{$info['message_text']}}.</h3>
        <table style="border: 1px solid gray;" width="100%">
            @foreach($approval as $key => $data)
            <tr>
                <td style="width:30%;"><b>{{$data->user->name}}</b></td>
                <td style="width:70%;">: {{$data->comment}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>

