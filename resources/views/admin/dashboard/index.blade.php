@extends('admin.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">Performance</div>
                    <div class="card-body p-0">
                        <div class="menu">
                            <ul class="summary d-flex mb-0 p-0 border-bottom border-1" style="list-style: none"
                                data-sort-by="1">
                                <li class="col-sm-3 order_sorting border-end border-1 active">
                                    <a href="#"
                                        class="text-decoration-none p-4 d-flex flex-column text-reset pe-none">
                                        <div class="order_label mb-3">
                                            <span style="font-size: 14px">Total Sales</span>
                                        </div>
                                        <div class="order d-flex">
                                            <div class="total_sales col-sm-9"><span style="font-size: 20px"></span></div>
                                            <div
                                                class="total_sales_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                <span style="font-size: 0.8rem"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-sm-3 net_sales_sorting border-end border-1" data-sort-by="6">
                                    <a href="#"
                                        class="text-decoration-none p-4 d-flex flex-column text-reset pe-none">
                                        <div class="net_sales_label mb-3">
                                            <span style="font-size: 14px">Net Sales</span>
                                        </div>
                                        <div class="net_sales_data d-flex">
                                            <div class="net_sales_total col-sm-9"><span style="font-size: 20px"></span>
                                            </div>
                                            <div
                                                class="net_sales_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                <span style="font-size: 0.8rem"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-sm-3 orders_sorting border-end" data-sort-by="2">
                                    <a href="#"
                                        class="text-decoration-none p-4 d-flex flex-column text-reset pe-none">
                                        <div class="orders_label mb-3">
                                            <span style="font-size: 14px">Orders</span>
                                        </div>
                                        <div class="orders_data d-flex">
                                            <div class="orders_total col-sm-9"><span style="font-size: 20px"></span>
                                            </div>
                                            <div
                                                class="orders_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                <span style="font-size: 0.8rem"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-sm-3 products_sold_sorting" data-sort-by="4">
                                    <a href="#"
                                        class="text-decoration-none p-4 d-flex flex-column text-reset pe-none">
                                        <div class="products_sold_label mb-3">
                                            <span style="font-size: 14px">Products Sold</span>
                                        </div>
                                        <div class="products_sold_data d-flex">
                                            <div class="products_sold_total col-sm-9"><span style="font-size: 20px"></span>
                                            </div>
                                            <div
                                                class="products_sold_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                <span style="font-size: 0.8rem"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Order in Month</div>
                    <div class="card-body">
                        <div>
                            <canvas id="line_chart_month" style="width: 100%; max-height: 400px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Order in Year</div>
                    <div class="card-body">
                        <div>
                            <canvas id="line_chart_year" style="width: 100%; max-height: 400px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="d-flex col-12 justify-content-between">
                    <div class="card col-sm-6" style="width: 49%">
                        <div class="card-header">New Orders</div>
                        <div class="card-body table-listing table-responsive">
                            <table id="new_orders_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Order Status</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="card col-sm-6" style="width: 49%">
                        <div class="card-header">New Customers</div>
                        <div class="card-body table-listing table-responsive">
                            <table id="new_customers_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Email Verification</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //---------- Datatable ---------------------
            $(function() {
                var new_orders_table = $('#new_orders_table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.dashboard') !!}',
                        data: function(d) {
                            d.table_type = 'new_orders';
                        },
                    },
                    columns: [
                        { 
                            data: 'sales_order_id',
                            name: 'sales_order_id',
                        }, 
                        { 
                            data: 'email',
                            name: 'email',
                        },
                        { 
                            data: 'status',
                            name: 'status',
                        },
                        { 
                            data: 'created_at',
                            name: 'created_at',
                        },
                    ],
                });

                var new_customers_table = $('#new_customers_table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.dashboard') !!}',
                        data: function(d) {
                            d.table_type = 'new_customers';
                        },
                    },
                    columns: [
                        { 
                            data: 'email',
                            name: 'email',
                        }, 
                        { 
                            data: 'username',
                            name: 'username',
                        },
                        { 
                            data: 'status',
                            name: 'status',
                        },
                        { 
                            data: 'created_at',
                            name: 'created_at',
                        },
                    ],
                });
            });

            //------ create line chart -------------------
            const monthlyData = {
                labels: [],
                datasets: [{
                    type: 'bar',
                    label: 'Total Orders',
                    data: [],
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    yAxisID: 'y',
                }, {
                    type: 'line',
                    label: 'Total Sales',
                    data: [],
                    fill: false,
                    borderWidth: 1,
                    borderColor: '#35b779',
                    tension: 0,
                    pointBackgroundColor: '#35b779',
                    yAxisID: 'y1',
                }]
            };

            const yearlyData = {
                labels: [],
                datasets: [{
                    type: 'bar',
                    label: 'Total Orders',
                    data: [],
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    yAxisID: 'y',
                }, {
                    type: 'line',
                    label: 'Total Sales',
                    data: [],
                    fill: false,
                    borderWidth: 1,
                    borderColor: '#35b779',
                    tension: 0,
                    pointBackgroundColor: '#35b779',
                    yAxisID: 'y1',
                }]
            };


            const lineChartMonth = new Chart('line_chart_month', {
                data: monthlyData,
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false, 
                            },
                        },
                    }
                }
            });

            const lineChartYear = new Chart('line_chart_year', {
                data: yearlyData,
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false, 
                            },
                        },
                    }
                }
            });

            let summary_data_current = JSON.parse('{!! $summary_data_current !!}');
            let summary_data_prev = JSON.parse('{!! $summary_data_prev !!}');
            let order_data = JSON.parse('{!! json_encode($order_data) !!}');
            let date_array = JSON.parse('{!! json_encode($date_array) !!}');

            updateSummaryData(summary_data_current, summary_data_prev);
            updateLineChart(order_data, date_array);

            function updateSummaryData(summary_data_current, summary_data_prev) {
                var total_sales_current = 0;
                var net_sales_current = 0;
                var orders_current = 0;
                var products_sold_current = 0;

                var total_sales_prev = 0;
                var net_sales_prev = 0;
                var orders_prev = 0;
                var products_sold_prev = 0;

                $.each(summary_data_current, function(key, dataset) {
                    $.each(dataset, function(data_key, data_value) {
                        switch (data_key) {
                            case 'total_sales':
                                total_sales_current += parseFloat(data_value);
                                break;

                            case 'net_sales':
                                net_sales_current += parseFloat(data_value);
                                break;

                            case 'orders':
                                orders_current += parseInt(data_value);
                                break;

                            default:
                                products_sold_current += parseInt(data_value);
                                break;
                        }
                    });
                });

                $.each(summary_data_prev, function(key, dataset) {
                    $.each(dataset, function(data_key, data_value) {
                        switch (data_key) {
                            case 'total_sales':
                                total_sales_prev += parseFloat(data_value);
                                break;

                            case 'net_sales':
                                net_sales_prev += parseFloat(data_value);
                                break;

                            case 'orders':
                                orders_prev += parseInt(data_value);
                                break;

                            default:
                                products_sold_prev += parseInt(data_value);
                                break;
                        }
                    });
                });

                $('.total_sales span').text('$' + total_sales_current.toFixed(2));
                $('.net_sales_total span').text('$' + net_sales_current.toFixed(2));
                $('.orders_total span').text(orders_current);
                $('.products_sold_total span').text(products_sold_current);

                var total_sales_percentage = ((total_sales_current - total_sales_prev) / total_sales_prev) * 100;
                var net_sales_percentage = ((net_sales_current - net_sales_prev) / net_sales_prev) * 100;
                var orders_percentage = ((orders_current - orders_prev) / orders_prev) * 100;
                var products_sold_percentage = ((products_sold_current - products_sold_prev) / products_sold_prev) *
                    100;

                $('.total_sales_percentage span').text(total_sales_percentage.toFixed(1) + "%");
                $('.net_sales_percentage span').text(net_sales_percentage.toFixed(1) + "%");
                $('.orders_percentage span').text(orders_percentage.toFixed(1) + "%");
                $('.products_sold_percentage span').text(products_sold_percentage.toFixed(1) + "%");

                $('.percentage span').each(function() {
                    var value = parseFloat($(this).text().split('%'));

                    if(!isNaN(value) && isFinite(value)){
                        if ($.isNumeric(value)) {
                            value > 0 ? $(this).parent().removeClass('bg-success bg-danger').addClass(
                                    'bg-success') : $(this).parent().removeClass('bg-success bg-danger')
                                .addClass('bg-danger');
                        } else {
                            $(this).parent().removeClass('bg-success bg-danger');
                        }
                    } else {
                        $(this).text('');
                    }
                    
                });

                $('.summary li').on('click', function(e) {
                    e.preventDefault();
                });

                $('.summary li').mouseover(function() {
                    $(this).css('background-color', 'rgb(248, 249, 250)');
                });

                $('.summary li').mouseout(function() {
                    $(this).css('background-color', '#FFFFFF');
                });
            }

            function updateLineChart(order_data, date_array) {
                var monthly_line_chart_dataset = [];
                var monthly_bar_chart_dataset = [];
                var yearly_line_chart_dataset = [];
                var yearly_bar_chart_dataset = [];
                var monthlyDay = [];
                var yearlyMonth = [];
                var monthForDisplay = [];

                $.each(date_array['date_array'], function(key, value){
                    var day = new Date(value);

                    monthlyDay.push(day.getDate());
                });

                $.each(date_array['year_month_array'], function(key, value){
                    var month = new Date(value);

                    yearlyMonth.push((month.getMonth() + 1));
                    monthForDisplay.push(month.getFullYear() + '-' + ("0" + (month.getMonth() + 1)).slice(-2));
                });

                for (let l = 0 ; l < 30; l++) {
                    var monthly_bar_chart_data = 0;
                    var monthly_line_chart_data = 0;

                    $.each(order_data['monthly'], function(date, orderDataArray) {
                        var date = new Date(date);
                        var compareDate = date.getDate();

                            if(compareDate == monthlyDay[l]){
                                $.each(orderDataArray, function(index, orderData) { 
                                    monthly_bar_chart_data += parseInt(orderData['orders']);
                                    monthly_line_chart_data += parseFloat(orderData['net_sales']);
                                });
                            }
                    });        

                    monthly_line_chart_dataset.push(monthly_line_chart_data);
                    monthly_bar_chart_dataset.push(monthly_bar_chart_data);
                }

                for (let j = 0; j < 12; j++) {
                    var yearly_bar_chart_data = 0;
                    var yearly_line_chart_data = 0;

                    $.each(order_data['yearly'], function(date, orderDataArray) {

                        var date = new Date(date);
                        var compareMonth = date.getFullYear() + '-' + ("0" + (date.getMonth() + 1)).slice(-2);

                            if(compareMonth == monthForDisplay[j]){
                                $.each(orderDataArray, function(index, orderData) { 
                                    yearly_bar_chart_data += parseInt(orderData['orders']);
                                    yearly_line_chart_data += parseFloat(orderData['net_sales']);
                                });
                            }
                    });        

                    yearly_line_chart_dataset.push(yearly_line_chart_data);
                    yearly_bar_chart_dataset.push(yearly_bar_chart_data);
                }

                lineChartMonth.data.datasets[0].data = monthly_bar_chart_dataset;
                lineChartMonth.data.datasets[1].data = monthly_line_chart_dataset;
                lineChartMonth.data.labels = date_array['date_array'];
                lineChartMonth.update();


                lineChartYear.data.datasets[0].data = yearly_bar_chart_dataset;
                lineChartYear.data.datasets[1].data = yearly_line_chart_dataset;
                lineChartYear.data.labels = monthForDisplay;
                lineChartYear.update();
            }
        });
    </script>
@endsection
