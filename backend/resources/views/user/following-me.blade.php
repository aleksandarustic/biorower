@extends('layouts.main')

@section('content')

<div class="container-fluid" id="rightColumn">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1> Following me: </h1>
			<br />

			<div class="row">
					@foreach ($allWatched as $el)
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<a href=" {{ url('/'.$el->user1->linkname) }}">
								<div class="clsUserBoxes">
									<?php 
										$image = '../images/auto.png';
										$bckSize = '';
										if (isset($el->user1->profile->image->name)){
											$image = '../../storage/profile_images'.$el->user1->profile->image->name;
											$bckSize = 'background-size: 100px 100px;';
										}
									?>
									<div class="avatarUserBox" style="background: url(' {{ $image }}'); {{ $bckSize }}"></div>
									<div class="dataUserBox">
										<h3>{{ $el->user1->display_name }} ({{ $el->user1->linkname }})</h3>
										<p class="firstLastName">{{ $el->user1->first_name }} {{ $el->user1->last_name }}</p>
										<p>Member since: {{ date('l dS F Y', strtotime($el->user1->created_at)) }}</p>
										<p>Uploaded sessions: {{ $el->user1->sessionsCount }}</p>
									</div>
								</div>
							</a>
						</div>
 					@endforeach	
 					
 					<div style="clear:both"></div>
			</div>

		</div>
	</div>	
</div>		

@endsection

