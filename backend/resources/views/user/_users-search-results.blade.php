		
<div class="row">
	@foreach ($users as $key => $value)
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<a href=" {{ url('/'.$value->linkname) }}">
					<div class="clsUserBoxes">

						<?php 
							$image = '../images/auto.png';
							$bckSize = '';
							if (isset($value->profile->image->name)){
								$image = '../../storage/profile_images'.$value->profile->image->name;
								$bckSize = 'background-size: 100px 100px;';
							}
						?>

						<div class="avatarUserBox" style="background: url(' {{ $image }} '); {{ $bckSize }}"></div>
						<div class="dataUserBox">
							<!--
							<h3>{{ $value->first_name }} {{ $value->last_name }}</h3>
							<p>{{ $value->email }}</p>
							-->
							<h3>{{ $value->display_name }} ({{ $value->linkname }})</h3>
							<p class="firstLastName">{{ $value->first_name }} {{ $value->last_name }}</p>
							<p>Member since: {{ date('l dS F Y', strtotime($value->created_at)) }}</p>
							<p>Uploaded sessions: {{ $value->sessionsCount }}</p>
						</div>
					</div>
				</a>
			</div>
	 @endforeach

	 <div style="clear:both"></div>
</div>
