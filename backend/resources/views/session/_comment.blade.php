
<?php
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

<?php
	$hashidsComment = new Hashids(GlobalFunctions::getEncKeyForComment());
	$encodedIDComment = $hashidsComment->encode($comment->id);
?>

<div class="commentElement">

	@if ($isAdmin)
	   <a href="#"><span class="glyphicon glyphicon-remove removeComment" id="idComment-{{ $encodedIDComment }}"></span></a>
	@endif

	<div style="font-weight:bold; "><a style="text-decoration:underline !important" href="{{ url('/'.$comment->user->linkname) }}">{{ $comment->user->display_name }}</a></div>
	<div>Posted: {{ $comment->date }}</div>
	<div>{{ $comment->text }}</div>

	<hr></hr>

</div>