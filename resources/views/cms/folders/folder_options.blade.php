<ul>
    @foreach ($folders as $folder)
        @php
            $jsTree = [
                'opened' => true,
                'selected' => $folder->id == $selected
            ]
        @endphp
        <li data-jstree='{{ json_encode($jsTree) }}' id="{{ $folder->id }}"> {{ $folder->name }}
            @if (count($folder->children) > 0)
                @include('cms.folders.folder_options', ['folders' => $folder->children, 'selected' => $selected])
            @endif
        </li>
    @endforeach
</ul>
