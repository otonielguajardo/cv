@php
	$gravatarHash = hash('sha256', strtolower(trim('otonielguajardo@gmail.com')));
	$gravatarUrl = "https://gravatar.com/avatar/$gravatarHash?s=700"
@endphp

<a href="{{ $gravatarUrl }}" target="_blank">
	<img id="profile" src="{{ $gravatarUrl }}" />
</a>