
@extends('layouts.full')

@section('head-script')
	    <!-- <link rel="canonical" href="{{ Request::url() }}" /> -->

	    <meta property="fb:app_id" content="507802702573516" />
    	<meta property="og:title" content="neki drugi title"/>
	    <meta property="og:type"  content="article" /> 
	    <meta property="og:url" content="http://www.servistest88.byethost6.com/public/home/api-docs"/> 
    	<meta property="og:description" content="neka druga descripcija"/>
@endsection

@section('content')
<div class="container-fluid" id="rightColumn">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
			@include('home.apiMenu')
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
			<h1>API Docs</h1>
			<p>These docs are for iOS/Android apps and the WBPC.</p>

			<h3>Base URL</h3>
			<div class="alert alert-info" role="alert"><span class="clsApiAlertContent">https://www.braining.com/api/v1</span></div>

			<hr></hr>

			<h3>App Access</h3>
			<p>All API requests must be made over https. Send your App key as an X-API-KEY header with your https request.</p>
			<div class="alert alert-info" role="alert"><span class="clsApiAlertContent">X-API-KEY: 3b3c72496736716e4b742a745c392d30</span></div>

			<hr></hr>

			<h3>Input Formats</h3>
			<p>The API accepts json by default.</p>

			<p>Other formats can be accepted i.e. xml if the correct mime type is supplied in the Content-Type header:</p>
			<div class="alert alert-info" role="alert"><span class="clsApiAlertContent">Content-type: application/xml</span></div>

			<hr></hr>
			
			<!--
				Responses
				Available response formats:

				    json(default)
				    xml

				The response format can be changed by passing the correct mime-type in the Accept header:
				Accept: application/xml


				Note: The Accept header will also be used for versioning in the future
				Accept: application/xml+vx.x.x
			-->

			<h2>The Process</h2>
			<h3>First Time Use</h3>
				<ol>
				    <li>New users will pick to either Sign-In or Register</li>
				    <li>App sends the API the user's email and password</li>
				    <li>If successful the API returns an authenticationToken</li>
				    <li>User does a WB session</li>
				    <li>The App sends API session data including 'account' field i.e. users email</li>
				    <li>If successful the API returns a sessionId</li>
			    </ol>

			<h3>Current Users</h3>
				<ol>
			    	<li>App sends api the saved authentication token</li>
			    	<li>If still valid the API returns the authentication token and the user's 'account' parameter</li>
			    	<li>User does a WB session</li>
			    	<li>App sends the API the user's session data including 'account' field i.e. users email</li>
			    	<li>If successful the API returns a sessionId</li>
			    </ol>

			<hr></hr>

			<h2>Endpoints</h2>
			<h3>Account Registration</h3>
			<p>If the user doesn't already have an account you can create a new one with this endpoint. If their email is already on the system you will get a 409 conflict error.</p>
			 
			<div class="alert alert-info" role="alert"><span class="clsApiAlertMethod">POST</span> <span class="clsApiAlertContent">https://www.braining.com/api/v1/</span><span class="clsApiMethod">adduser</span></div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Required</th>
						<th>Description</th>
					</tr>
					<tr>
						<td>emailAddress</td>
						<td>YES</td>
						<td>User's email address</td>
					</tr>
					<tr>
						<td>password</td>
						<td>YES</td>
						<td>User's password(6-20 chars)</td>
					</tr>				
				</table>
				</div>
			</div>

			<h3>Response</h3>
			<p>201</p>
			
			<p>Error Code - 409</p>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Value</th>
					</tr>
					<tr>
						<td>authenticationToken</td>
						<td>jg75je8fhw46fhw01mg75je8fhw46f54</td>
					</tr>
				</table>
				</div>
			</div>

			<hr></hr>
	
			<h3>Account Sign-In</h3>
			<p>If a user already has an account you can log them in from this endpoint. </p>

			<div class="alert alert-info" role="alert"><span class="clsApiAlertMethod">POST</span> <span class="clsApiAlertContent">https://www.braining.com/api/v1/</span><span class="clsApiMethod">users</span></div>			

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Required</th>
						<th>Description</th>
					</tr>
					<tr>
						<td>emailAddress</td>
						<td>YES</td>
						<td>User's email address</td>
					</tr>
					<tr>
						<td>password</td>
						<td>YES</td>
						<td>User's password</td>
					</tr>				
				</table>
				</div>
			</div>			

			<h3>Response</h3>
			<p>200</p>
			
			<p>Error Code - 409</p>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Value</th>
					</tr>
					<tr>
						<td>authenticationToken</td>
						<td>jg75je8fhw46fhw01mg75je8fhw46f54</td>
					</tr>
				</table>
				</div>
			</div>
			
			<hr></hr>

			<h2>Authentication Token Verification</h2>
			<p>Once the user has created an account or signed into their current account you will be sent an authorisation token to store with the app. This will need to be sent when the app starts up to see if the user needs to log in again due to inactivity. Currently tokens last for 30days from last use.</p>

			<div class="alert alert-info" role="alert"><span class="clsApiAlertMethod">POST</span> <span class="clsApiAlertContent">https://www.braining.com/api/v1/</span><span class="clsApiMethod">auths</span></div>			

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Type</th>
						<th>Required</th>
					</tr>
					<tr>
						<td>authenticationToken</td>
						<td>string</td>
						<td>jg75je8fhw46fhw01mg75je8fhw46f54</td>
					</tr>
				
				</table>
				</div>
			</div>		



			<h3>Response</h3>
			<p>200</p>
			
			<p>Error Code - 400</p>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Value</th>
					</tr>
					<tr>
						<td>authenticationToken</td>
						<td>jg75je8fhw46fhw01mg75je8fhw46f54</td>
					</tr>
					<tr>
						<td>account</td>
						<td>name@domain.com</td>
					</tr>					
				</table>
				</div>
			</div>

			<hr></hr>	


			<h2>Session Data Feed</h2>
			<p>Here you can send the session data itself.</p>

			<div class="alert alert-info" role="alert"><span class="clsApiAlertMethod">POST</span> <span class="clsApiAlertContent">https://www.braining.com/api/v1/</span><span class="clsApiMethod">sessions</span></div>			

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Required</th>
						<th>Type</th>
						<th>Description</th>
					</tr>
					<tr>
						<td>account</td>
						<td>YES</td>
						<td>string</td>
						<td>Login 'type' facebook|twitter|wattbike followed by unique identifier i.e. wattbike:email@domain, twitter:twitter_userid, facebook:facebook_id</td>
					</tr>
					<tr>
						<td>data</td>
						<td>YES</td>
						<td>string</td>
						<td>As per data version</td>
					</tr>

				</table>
				</div>
			</div>		



			<h3>Response</h3>
			<p>201</p>
			
			<p>Error Code - 400</p>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<table class="table table-striped ">
					<tr>
						<th>Field</th>
						<th>Value</th>
					</tr>
					<tr>
						<td>sessionId</td>
						<td>jg75je8fhw46fhw01mg75je8fhw46f54</td>
					</tr>
			
				</table>
				</div>
			</div>

			<hr></hr>	

		</div>		
	</div>
</div>
@endsection
