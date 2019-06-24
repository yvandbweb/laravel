<div style="clear:both"></div>
<div class="messagesavecom{{$vararr["id"]}} me"></div>
<div style="clear:both"></div> 

<form name="form" method="post" id="formcomment">
    @csrf
    <input type="hidden" name="id" value="{{$vararr["id"]}}">
    <div id="form">
        <div class="form-group">
            <label for="form_text" class="required">Text</label>
            <textarea id="form_text" name="text"  class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="required" for="form_user">User</label>
            <select id="form_user" name="user" class="form-control">
                @foreach ($vararr["users"] as $us)
                    <option value="{{$us->id}}">{{$us->nameuser}}</option>
                @endforeach
            </select> 
        </div>
    <input type="button" class="btn btn-primary" value="Save comment" onclick="savecomment({{$vararr["id"]}})">
    <input type="button" class="btn btn-warning" value="Cancel" onclick="cancelcomment({{$vararr["id"]}})"><br>
    </div>
</form>