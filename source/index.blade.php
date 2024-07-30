@extends('_layouts.app')

@php
	$page->title = "CV Full-stack Developer - Otoniel Guajardo"
@endphp

@section('content')
<div id="page">
	<main>
		<h1>{{$page->cv->fullName}}</h1>
		<p><strong>{{$page->cv->job}}</strong> con {{ printDuration($page->cv->start, null, false) }} de experiencia
			{{$page->cv->bio}}
		</p>

		<h2>Experiencia</h2>
		@foreach ($jobs->slice(0, 4) as $job)
			<ul>
				<li class="job">
					<h3>
						<strong>{{ $job->role }}</strong> <small><a target="_blank"
								href="{{ $job->url }}"><span>@</span>{{ $job->company }}</a></small>
					</h3>
					<p>
						<span class="uppercase">{{ printDuration($job->start, $job->end, true) }}</span>
						<span class="uppercase muted">/ {{ printDateRange($job->start, $job->end) }}</span>
						<span class="uppercase muted">• {{ $job->type }}</span>
					</p>
					@if (!empty($job->description))
						<p>{{$job->description}}</p>
					@endif
					<ul>
						@if ($loop->index <= 1)
							@foreach ($job->tasks as $task)
								<li>{!! $task !!}</li>
							@endforeach
						@endif
					</ul>
				</li>
			</ul>
		@endforeach

		<h2>Certificaciones</h2>
		@foreach ($page->cv->certifications as $certification)
			<ul>

				<li>
					<h3><strong><a target="_blank" href="{{ $certification->url }}">{{ $certification->title }}</a></strong></h3>
					<span>{{ $certification->name }}</span>
					<p>
						<small class="uppercase muted">{{ printDate($certification->end, 'Y') }}</small>
					</p>
				</li>
			</ul>
		@endforeach

		<h2>Formación</h2>

		@foreach ($page->cv->schools as $school)
			<ul>
				<li class="school">
					<h3><strong>{{ $school->title }}</strong></h3>
					<span>{{ $school->name }}</span>
					<p>
						<small class="uppercase muted">{{ printDateRange($school->start, $school->end, false) }}</small>
					</p>
				</li>
			</ul>
		@endforeach
	</main>
	<aside>
		<div>
			<a href="/assets/images/picture.png" target="_blank">
				<img src="/assets/images/picture.png" />
			</a>
		</div>
		<div v-if="$page->cv->links">
			<p>{{ printDuration($page->cv->birthdate, null, false) }}</p>
			<p>{{$page->cv->city}}, {{$page->cv->country}}</p>
			@foreach ($page->cv->links as $link)
				<p><a href="{{ $link->url }}" target="_blank"><small>{{ $link->label }}</small></a></p>
			@endforeach
		</div>
		<h2>Habilidades</h2>
		<ul class="pills">
			@foreach ($page->cv->skills as $skill)
				<li>{{ $skill }}</li>
			@endforeach
		</ul>
		<h2>Expertís</h2>
		<ul class="pills">
			@foreach ($page->cv->tools as $tool)
				<li>{{ $tool }}</li>
			@endforeach
		</ul>
		<h2>Experiencia adicional</h2>
		<ul class="pills">
			@foreach ($page->cv->extraTools as $tool)
				<li>{{ $tool }}</li>
			@endforeach
		</ul>
		<p>
			<i>{{$page->cv->quote}}</i>
		</p>
	</aside>
</div>
@endsection

@section('script')
<script>
	function printPage() {
		window.print();
	}
</script>
@endsection