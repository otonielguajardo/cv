@extends('_layouts.app')

@php
	$page->title = "CV Full-stack Developer - Otoniel Guajardo"
@endphp

@section('content')
<div id="page">
	<main>
		<h1>{{$page->cv->fullName}}</h1>
		<p><strong>{{$page->cv->job}}</strong> con {{ printDuration($page->cv->start, null, false) }} de experiencia
			{!! $page->cv->bio !!}
		</p>

		<h2>Experiencia</h2>
		@foreach ($jobs->slice(0, 5) as $job)
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
					<p>{{ $job->description }}</p>
					<ul>
						@if ($loop->index <= 2)
							@foreach ($job->tasks as $task)
								<li>{!! $task !!}</li>
							@endforeach
						@endif
					</ul>
				</li>
				<ul class="pills">
					@foreach ($job->stack as $tool)
						<li data-highlight="{{ highlightables($tool) }}">{{ $tool }}</li>
					@endforeach
				</ul>
			</ul>
		@endforeach
	</main>
    @include('_partials.aside')
</div>
@endsection

@section('script')
<script>
	function printPage() {
		window.print();
	}

	document.addEventListener("DOMContentLoaded", function () {
		const elements = document.querySelectorAll("[data-highlight]");

		elements.forEach(element => {
			element.addEventListener("mouseover", function () {
				highlightMatchingElements(element, true);
			});

			element.addEventListener("mouseout", function () {
				highlightMatchingElements(element, false);
			});
		});

		function highlightMatchingElements(element, highlight) {
			const dataHighlight = element.getAttribute("data-highlight");
			const values = JSON.parse(dataHighlight);

			elements.forEach(el => {
				const elValues = JSON.parse(el.getAttribute("data-highlight"));
				const hasIntersection = values.some(value => elValues.includes(value));

				if (hasIntersection) {
					if (highlight) {
						el.classList.add("highlight");
					} else {
						el.classList.remove("highlight");
					}
				}
			});
		}
	});
</script>
@endsection