
@foreach ($sessionUser->comments as $comment)
	@include('/session/_comment', array('comment' => $comment))
@endforeach
