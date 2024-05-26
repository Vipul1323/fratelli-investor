@extends('website.layout.app')


@section('content')
<div class="section who-we-are-main">
    <div class="container">
        <div class="title-sc mb-0">
            <div class="title-flex">
                <h2 class="main-title">{{ $settings->title }}</h2>
                <a href="javascript:void(0)" class="btn-link" data-bs-toggle="modal" data-bs-target="#whoWeAreModal">Show more</a>
            </div>
            <p>
                {!! substr($settings->description, 0, 300) !!} ...
            </p>
        </div>
    </div>
</div>

<div class="section no-top-padding folder-main">
    <div class="container">
        <div class="title-sc">
            <div class="title-flex">
                <h2 class="main-title">Folders</h2>
                <a href="{{ url('folders') }}" class="btn-link">See all</a>
            </div>
        </div>
        <div class="folder-wrapper">
            @foreach ($folders as $folder)
                <div class="folder-item open-folder" folder="{{$folder->id}}">
                    <div class="folder-box">
                        <div class="icon icon-center">
                            <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.64 8.6C27.64 7.31638 27.1301 6.08533 26.2225 5.17754C25.3147 4.26989 24.0836 3.76 22.8 3.76H16.662L12.6228 0.530475C12.3894 0.34313 12.0992 0.240724 11.8 0.240005H4.31999C3.26967 0.240005 2.26251 0.657235 1.51986 1.39988C0.777215 2.14253 0.359985 3.14973 0.359985 4.20001V20.92C0.359985 22.2036 0.869872 23.4347 1.77752 24.3425C2.68531 25.2501 3.91636 25.76 5.19999 25.76H22.8C24.0836 25.76 25.3147 25.2501 26.2225 24.3425C27.1301 23.4347 27.64 22.2036 27.64 20.92L27.64 8.6ZM3.00002 4.2C3.00002 3.84995 3.1391 3.51423 3.3866 3.26658C3.63424 3.01908 3.96997 2.88 4.32002 2.88H11.338L14.088 5.08L11.338 7.28H4.32002C3.96997 7.28 3.63425 7.14093 3.3866 6.89343C3.1391 6.64578 3.00002 6.31006 3.00002 5.96V4.2ZM25 20.92C25 21.5035 24.7683 22.0631 24.3556 22.4756C23.9431 22.8883 23.3835 23.12 22.8 23.12H5.20002C4.61651 23.12 4.0569 22.8883 3.6444 22.4756C3.23176 22.0631 3.00002 21.5035 3.00002 20.92V9.7308L3.52795 9.83636C3.78848 9.89079 4.0539 9.91886 4.32002 9.92001H11.8C12.0992 9.91929 12.3894 9.81688 12.6229 9.62953L16.6621 6.40001H22.8001C23.3836 6.40001 23.9432 6.63175 24.3557 7.04439C24.7683 7.45689 25.0001 8.0165 25.0001 8.60001L25 20.92Z" fill="#1C1B1B"/></svg>
                        </div>
                        <a href="javascript:void(0)" class="title">{{ $folder->name }}</a>
                        <span class="info">{{ $folder->children->count() }} Sub Folder</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="section no-top-padding stock-main">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="title-sc">
                    <h2 class="main-title">Stock Market</h2>
                </div>
            <div id="stock_sticker"></div>
            </div>
            <div class="col-md-5">
                <div class="title-sc">
                    <h2 class="main-title">What's new</h2>
                </div>
                <div class="video-sc">
                    <div class="overlay-sc">
                        <img src="https://fratelliwines.in/cdn/shop/files/story_banner_vineyard_1500x.jpg" alt="Fratelli">
                        <div class="icon-sc" id="play-video">
                            <svg class="Icon Icon--play" role="presentation" viewBox="0 0 24 24"><path d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm-2 15.5V9l4.5 3.25L10 15.5z" fill="#ffffff"></path></svg>
                        </div>
                    </div>
                    <iframe id="video" width="100%" height="100%" src="https://www.youtube.com/embed/yHUNPbH0dfQ" title="Welcome to Fratelli" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var data;
    $(document).ready(function() {
        $('#play-video').on('click', function(ev) {
            $("#video")[0].src += "&autoplay=1";
            ev.preventDefault();
            $(this).parent().hide();
        });
        getStockData();
    });

    function getStockData(){
            $.post('{{ route("stock-data") }}', {}, function(response){
                data = response;

                loadChart();
            });
        }

        function loadChart(){
            var options = {
                series: [{
                    name: 'TINNATFL',
                    data: data
                }],
                chart: {
                    type: 'area',
                    stacked: false,
                    height: 350,
                    zoom: {
                        type: 'x',
                        enabled: true,
                        autoScaleYaxis: true
                    },
                    toolbar: {
                        autoselected: 'zoom',
                        show: true,
                        tools: {
                            download: false,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: false,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 0,
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0,
                        opacityTo: 0,
                        stops: [0, 90, 100]
                    },
                },
                xaxis: {
                    type: 'datetime',
                },
            };

            var chart = new ApexCharts(document.querySelector("#stock_sticker"), options);
            chart.render();
        }
</script>
@endsection
