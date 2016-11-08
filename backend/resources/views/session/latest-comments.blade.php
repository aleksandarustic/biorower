 @foreach($comments as $comm)
 <div class='box-comment'>
                    <!-- User image -->
          <img class='img-circle img-sm' src='{{asset($comm->name)}}' alt='user image'>
              <div class="comment-text">
                      <span class="username">{{$comm->first_name}} {{$comm->last_name}}
                        <span class="text-muted pull-right">
                       	 <a href="javascript:void(0)" data-toggle="comm-timetip" data-placement="top" title="{{$comm->date_format}}">{{$comm->time_ago}}</a>
                       	 <br> 
                       	@if($comm->user_id == Auth::user()->id)
                       	 <i class="fa fa-trash-o margin-r-5 comm-delete" id="{{$comm->id}}"></i>
                       	@endif  </span>                     
                      </span><!-- /.username -->
                      {{$comm->text}}
              </div><!-- /.comment-text -->
</div>
@endforeach

<script type="text/javascript">
	    $('[data-toggle="comm-timetip"]').tooltip();
/*** Delete comment */
$(".comm-delete").unbind().click(function() {
	var idc		= 	$(this).attr('id');
	var e 		=	$(this).closest('div.box-comment');

vex.dialog.confirm({
    message: 'Are you sure you want to delete comment?',
    callback: function (value) {
        if (value) {
        		$.ajax({ 
				        type: 			'POST', 
				        dataType: 		'json',
				        url : 			'{{asset("/deleteComment")}}',
				        data: {id: idc}, 
				        success: function (dataDC) {
				        	if(dataDC == 200) e.remove();				       
			    		} // success
    			}); // end ajax
        } else {
        	console.log('Cancel delete comment');
        }
    }
}) // vex dialog confirm
}); /* Delete comment - ./click */  
</script>