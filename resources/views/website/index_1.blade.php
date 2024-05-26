<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                min-width: 80%;
            }

            .title {
                font-size: 50px;
            }

            .links {
                list-style: none;
                text-align: left;
            }

            .links > li {
                padding-top: 5px;
            }

            .links > li > a{
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .w-40{
                width: 40%;
                border: 1px solid black;
            }
            .w-50{
                width: 50%;
                border: 1px solid black;
            }
            .w-60{
                width: 60%;
                border: 1px solid black;
            }
            .w-70{
                width: 70%;
                border: 1px solid black;
            }

            .w-100{
                width: 100%;
            }

            .row{
                width: 100%;
                display: flex;
                margin-top: 10px;
            }

            .breadcrumb{
                display: flex;
                font-size: 12px;
                text-transform: capitalize;
                list-style: none;
            }

            /* .breadcrumb-item{
                margin-left: 15px;
                margin-right: 10px;
            } */

            .breadcrumb-item::after{
                content: " > ";
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>
                <div class="row">
                    <div class="w-40">
                        @include('website.folders')
                    </div>
                    <div class="w-60">
                        <ul class="breadcrumb">
                            @foreach ($breadCrumbsArray as $key => $folder)
                                <li class="breadcrumb-item">
                                    <a href="{{ url($key) }}" title="{{ $folder }}">{{ $folder }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div>
                            @isset($subDirectory)
                                @include('website.files', ['subDirectories' => $subDirectory])
                            @endisset
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="w-50" id="stock_ticker"></div>
                    <div class="w-50">
                        <iframe width="550" height="350" src="https://www.youtube.com/embed/yHUNPbH0dfQ" title="Welcome to Fratelli" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {

            var data;

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
                        autoSelected: 'zoom'
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

            var chart = new ApexCharts(document.querySelector("#stock_ticker"), options);
            chart.render();
        }
    </script>
</html>
