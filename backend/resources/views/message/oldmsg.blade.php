<div id="oldmsg-scroll">
@foreach($messages as $res)
                            @if($res->sender_user_id != Auth::user()->id)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">{{ $res->first_name.' '.$res->last_name}}</span>
                                    <span class="direct-chat-timestamp pull-right">{{$res->date}}</span>
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
                                    <span class="direct-chat-timestamp pull-left">{{$res->date}}</span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{{ URL::asset(Auth::user()->profile->image->name) }}" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text msg-sent">
                                    {{$res->text}}
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
                            @endif
@endforeach
</div>