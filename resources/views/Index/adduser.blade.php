<div style="float:left;width:90%;margin-left:4%;">
    <h1>Add user</h1>  
    <div id="umessage" class="me"></div><div style="clear:both"></div><br>    
    <form name="form" method="post" action="{{route("addformuser")}}" id="none">
         @csrf
        <div id="form">
            <div class="form-group">
                <label for="form_nameuser" class="required">Nameuser</label>
                <input type="text" id="form_nameuser" name="nameuser" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" id="form_submit" name="" onclick="return userhalt()" class="btn-success btn">Submit</button>
            </div>
        </div>        
    </form>   
</div>

<script>
    function userhalt(){
        $("#umessage").html("Adding users has been disabled");
        return false;
    }
    
</script>