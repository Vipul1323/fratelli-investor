@extends('website.layout.app')


@section('content')
<div class="section section-border who-we-are-main">
    <div class="container">
        <div class="title-sc mb-0">
            <div class="title-flex hidden-xl hidden-lg hidden-md" style="display: block !important; text-align:center !important;">
                <h2 style="margin: 10px;" href="javascript:void(0)" class="btn-link hidden-xl hidden-lg hidden-md" data-bs-toggle="offcanvas" data-bs-target="#WhoWeAreOffoffcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">{{ $settings->title }}</h2>
                <h2 style="margin: 10px;" href="javascript:void(0)" class="btn-link hidden-xl hidden-lg hidden-md" data-bs-toggle="offcanvas" data-bs-target="#boardCompositionWithBackdrop" aria-controls="offcanvasWithBackdrop">Board Composition</h2>
                <h2 style="margin: 10px;" href="javascript:void(0)" class="btn-link hidden-xl hidden-lg hidden-md" data-bs-toggle="offcanvas" data-bs-target="#ManagementProfileOffoffcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Management Profiles</h2>

            </div>
            <div class="title-flex hidden-sm hidden-xs">
                <h2 href="javascript:void(0)" class="btn-link hidden-sm hidden-xs" data-bs-toggle="modal" data-bs-target="#whoWeAreModal">{{ $settings->title }}</h2>
                <h2 href="javascript:void(0)" class="btn-link hidden-sm hidden-xs" data-bs-toggle="modal" data-bs-target="#boardCompositionModal">Board Composition</h2>
                <h2 href="javascript:void(0)" class="btn-link hidden-sm hidden-xs" data-bs-toggle="modal" data-bs-target="#managementProfileModal">Management Profiles</h2>

            </div>
            {{-- <p>As the sun set on a warm afternoon in 2006, the seeds of a new dream bloomed to life - <b>Fratelli</b>. Brought together by love and driven forward by passion, <b>Fratelli</b> is symbolic of a vision manifested by three families who aspired to tell stories through the art of winemaking...</p>
            <span class="about_us_more">
                <p>Crowned <b>Fratelli</b>, which means ‘brothers’ in Italian, the collaboration was birthed as the Secci brothers from Italy joined hands with the Sekhri and Mohite-Patil brothers from India.</p>
                <p>
                    <img src="{{ url('website/images/home-page_1500x.webp') }}" alt="">
                </p>
                <p>Committed to bringing new life to wine culture through a blend of Indian terroir and Italian craft, <b>Fratelli's</b> vineyards have become the birthplace of award winning varietals.</p>
                <p>Under the guiding hand of Piero Masi, a master winemaker from Tuscany, the estate has been developing an eclectic and select range of wines since 2007. The house of <b>Fratelli</b> continues to thrive, forging bonds through every glass of exquisite wine, turning friends into family.</p>
            </span> --}}
            {{-- <div class="btn-sc text-right">
                <a href="javascript:void(0)" class="btn-link hidden-xl hidden-lg hidden-md" data-bs-toggle="offcanvas" data-bs-target="#WhoWeAreOffoffcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Show more</a>
                <a href="javascript:void(0)" class="btn-link hidden-sm hidden-xs" data-bs-toggle="modal" data-bs-target="#whoWeAreModal">Show more</a>
            </div> --}}
        </div>
    </div>
</div>

<div class="section section-border no-top-padding-border folder-main desktop">
    <div class="container">
        <div class="title-sc">
            <div class="title-flex">
                <h2 class="main-title">Investor Documents</h2>
                <a href="{{ url('folders') }}" class="btn-link">See all</a>
            </div>
        </div>
        <div class="folder-wrapper">
            @foreach ($folders as $folder)
                <div class="folder-item  open-folder" folder="{{$folder->id}}" data-bs-toggle="modal" data-bs-target="#mediaModal">
                    <div class="folder-box">
                        <div class="icon icon-center">
                            <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.64 8.6C27.64 7.31638 27.1301 6.08533 26.2225 5.17754C25.3147 4.26989 24.0836 3.76 22.8 3.76H16.662L12.6228 0.530475C12.3894 0.34313 12.0992 0.240724 11.8 0.240005H4.31999C3.26967 0.240005 2.26251 0.657235 1.51986 1.39988C0.777215 2.14253 0.359985 3.14973 0.359985 4.20001V20.92C0.359985 22.2036 0.869872 23.4347 1.77752 24.3425C2.68531 25.2501 3.91636 25.76 5.19999 25.76H22.8C24.0836 25.76 25.3147 25.2501 26.2225 24.3425C27.1301 23.4347 27.64 22.2036 27.64 20.92L27.64 8.6ZM3.00002 4.2C3.00002 3.84995 3.1391 3.51423 3.3866 3.26658C3.63424 3.01908 3.96997 2.88 4.32002 2.88H11.338L14.088 5.08L11.338 7.28H4.32002C3.96997 7.28 3.63425 7.14093 3.3866 6.89343C3.1391 6.64578 3.00002 6.31006 3.00002 5.96V4.2ZM25 20.92C25 21.5035 24.7683 22.0631 24.3556 22.4756C23.9431 22.8883 23.3835 23.12 22.8 23.12H5.20002C4.61651 23.12 4.0569 22.8883 3.6444 22.4756C3.23176 22.0631 3.00002 21.5035 3.00002 20.92V9.7308L3.52795 9.83636C3.78848 9.89079 4.0539 9.91886 4.32002 9.92001H11.8C12.0992 9.91929 12.3894 9.81688 12.6229 9.62953L16.6621 6.40001H22.8001C23.3836 6.40001 23.9432 6.63175 24.3557 7.04439C24.7683 7.45689 25.0001 8.0165 25.0001 8.60001L25 20.92Z" fill="#1C1B1B"/></svg>
                        </div>
                        <span class="title" >{{ $folder->name }}</span>
                        {{-- <span class="info">{{ $folder->children->count() }} Sub Folder</span> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="section section-border no-top-padding-border folder-main mobile">
    <div class="container">
        <div class="title-sc">
            <div class="title-flex">
                <h2 class="main-title">Investor Documents</h2>
                <a href="{{ url('folders') }}" class="btn-link">See all</a>
            </div>
        </div>
        <div class="folder-wrapper">
            @foreach ($folders as $folder)
                <div class="folder-item open-folder" folder="{{$folder->id}}" data-bs-toggle="offcanvas" data-bs-target="#MediaoffcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                    <div class="folder-box">
                        <div class="icon icon-center">
                            <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.64 8.6C27.64 7.31638 27.1301 6.08533 26.2225 5.17754C25.3147 4.26989 24.0836 3.76 22.8 3.76H16.662L12.6228 0.530475C12.3894 0.34313 12.0992 0.240724 11.8 0.240005H4.31999C3.26967 0.240005 2.26251 0.657235 1.51986 1.39988C0.777215 2.14253 0.359985 3.14973 0.359985 4.20001V20.92C0.359985 22.2036 0.869872 23.4347 1.77752 24.3425C2.68531 25.2501 3.91636 25.76 5.19999 25.76H22.8C24.0836 25.76 25.3147 25.2501 26.2225 24.3425C27.1301 23.4347 27.64 22.2036 27.64 20.92L27.64 8.6ZM3.00002 4.2C3.00002 3.84995 3.1391 3.51423 3.3866 3.26658C3.63424 3.01908 3.96997 2.88 4.32002 2.88H11.338L14.088 5.08L11.338 7.28H4.32002C3.96997 7.28 3.63425 7.14093 3.3866 6.89343C3.1391 6.64578 3.00002 6.31006 3.00002 5.96V4.2ZM25 20.92C25 21.5035 24.7683 22.0631 24.3556 22.4756C23.9431 22.8883 23.3835 23.12 22.8 23.12H5.20002C4.61651 23.12 4.0569 22.8883 3.6444 22.4756C3.23176 22.0631 3.00002 21.5035 3.00002 20.92V9.7308L3.52795 9.83636C3.78848 9.89079 4.0539 9.91886 4.32002 9.92001H11.8C12.0992 9.91929 12.3894 9.81688 12.6229 9.62953L16.6621 6.40001H22.8001C23.3836 6.40001 23.9432 6.63175 24.3557 7.04439C24.7683 7.45689 25.0001 8.0165 25.0001 8.60001L25 20.92Z" fill="#1C1B1B"/></svg>
                        </div>
                        <span class="title" >{{ $folder->name }}</span>
                        {{-- <span class="info">{{ $folder->children->count() }} Sub Folder</span> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="section section-border no-top-padding-border stock-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 stock-col">
                <div class="title-sc">
                    <h2 class="main-title">Stock Market</h2>
                </div>
                <div class="stock-data-main" id="stockSticker">
                    {{-- <div class="data-col">
                        <div class="left-col">
                            <span class="title">NSE Stock</span>
                            <span class="price">
                                568.25
                            </span>
                        </div>
                        <div class="right-col">
                            <span class="up-down-value">7.35</span>
                            <span class="icon">
                                <img src="{{asset('/website/images/caret-up.svg')}}" alt="Caret up">
                            </span>
                            <span class="up-down-percentage">1.31%</span>
                        </div>
                    </div>
                    <div class="data-col">
                        <div class="left-col">
                            <span class="title">NIFTY</span>
                            <span class="price">
                                22403.85
                            </span>
                        </div>
                        <div class="right-col">
                            <span class="up-down-value">203.30</span>
                            <span class="icon">
                                <img src="{{asset('/website/images/caret-down.svg')}}" alt="Caret down">
                            </span>
                            <span class="up-down-percentage">0.92%</span>
                        </div>
                    </div> --}}
                </div>
                <div id="chartcontrols"></div>
                <div id="stockChart" style="min-height: 350px;"></div>
                <p class="stock-bottom-text">(Based on NSE Data)</p>
            </div>
            <div class="col-lg-6 video-col">
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
                    <iframe id="video" width="100%" height="100%" src="https://www.youtube.com/embed/yHUNPbH0dfQ?si=lH80QH1tO_qBzYRE" title="Welcome to Fratelli" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/stock.js"></script>

<script>
    var data;
    $('.about_us_more').hide();
    $(document).ready(function() {
        $('#play-video').on('click', function(ev) {
            $("#video")[0].src += "&autoplay=1";
            ev.preventDefault();
            $(this).parent().hide();
        });

        $('.expandAboutUs').click(function(){
            $('.about_us_more').slideToggle('fast');
        });

        getStockData();
        getStockSticker();
        var intervalId = window.setInterval(function(){
            getStockSticker();
            //getStockData();
        }, 60000);
    });

    function getStockSticker(){
        $.get('{{ route("get-stock-sticker") }}', function(response){
            $('#stockSticker').html(response.sticker)
        });
    }

    function getStockData(){
        $.post('{{ route("stock-data") }}', {}, function(response){
            data = response;

            loadChart();
        });
    }

    function loadChart(){
        var root = am5.Root.new("stockChart");
        var stockChart = root.container.children.push(am5stock.StockChart.new(root, {}));

        var mainPanel = stockChart.panels.push(am5stock.StockPanel.new(root, {
            wheelY: "zoomX",
            panX: true,
            panY: true,
            height: am5.percent(30),
            wheelZoomPositionX: null
        }));

        var valueAxis = mainPanel.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {}),
        }));

        var dateAxis = mainPanel.xAxes.push(am5xy.DateAxis.new(root, {
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {})
        }));

        var valueSeries = mainPanel.series.push(am5xy.LineSeries.new(root, {
            name: "TINNATF",
            valueXField: "Date",
            valueYField: "Close",
            xAxis: dateAxis,
            yAxis: valueAxis,
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}",
            }),
            legendValueText: "{valueY}"
        }));

        valueSeries.data.setAll(data);

        stockChart.set("stockSeries", valueSeries);

        var valueLegend = mainPanel.plotContainer.children.push(am5stock.StockLegend.new(root, {
            stockChart: stockChart
        }));
        valueLegend.data.setAll([valueSeries]);

        mainPanel.set("cursor", am5xy.XYCursor.new(root, {
            yAxis: valueAxis,
            xAxis: dateAxis,
            snapToSeries: [valueSeries],
            snapToSeriesBy: "y",
            behavior: "zoomX"
        }));



        var toolbar = am5stock.StockToolbar.new(root, {
            container: document.getElementById("chartcontrols"),
            stockChart: stockChart,
            controls: [
                am5stock.PeriodSelector.new(root, {
                    stockChart: stockChart,
                    zoomTo: "end",
                    periods: [
                        { timeUnit: "day", count: 1, name: "1D" },
                        { timeUnit: "day", count: 5, name: "5D" },
                        { timeUnit: "month", count: 1, name: "1M" },
                        { timeUnit: "month", count: 6, name: "6M" },
                        { timeUnit: "year", count: 1, name: "1Y" },
                        { timeUnit: "year", count: 2, name: "2Y" },
                        { timeUnit: "year", count: 5, name: "5Y" },
                        { timeUnit: "max", name: "Max" },
                    ]
                }),
                // am5stock.ResetControl.new(root, {
                //     stockChart: stockChart
                // }),
            ]
        })

    }
</script>
@endsection
