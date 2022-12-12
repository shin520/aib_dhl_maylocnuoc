@extends('backend.layout.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Bảng điều khiển
                <small>TT CMS V1.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
                <li class="active">Trang quản trị</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <a href="{{ route('backend.order.index') }}" title="Bài viết" style="color: #FFFFFF">
                                <h3>{{ Order::count() }}</h3>
                                <p>ĐƠN HÀNG</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-checkmark-circled"></i>
                        </div>
                        <a href="{{ route('backend.order.index') }}" class="small-box-footer">Chi tiết <i
                                class="fa fa-arrow-circle-right"></i></a></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <a href="{{ route('backend.price.index') }}" title="Thư báo giá" style="color: #FFFFFF">
                                <h3>{{ Price::count() }}<sup style="font-size: 20px"></sup></h3>
                                <p>THƯ BÁO GIÁ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-contacts"></i>
                        </div>
                        <a href="{{ route('backend.user.index') }}" class="small-box-footer">Chi tiết <i
                                class="fa fa-arrow-circle-right"></i></a></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <a href="{{ route('backend.product.index') }}" title="Quản lý Menu" style="color: #FFFFFF">
                                <h3>{{ Product::count() }}</h3>
                                <p>SẢN PHẨM</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-cloud-circle"></i>
                        </div>
                        <a href="{{ route('backend.product.index') }}" class="small-box-footer">Chi tiết <i
                                class="fa fa-arrow-circle-right"></i></a></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <a href="{{ route('backend.post.index') }}" title="Quản lý Tin tức" style="color: #FFFFFF">
                                <h3>{{ Post::count() }}</h3>
                                <p>TIN TỨC</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-globe"></i>
                        </div>
                        <a href="{{ route('backend.post.index') }}" class="small-box-footer">Chi tiết <i
                                class="fa fa-arrow-circle-right"></i></a></a>
                    </div>
                </div>

                <div class="container-fluid">
                    <style>
                        #container {
                            height: 400px;
                        }

                        .highcharts-figure,
                        .highcharts-data-table table {
                            min-width: 310px;
                            max-width: 800px;
                            margin: 1em auto;
                        }

                        .highcharts-data-table table {
                            font-family: Verdana, sans-serif;
                            border-collapse: collapse;
                            border: 1px solid #ebebeb;
                            margin: 10px auto;
                            text-align: center;
                            width: 100%;
                            max-width: 500px;
                        }

                        .highcharts-data-table caption {
                            padding: 1em 0;
                            font-size: 1.2em;
                            color: #555;
                        }

                        .highcharts-data-table th {
                            font-weight: 600;
                            padding: 0.5em;
                        }

                        .highcharts-data-table td,
                        .highcharts-data-table th,
                        .highcharts-data-table caption {
                            padding: 0.5em;
                        }

                        .highcharts-data-table thead tr,
                        .highcharts-data-table tr:nth-child(even) {
                            background: #f8f8f8;
                        }

                        .highcharts-data-table tr:hover {
                            background: #f1f7ff;
                        }
                    </style>

                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Chart showing use of rotated axis labels and data labels. This can be a
                            way to include more labels in the chart, but note that more labels can
                            sometimes make charts harder to read.
                        </p>
                    </figure>


                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                    <script>
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'World\'s largest cities per 2021'
                            },
                            subtitle: {
                                text: 'Source: <a href="https://worldpopulationreview.com/world-cities" target="_blank">World Population Review</a>'
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    rotation: -45,
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population (millions)'
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: {
                                pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
                            },
                            series: [{
                                name: 'Population',
                                data: [
                                    ['Tokyo', 37.33],
                                    ['Delhi', 31.18],
                                    ['Shanghai', 27.79],
                                    ['Sao Paulo', 22.23],
                                    ['Mexico City', 21.91],
                                    ['Dhaka', 21.74],
                                    ['Cairo', 21.32],
                                    ['Beijing', 20.89],
                                    ['Mumbai', 20.67],
                                    ['Osaka', 19.11],
                                    ['Karachi', 16.45],
                                    ['Chongqing', 16.38],
                                    ['Istanbul', 15.41],
                                    ['Buenos Aires', 15.25],
                                    ['Kolkata', 14.974],
                                    ['Kinshasa', 14.970],
                                    ['Lagos', 14.86],
                                    ['Manila', 14.16],
                                    ['Tianjin', 13.79],
                                    ['Guangzhou', 13.64]
                                ],
                                dataLabels: {
                                    enabled: true,
                                    rotation: -90,
                                    color: '#FFFFFF',
                                    align: 'right',
                                    format: '{point.y:.1f}', // one decimal
                                    y: 10, // 10 pixels down from the top
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }]
                        });
                    </script>
                </div>

        </section>
    </div>
@endsection
