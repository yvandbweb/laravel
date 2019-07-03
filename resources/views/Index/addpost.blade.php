<div style="float:left;width:90%">
    <h1>Add post</h1>  
    <div id="pmessage" class="me"></div><div style="clear:both"></div> 
    <form name="form" method="post" action="{{route("addformpost")}}" id="none">
    <div id="form">
        @csrf
        <div class="form-group">
            <label for="form_txt" class="required">Txt</label>
            <textarea id="form_txt" name="txt" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="required" for="form_user">User</label>
            <select id="form_user" name="user_id" class="form-control">
                @foreach ($vararr["users"] as $us)
                    <option value="{{$us->id}}">{{$us->nameuser}}</option>
                @endforeach
            </select>
        </div>
    <input type="submit" value="save post" class="btn btn-info" onclick="return posthalt()">
    </div>
    </form>   
</div>
<script>
    function posthalt(){
        $("#pmessage").html("Posting has been disabled");
        return false;
    }
    
</script>