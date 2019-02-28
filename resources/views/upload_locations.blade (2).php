<form enctype="multipart/form-data" method="post" action="{{url('upload_locations')}}">

    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
    <input type="file" name="locations"/>
    <input type="submit" value="submit"/>
</form>