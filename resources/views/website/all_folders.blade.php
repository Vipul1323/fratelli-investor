@extends('website.layout.app')


@section('content')
<div class="breadcrumbs-main">
    <div class="container">
        <ul class="breadcrumbs-list">
            <li>
                <a href="javascript:void(0)">Investor relations</a>
            </li>
            <li>
                <span>Folders</span>
            </li>
        </ul>
    </div>
</div>

<div class="section no-top-padding folder-list-main">
    <div class="container">
        <div class="row folder-row">
            @foreach ($folders as $folder)
                <div class="col-md-6">
                    <a href="javascript:void(0)" folder="{{$folder->id}}" class="folder-wrap open-folder">
                        <div class="icon-box">
                            <i class="fa-solid fa-folder"></i>
                        </div>
                        <div class="content-box">
                            <div class="left-col">
                                <span class="title">{{ $folder->name }}</span>
                                <span class="info">{{ $folder->children->count() }} Sub Folder, {{ $folder->media->count() }} Files</span>
                            </div>
                            <div class="right-col">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.13184 12.478H19.1318" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.1318 5.47804L19.1318 12.478L12.1318 19.478" stroke="black" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
