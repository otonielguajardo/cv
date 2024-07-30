<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
<head>
	@include('_partials.head')
</head>
<body class="classic">
	@yield('content')
	
	@include('_partials.menu')

	@yield('script')
</body>
</html>