
{{-- <ul class="links">
    @foreach ($subDirectories as $dir)
        <li>
            <a href="{{ url($dir->id) }}" title="{{ $dir->name }}">{{ $dir->name }}</a>
            @if (count($dir->children) > 0)
                @include('website.files',['subDirectories' => $dir->children])
            @elseif(count($dir->media) > 0)
                <ul class="links">
                    @foreach ($dir->media as $file)
                        <li>
                            <a href="{{ url($file->filepath) }}" title="{{ $file->filename }}" target="_blank">
                                {{ $file->filename }} &darr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul> --}}

@foreach ($subDirectories as $dir)
    <div class="accordion-wrap">
        <div class="accordion-title">
            <div class="folder-wrap">
                <div class="icon-box">
                    <i class="fa-solid fa-folder"></i>
                </div>
                <div class="content-box">
                    <div class="left-col">
                        <span class="title">{{ $dir->name }}</span>
                        <span class="info">{{ $dir->children->count() }} Sub Folder, {{ $dir->media->count() }} Files</span>
                    </div>
                    <div class="right-col">
                        <div class="icon-box">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.022 13.6318L13.022 20.6318L6.02197 13.6318" stroke="black" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-body">
            @if (count($dir->children) > 0)
                @include('website.files',['subDirectories' => $dir->children])
            @elseif(count($dir->media) > 0)
                <ul class="acc-list">
                    @foreach ($dir->media as $file)
                        <li>
                            <div class="acc-grid">
                                <div class="left-col">
                                    <div class="img-box">
                                        <img src="{{ url('website/images/pdf.svg') }}" alt="{{ $file->filename }}">
                                    </div>
                                    <div class="cnt-box">
                                        <span class="title text-ellipsis">{{ $file->filename }}</span>
                                    </div>
                                </div>
                                <div class="right-col">
                                    <a href="{{ url($file->filepath) }}" target="_blank" class="icon-box">
                                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.3708 16.407V20.407C22.3708 20.9374 22.1601 21.4461 21.7851 21.8212C21.41 22.1963 20.9013 22.407 20.3708 22.407H6.37085C5.84042 22.407 5.33171 22.1963 4.95664 21.8212C4.58156 21.4461 4.37085 20.9374 4.37085 20.407V16.407" stroke="#DEA444" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.37085 11.407L13.3708 16.407L18.3708 11.407" stroke="#DEA444" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.3708 16.407V4.40698" stroke="#DEA444" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endforeach


<script>
    /* Accordion S */
    var acc = document.getElementsByClassName("accordion-title");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function() {
            var panel = this.nextElementSibling;
            var coursePanel = document.getElementsByClassName("accordion-body");
            var courseAccordion = document.getElementsByClassName("accordion-title");
            var courseAccordionActive = document.getElementsByClassName("accordion-title active");
            if (panel.style.maxHeight){
                panel.style.maxHeight = null;
                this.classList.remove("active");
            } else {
                for (var ii = 0; ii < courseAccordionActive.length; ii++) {
                    courseAccordionActive[ii].classList.remove("active");
                }
                for (var iii = 0; iii < coursePanel.length; iii++) {
                    this.classList.remove("active");
                    coursePanel[iii].style.maxHeight = null;
                }
                panel.style.maxHeight = panel.scrollHeight + "px";
                this.classList.add("active");
            }
        }
    }
    /* Accordion S */
</script>
