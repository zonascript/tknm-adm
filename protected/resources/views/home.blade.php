@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>Home</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-6">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Members</h3>
                </div>
                <div class="box-body">
                    <div id="chartdiv"><img src="{{ asset('/images/Loading.gif') }}"></div>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Buyers</h3>
                </div>
                <div class="box-body">
                    <div id="chartdivbuyer"><img src="{{ asset('/images/Loading.gif') }}"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('add-js')
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- Chart code -->
    <script>
        $( document ).ready(function() {
            $.ajax({
                url: 'getMemberCount',
                error: function() {
                    $('#chartdiv').html('<p>An error has occurred</p>');
                    $('#chartdivbuyer').html('<p>An error has occurred</p>');
                },
                success: function(data) {
                    var dataProvider = data;
                    var chart = AmCharts.makeChart("chartdiv", {
                        "theme": "light",
                        "type": "serial",
                        "dataProvider": dataProvider,
                        "valueAxes": [{
                            "unit": "",
                            "position": "left",
                            "title": "Total",
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "balloonText": "Total Members ([[category]]): <b>[[value]]</b>",
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "title": "Total User",
                            "type": "column",
                            "valueField": "totaluser"
                        }, {
                            "balloonText": "Total KYC Members ([[category]]): <b>[[value]]</b>",
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "title": "Total KYC",
                            "type": "column",
                            "clustered":false,
                            "columnWidth":0.5,
                            "valueField": "totalkyc"
                        }],
                        "plotAreaFillAlphas": 0.1,
                        "categoryField": "date",
                        "categoryAxis": {
                            "gridPosition": "start"
                        },
                        "export": {
                            "enabled": false
                        }

                    });

                    var chartBuyer = AmCharts.makeChart("chartdivbuyer", {
                        "theme": "light",
                        "type": "serial",
                        "dataProvider": dataProvider,
                        "valueAxes": [{
                            "unit": "",
                            "position": "left",
                            "title": "Total",
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "balloonText": "Total Buyers ([[category]]): <b>[[value]]</b>",
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "title": "Total Buyer",
                            "type": "column",
                            "valueField": "totalbuyer"
                        }],
                        "plotAreaFillAlphas": 0.1,
                        "categoryField": "date",
                        "categoryAxis": {
                            "gridPosition": "start"
                        },
                        "export": {
                            "enabled": false
                        }

                    });
                },
                type: 'GET'
            });

        });


    </script>


@endsection