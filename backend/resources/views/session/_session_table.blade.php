<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

@if (count($sessions) > 0)

	<table class="table table-hover">
	 <tr>
	 	<th>Date </th>
	 	<th>Data version </th>
	 	<th>Device type </th>
	 	<th>Serial number </th>
	 	<th>Firmware version </th>
	 	<th>Mobile agent </th>
	 	<th>Duration </th>
	 </tr>
		 @foreach ($sessions as $key => $value)
 	 	 <?php 
			$hashids = new Hashids(GlobalFunctions::getEncKey());
			$encodedID = $hashids->encode($value->id);
 	 	  ?>		 
	 	 <tr class="rowLink" data-url="{{ url( Auth::user()->linkname.'/session/'.$encodedID) }}">
		 	 <td>{{ $value->date }} </td>
		 	 <td>{{ $value->dataVersion }}</td>
		 	 <td>{{ $value->deviceType }}</td>
		 	 <td>{{ $value->serialNumber }}</td>
		 	 <td>{{ $value->firmwareVersion }}</td>
		 	 <td>{{ $value->mobileUserAgent }}</td>
		 	 <td>{{ $value->duration }}</td>
	 	 </tr>
	 	@endforeach
	</table>

@else
	<h1>No Results found within this date range. Please edit start and end dates, or upload a session.</h1>

@endif