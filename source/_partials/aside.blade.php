<aside>
    <div>
        @include('_partials.avatar')
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
    <h2>Lenguajes</h2>
    <ul class="pills">
        @foreach ($page->cv->languages as $language)
            <li data-highlight="{{ highlightables($language) }}">{{ $language }}</li>
        @endforeach
    </ul>
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
    <h2>Herramientas</h2>
    <ul class="pills">
        @foreach ($page->cv->tools as $tool)
            <li>{{ $tool }}</li>
        @endforeach
    </ul>
</aside>