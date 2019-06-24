@extends('layouts') 
@section('content')
  <style>
        .two{
            height:150px;
        }
        .page-item{
            cursor:pointer;
        }
  </style><br/>
   @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
   @endif    
  <div style="float:left;width:45%">
      @inject('Index', 'App\Http\Controllers\Index')
     {!! $Index->addpost() !!}
  </div>
  <div style="float:left;width:45%;margin-left:4%;">
     {!! $Index->adduser() !!}
  </div>
  
  <div style="clear:both"></div>
  <nav aria-label="Page navigation example">
      <ul class="pagination">
          @if ($vararr["total"]!=0)     
            
            @for ($i = 0; $i < $vararr["totalrest"]; $i++)
                    <li class="page-item @if ($vararr['i1'] == $i+1) active @endif"><span class="page-link" onclick="listingpagination({{$i+1}})" >{{$i+1}}</span></li>
            @endfor          
            
          @endif
      </ul>
  </nav>    
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody> 
      @foreach ($vararr["posts"] as $p)
      <tr>
          <td>
              <div style="clear:both"></div>
              <div class="messageprod{{$p->id}} me"></div>
              <div style="clear:both"></div>                
              <button type="button" class="btn btn-danger" onclick="deletepost({{$p->id}})">Delete post</button> <b>{{$p->user->nameuser}}</b> <i>member since</i> {{$p->user->datetime}} <br/><br/></td>
      </tr>
      <tr>    
          <td class="two"><i>posted on</i> <b>{{$p->datetime }}</b><br/><br/>
        {{$p->txt}}
        <br>  
        <div class="alert-danger" id="errorajax{{$p->id}}">
        </div>
            <span onclick="showcomments({{$p->id}})" class="butsh" id="hideview{{$p->id}}"><u>View {{count($p->comments)}} comments</u></span>
            <span onclick="hidecomments({{$p->id}})" class="butshide" id="viewhide{{$p->id}}" ><u>Hide {{count($p->comments)}} comments</u></span>
            <div id="shhide{{$p->id}}" class="shhide">        
            @foreach ($p->comments as $c)
                <div style="clear:both"></div>
                <div class="messagecom{{$c->id}} me"></div>
                <div style="clear:both"></div>             
                <button type="button" class="btn btn-danger" onclick="deletecomment({{$c->id}})">Delete</button> <b>{{$c->user->nameuser }} commented on {{$c->datetime}}</b> {{$c->text}} <br/>
            @endforeach                    
            <div id="txt{{$p->id}}"></div> 
            <div id="comment{{$p->id}}"></div>            
            <br/><input type="button" value="add comment" id="but{{$p->id}}" onclick="addcomment({{$p->id}})" type="button" class="btn btn-primary">
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>  
  
      <script>
          
        function showcomments(i){
            document.getElementById("shhide"+i).style.display="block";
            document.getElementById("hideview"+i).style.display="none";
            document.getElementById("viewhide"+i).style.display="block";
        }  
          
        function hidecomments(i){
            document.getElementById("shhide"+i).style.display="none";
            document.getElementById("hideview"+i).style.display="block";
            document.getElementById("viewhide"+i).style.display="none";
        }            
          
        function listingpagination(z){
            window.location.href="{{route('default')}}?i1="+z;
         }
         
         function addcomment(id){
           $('#errorajax'+id).html("");
            $.ajax("{{route('addcomment')}}",{
                     type: 'GET',
                    data: {
                        id:id
                    },             
               success: function(data) {
                   $("#but"+id).hide();
                   $("#comment"+id).html(data);
               }
            });              
         }
         
         function savecomment(id){
           $(".messagesavecom"+id).html("Saving comments has been disabled");
            /*
            var a=$('#formcomment').serialize();
            $('#errorajax'+id).html("");
            //alert($('#formcomment').serialize());
            //alert(a);
            $.ajax("{{route('addformcoment')}}",{
                     type: 'POST',
                     data: $('#formcomment').serialize()
,
                error: function( json )
                {
                    if(json.status === 422) {
                        var errors = json.responseJSON;
                        $.each(json.responseJSON, function (key, value) {
                            if (value.text!=undefined){
                                $('#errorajax'+id).html($('#errorajax'+id).html()+value.text);
                            }
                        });
                    }
                },
               success: function(data) {
                   if (data.saved==true){
                        tmp1='<button type="button" class="btn btn-danger" onclick="deletecomment('+data.idcom+')">Delete</button>';                      
                        $("#txt"+id).html($("#txt"+id).html()+tmp1+" "+data.user+" "+" "+data.datetime+" "+data.text+"<br/>");
                        $("#but"+id).show();
                        $("#comment"+id).html("");
                   }
               }
            });    
            */
         } 
         
         function cancelcomment(id){
            $("#but"+id).show();
            $("#comment"+id).html(""); 
            $('#errorajax'+id).html("");
         }
         
         function deletecomment(id){
             $(".messagecom"+id).html("Deleting comments has been disabled");
             //window.location.href="{{ route('deletecomment') }}?id="+id;
         }
         
         function deletepost(id){
             $(".messageprod"+id).html("Deleting comments has been disabled");
             //window.location.href="{{route('deletepost')}}?id="+id;
         }                 
         
      </script>  
      
@endsection   