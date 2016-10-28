<!-- Box 1 -->
 @foreach($result as $res)
        <div class="col-md-3 collapse chat-box" id="chat-{{ $res->id_chat }}" data="{{$res->id}}" style="height: 340px;" >

            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border" id="accordion">
                    <h3 class="box-title"><a href="{{asset($res->display_name)}}"> {{ $res->first_name.' '.$res->last_name}}</a></h3>
                    <div class="box-tools pull-right">

                        <button class="btn btn-box-tool" data-toggle="collapse" data-target="#chat-{{$res->id_chat}}" data-parent="#chat-{{$res->id_chat}}" id="close-box-msg-{{$res->id_chat}}"><i class="fa fa-minus"></i></button>

                        <!-- <button class="btn btn-box-tool" id="id_chat-{{$res->id_chat}}" data="{{$res->id}}"><i class="fa fa-cog"></i></button>

                        <button class="btn btn-box-tool" data-toggle="remove" data-target="#chat-{{$res->id_chat}}"><i class="fa fa-times"></i></button> -->
                    </div>

                </div><!-- /.box-header -->

                <div class="chat-body" id="msg-{{$res->id}}">
                    <br><p class="text-center"> <img src="{{ URL::asset('images/ajax-refresh.gif') }}"/></p> <br>
                </div>

            </div><!--/.direct-chat -->
        </div>
<script type="text/javascript">    
    $(document).on("click", "#close-box-msg-{{$res->id_chat}}", function(){
            $("#close-box-msg-{{$res->id_chat}}").attr('id', 'open-box-msg');
    });
</script> 

@endforeach       
<!-- /.Box 1 -->

<script type="text/javascript">
var span1       = document.getElementById('num-new-msg');

$(document).on("click", "#view-box-msg", function(event){
        event.preventDefault();
        var id          = $(this).attr("data"); // get user id
        var idchat      = $(this).attr("class");
        $(this).attr('id', 'close-box-msg-'+idchat);
        
        $.post( "{{ asset('/chat-messages') }}", {id2: id, _token: $('meta[name="csrf-token"]').attr('content') }, function( data ) {
                    $( '#msg-'+id ).empty();
                    $( "#msg-"+id ).html( data );
                    var messages    = $('#id_chat-'+idchat);
                    messages.scrollTop(messages[0].scrollHeight);
        }); // end of post: /chat-messages

        $.post( "{{ asset('/view-newmsg') }}", {id2: id, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                document.getElementById('new-msg-'+id).innerHTML = '';   

                $.post( "{{ asset('/num-new-messages') }}", {_token: $('meta[name="csrf-token"]').attr('content')}, function( data ) {
                    if(data.length > 0){ span1.innerHTML = data.length; 
                    }else {span1.innerHTML = ''; }
                });        
        }); // end of post: /view-newmsg

       

}); // end click on view box msg / view chat messages 

$(document).on("click", "#open-box-msg", function(event){
        var id          = $(this).attr("data"); // get user id
        var idchat      = $(this).attr("class");

        $(this).attr('id', 'close-box-msg-'+idchat);

        var messages    = $('#id_chat-'+idchat);
        messages.scrollTop(messages[0].scrollHeight);

        $.post( "{{ asset('/view-newmsg') }}", {id2: id, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                document.getElementById('new-msg-'+id).innerHTML = '';

            $.post( "{{ asset('/num-new-messages') }}", { _token: $('meta[name="csrf-token"]').attr('content')}, function( data ) {
                    if(data.length > 0){ span1.innerHTML = data.length; 
                    }else {span1.innerHTML = ''; }
            });   
        });

   
});
</script>

<script id="chat_message_template" type="text/template">
                           <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right chat-author"></span>
                                    <span class="direct-chat-timestamp pull-left timestamp"></span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img chat-avatar" src="" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text msg-sent">
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
</script>

<script id="chat_message_template_r" type="text/template">
                           <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left chat-author"></span>
                                    <span class="direct-chat-timestamp pull-right timestamp"></span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img chat-avatar" src="" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text msg-sent"></div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
</script>

