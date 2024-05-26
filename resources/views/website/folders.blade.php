@php
    $folders = \App\Models\Category::whereNull('parent_id')->get();
@endphp

<ul class="links">
    @foreach ($folders as $folder)
    <li>
        <a href="{{ url($folder->id) }}" title="{{ $folder->name }}">{{ $folder->name }}</a>
    </li>
    @endforeach
</ul>
