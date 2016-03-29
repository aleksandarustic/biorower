<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

	<table class="table table-hover">
	 <tr>
	 	<th>Name </th> <!-- <a href="#" class="sort sort-email sort-asc"><span class=" glyphicon glyphicon-triangle-bottom"></span></a><a href="#" class="sort sort-email sort-desc"><span class=" glyphicon glyphicon-triangle-top"></span></a> -->
	 	<th>Display name </th>
	 	<th> </th>
	 </tr>
		 @foreach ($users as $key => $value)
 	 	 <?php 
			$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
			$encodedID = $hashids->encode($value->id);
 	 	  ?>
	 	 <tr class="trListOfUsersForRace" data-url="">
		 	 <td><a href="{{ url('/'.$value->linkname) }}" target="_blank"> {{ $value->first_name }} {{ $value->last_name }}</a></td>
		 	 <td><a href="{{ url('/'.$value->linkname) }}" target="_blank">{{ $value->display_name }}</a></td>
		 	 <td>
                <div class="loadingGifSendRequest" style="display:none;">
                    {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
                </div>
		 	 	<a href="#" class="btn btn-default sendRequestForRace"  id="idSendRequest-{{ $encodedID }}-{{ $value->email }}">Send request</a>
		 	 </td>
	 	 </tr>
	 	@endforeach
	</table>
	
	{!! $users->render() !!}

