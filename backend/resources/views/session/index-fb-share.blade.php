@extends('layouts.full')

@section('head-script')
	    <!-- <link rel="canonical" href="{{ Request::url() }}" /> -->

	    <meta property="fb:app_id" content="507802702573516" />
    	<meta property="og:title" content="{{ $og_title }}"/>
	    <meta property="og:type"  content="article" /> 
	    <meta property="og:url" content="{{ Request::url() }}"/> 
    	<meta property="og:description" content="{{ $og_description }}"/>
    	<meta property="og:image" content="http://www.servistest88.byethost6.com/public/images/beta.png"/>
@endsection