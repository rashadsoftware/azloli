<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<meta name="csrf-token" content="{{ csrf_token() }}" />
		
		@php $data=DB::table('configs')->where('config_id', 1)->first() @endphp
		<title>{{$data->config_title}} | Realtime Chat App</title>
		@if($data->config_favicon == '')
			<link rel="icon" href="{{asset('front/')}}/img/favicon.png">
		@else
			<link rel="icon" href="{{asset('front/')}}/img/{{$data->config_favicon}}">
		@endif
		
		<link rel="stylesheet" href="{{asset('chat/')}}/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{asset('chat/')}}/css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
	</head>