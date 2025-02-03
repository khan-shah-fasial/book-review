@php

$title = 'Online Book Store';

$description = 'Online Book Store';

$page_type = 'website';

$publish_time = '2025-01-18T13:41:39+00:00';

$url = url()->current();

@endphp


<title>@php echo htmlspecialchars_decode($title) @endphp</title>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="KSFaisal">

<meta name="title" content="@php echo $title @endphp">
<meta name="description" content="@php echo $description @endphp">

<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="{{ $page_type }}">
<meta property="og:site_name" content="{{ url('') }}">
<meta property="og:locale" content="en_US">

<meta property="article:modified_time" content="{{ $publish_time }}" />



<!----------------- og tag ------------------->

<meta property="og:image" content="{{ asset('assets/frontend/images/logo.png') }}">
<meta property="og:image:width" content="500">
<meta property="og:image:height" content="500">
<meta property="og:image:type" content="image/png" />

<!----------------- og tag ------------------->

<!----------------- canonical ------------------->

<link rel="canonical" href="{{ url()->current() }}">

<!----------------- canonical ------------------->

<meta name="csrf-token" content="{{ csrf_token() }}">

<base id="baseUrl" href="{{url('')}}">