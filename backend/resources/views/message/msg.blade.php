<div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" id="id_chat-{{$id_chat}}">
                        <!-- Message. Default to the left --> 
            @if($totalmsg > 15)
            <button class="btn btn-info btn-block" id="loadoldmsg-{{$id_chat}}" data="{{$received}}"><b> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Load older messages</b></button>
            @endif

            <div id="load-old-msg-{{$id_chat}}"></div>
                        @foreach($messages as $res)
                            @if($res->sender_user_id != Auth::user()->id)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">{{ $res->first_name.' '.$res->last_name}}</span>
                                    <span class="direct-chat-timestamp pull-right">{{$res->date_format}}</span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{{asset($res->name)}}" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    {{$res->text}}
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
                            @else
                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right"></span>
                                    <span class="direct-chat-timestamp pull-left">{{$res->date_format}}</span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{{ URL::asset(Auth::user()->profile->image->name) }}" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text msg-sent">
                                    {{$res->text}}
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
                            @endif
                        @endforeach

        </div><!--/.direct-chat-messages-->
</div><!-- /.box-body -->
<div class="box-footer">
        <!--<div class="input-group">
                <input type="text" class="input-message" name="message" placeholder="Type Message ..." class="form-control" id="input-message-{{$id_chat}}">
        </div>       -->
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="input-message-{{$id_chat}}">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat" id="send-message-{{$id_chat}}">Send</button>
                      </span>
                    </div>
</div><!-- /.box-footer-->
<script type="text/javascript">
    var msg_page_{{$id_chat}} = 1;

    $(document).on("click", "#loadoldmsg-{{$id_chat}}", function(e){
        e.preventDefault();
        var id2    = $(this).attr("data"); // get user id
        msg_page_{{$id_chat}}++;

          //$('#comm-load-more').show();
        $.post( "{{ asset('/load-old-msg') }}", {id2: id2, page: msg_page_{{$id_chat}}, total: {{$totalmsg}}, totalpage: {{$totalpage}} } ,function( data ) {
                if(data != 0){
                        $("#load-old-msg-{{$id_chat}}").prepend( data );
                        var box     =   $("#oldmsg-scroll");     
                        var topp    =   $('#id_chat-{{$id_chat}}');
                        topp.scrollTop(box[0].scrollHeight)            
                }else{
                  $("#loadoldmsg-{{$id_chat}}").hide();
                }
        });
    });

    var jqxhr = {abort: function () {}};
    var checkNewMsg{{$id_chat}} =  document.getElementById('new-msg-'+{{$received}});
    var span1{{$id_chat}} = document.getElementById('num-new-msg');

    function init{{$id_chat}}() {
        // send button click handling
        $('#send-message-{{$id_chat}}').click(sendMessage{{$id_chat}});
        $('#input-message-{{$id_chat}}').keypress(checkSend{{$id_chat}});
        $('#input-message-{{$id_chat}}').on('input', function(event) {
            jqxhr.abort();

            if($.trim($('#new-msg-{{$received}}').html()) != ''){
                jqxhr =   $.ajax({
                              url: '{{ asset('/view-newmsg') }}',
                              type: 'POST',
                              dataType: 'json',
                              data: {id2: {{$received}}},
                                success: function (data) {
                                    if(data == 200){
                                        checkNewMsg{{$id_chat}}.innerHTML = '';
                                        if(span1{{$id_chat}}.innerHTML == 1){
                                            span1{{$id_chat}}.innerHTML  = '';
                                        }else{
                                            span1{{$id_chat}}.innerHTML  = span1.innerHTML - 1;
                                        }
                                    }
                                }
                            });
               /* jqxhr = $.post( "{{ asset('/view-newmsg') }}", {id2: {{$received}}}, function(data) {
                  checkNewMsg.innerHTML = '';
                });*/
            }
        });
    }

    // Send on enter/return key
    function checkSend{{$id_chat}}(e) {
        if (e.keyCode === 13) {
            return sendMessage{{$id_chat}}();
        }
    }

    // Handle the send button being clicked
    function sendMessage{{$id_chat}}() {
        var messageText = $('#input-message-{{$id_chat}}').val();
        if(messageText.length < 1) {
            return false;
        }

        var id2       = {{$received}};
       
        // Build POST data and make AJAX request
        var data = {text: messageText, id2: id2, _token: $('meta[name="csrf-token"]').attr('content') } ;
        $('#input-message-{{$id_chat}}').val('');
        $.post('{{ asset("/chat-send-msg")}}', data).success(sendMessageSuccess{{$id_chat}});

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess{{$id_chat}}() {
        //$('#input-message-{{$id_chat}}').val('');
    }

   // Build the UI for a new message and add to the DOM
    function addMessage{{$id_chat}}(data) {

        // Create element from template and set values
        if(data.sender_user_id == {{Auth::user()->id}}){
            var el = createMessageEl{{$id_chat}}();
            el.find('.timestamp').text(data.date);
        }else{
            var el = createMessageRc{{$id_chat}}();
            el.find('.chat-author').text(data.name);
            el.find('.timestamp').text(data.date1);
        }
        el.find('.msg-sent').html(data.text);
        var avatar = "{{ asset('') }}" +data.avatar;
        el.find('.chat-avatar').attr('src', avatar);
            
        var messages = $('#id_chat-{{$id_chat}}');

        messages.append(el)
        messages.scrollTop(messages[0].scrollHeight);

    }

    // Creates an activity element from the template
    function createMessageEl{{$id_chat}}() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    function createMessageRc{{$id_chat}}() {
        var text = $('#chat_message_template_r').text();
        var el = $(text);
        return el;
    }

    $(init{{$id_chat}});

    /******************PUSHER*****************************/

    channelChat.bind('chat-msg-{{$id_chat}}', addMessage{{$id_chat}});

</script>

