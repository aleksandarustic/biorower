<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

	<table class="table table-hover">
	 <tr>
	 	<th>Name <a href="#" class="sort sort-name sort-asc"><span class=" glyphicon glyphicon-triangle-bottom"></span></a><a href="#" class="sort sort-name sort-desc"><span class=" glyphicon glyphicon-triangle-top"></span></a></th>
	 	<th>Email <a href="#" class="sort sort-email sort-asc"><span class=" glyphicon glyphicon-triangle-bottom"></span></a><a href="#" class="sort sort-email sort-desc"><span class=" glyphicon glyphicon-triangle-top"></span></a></th>
	 	<th>Updated at <a href="#" class="sort sort-updated_at sort-asc"><span class=" glyphicon glyphicon-triangle-bottom"></span></a><a href="#" class="sort sort-updated_at sort-desc"><span class=" glyphicon glyphicon-triangle-top"></span></a></th>
	 </tr>
		 @foreach ($allUsers as $key => $value)
 	 	 <?php 
			$hashids = new Hashids(GlobalFunctions::getEncKey());
			$encodedID = $hashids->encode($value->id);
 	 	  ?>		 
	 	 <tr class="rowLink" data-url="{{ url( $userLinkname.'/session/'.$encodedID) }}">
		 	 <td>{{ $value->first_name }} {{ $value->last_name }}</td>
		 	 <td>{{ $value->email }}</td>
		 	 <td>{{ $value->updated_at }}</td>
	 	 </tr>
	 	@endforeach
	</table>
		{!! $allUsers->render() !!}
