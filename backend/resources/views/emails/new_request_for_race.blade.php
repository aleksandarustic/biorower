
<?php $img = $message->embed(Request::root()."/images/accept_button.png") ?>

User {{ $senderDisplayName }} @if ($senderFirstName !="" || $senderLastName !="") ({{ $senderFirstName }}  {{$senderLastName}}) @endif send you request for race with starting time at {{ $raceTime }}. You can accept request on the following link: <a href="{{ $linkAccept }}" alt="Accept"><img src="{{ $img }}" /></a>

