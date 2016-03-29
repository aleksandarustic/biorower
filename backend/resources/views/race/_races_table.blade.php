<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

	<?php
		$haveRequestRecords = false;
		$haveAcceptedRecords = false;
	?>

	@foreach ($races as $key => $value)
	 	 @if ($type == 'request')
	 	 	@if ($value->accepted == 0)
	 	 		<?php $haveRequestRecords = true ?>
	 	 	@endif
	 	 @elseif ($type == 'accepted')
	 	 	@if ($value->accepted == 1)
	 	 		<?php $haveAcceptedRecords = true ?>
	 	 	@endif
	 	 @endif	
	@endforeach

	@if (count($races) > 0)
	    @if (($type == 'request' && $haveRequestRecords) || ($type == 'accepted' && $haveAcceptedRecords) || $type == 'archive')
			<table class="table table-hover">
				<tr>
					<th>Name </th>
					<th>Date </th>
					<th></th>
				</tr>
				@foreach ($races as $key => $value)
			 	 	 <?php
						$hashids = new Hashids(GlobalFunctions::getEncKeyRaceId());
						$encodedID = $hashids->encode($value->id);
			 	 	  ?>
				 	 <tr class="" data-url="">
				 	 	 @if ($type == 'archive')
				 	 	 	<td><a href="#"> {{ $value->name }} </a></td>
				 	 	 	<td>{{ $value->date }}</td>
					 	 @elseif ($type == 'request')
					 	 	@if ($value->accepted == 0)
						 	 	<td>{{ $value->name }}</td>
						 	 	<td>{{ $value->date }}</td>
						 	 	<td style="text-align:right;"><a href="#" class="btn btn-default clsAcceptRace" id="idAcceptRace-{{ $encodedID }}">Accept</a><a href="#" class="btn btn-default clsCancelRace" id="idCancelRace-{{ $encodedID }}">Cancel</a></td>
					 	 	@endif
					 	 @elseif ($type == 'accepted')
					 	 	@if ($value->accepted == 1)
						 	 	<td><a href="{{ url('/race/live?id='.$encodedID) }}"> {{ $value->name }} </a></td>
						 	 	<td>{{ $value->date }}</td>
					 	 	@endif
					 	 @endif
				 	 </tr>
			 	@endforeach
			</table>
		@else
			<hr></hr>
			<h5>No races found.</h5>
			<hr></hr>
	    @endif
	@else
		<h5>No races found.</h5>
	@endif
