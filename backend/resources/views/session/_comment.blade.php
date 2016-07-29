
<?php
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

<?php
	$hashidsComment = new Hashids(GlobalFunctions::getEncKeyForComment());
	$encodedIDComment = $hashidsComment->encode($comment->id);
?>

 <div class='box-comment'>
                    <!-- User image -->
                    <img class='img-circle img-sm' src='dist/img/user3-128x128.jpg' alt='user image'>
                    <div class='comment-text'>
                      <span class="username">
                      <div style="font-weight:bold; "><a style="text-decoration:underline !important" href="{{ url('/'.$comment->user->linkname) }}">{{ $comment->user->display_name }}</a></div>
                        <span class='text-muted pull-right'>Posted: {{ $comment->date }}</span>
                      </span><!-- /.username -->
                    {{ $comment->text }}
                    </div><!-- /.comment-text -->
                  </div>

