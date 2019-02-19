@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading hide text-center" id="message">

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{ $newCustomers }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">New Customers</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{ $totalUpdates }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Total Conversations</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-shopping-cart fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{ $confirmedSale }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Confirmed Sales</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-support fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{ $followUps }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Follow Ups</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- Area Chart Example-->
                    <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-area-chart"></i> New Customers
                            </div>
                            <div class="panel-body">
                                <canvas id="newCustomersChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Bar Chart Example-->
                    <div class="col-md-6 col-lg-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-area-chart"></i> Confirmed Sales
                            </div>
                            <div class="panel-body">
                                <canvas id="confirmedSalesChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Bar Line Example-->
                    <div class="raw">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-area-chart"></i> Total Conversations
                            </div>
                            <div class="panel-body">
                                <canvas id="totalConversationsChart" width="100%" height="20"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('javascript')
    <script type="text/javascript">
        var newCustomersChartData_labels = [];
        var newCustomersChartData_data = [];
        var confirmedSaleChartData_labels = [];
        var confirmedSaleChartData_data = [];
        var conversionChartData_labels = [];
        var conversionChartData_data = [];

        var newCustomersChartData = <?php print_r($newCustomersChartData); ?>;
        var confirmedSaleChartData = <?php print_r($confirmedSaleChartData); ?>;
        var conversionChartData = <?php print_r($conversionChartData); ?>;
        console.log(conversionChartData);

        for(var i = 0; i < newCustomersChartData.length; i++) {
            var obj = newCustomersChartData[i];

            newCustomersChartData_labels.push(obj.creation_date);
            newCustomersChartData_data.push(obj.new_customers);
        }

        for(var i = 0; i < confirmedSaleChartData.length; i++) {
            var obj = confirmedSaleChartData[i];

            confirmedSaleChartData_labels.push(obj.creation_date);
            confirmedSaleChartData_data.push(obj.confirmed_sales);
        }

        for(var i = 0; i < conversionChartData.length; i++) {
            var obj = conversionChartData[i];

            conversionChartData_labels.push(obj.creation_date);
            conversionChartData_data.push(obj.conversions);
        }
        
    </script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/Chart.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/sb-admin-charts.js') }}"></script>
@endsection