@extends('admin.layout.app')

@section('style')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        @include('sales_order::admin.analytic.search')
                        <div class="card">
                            <div class="menu">
                                <ul class="summary d-flex p-0 border-bottom border-1" style="list-style: none" data-sort-by="1">
                                    <li class="col-sm-3 order_sorting border-end border-1 active">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="order_label mb-3">
                                                <span style="font-size: 14px">Orders</span>
                                            </div>
                                            <div class="order d-flex">
                                                <div class="order_total col-sm-9"><span style="font-size: 20px"></span></div>
                                                <div class="order_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                    <span style="font-size: 0.8rem"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-sm-3 net_sales_sorting border-end border-1" data-sort-by="6">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="net_sales_label mb-3">
                                                <span style="font-size: 14px">Net Sales</span>
                                            </div>
                                            <div class="net_sales_data d-flex">
                                                <div class="net_sales_total col-sm-9"><span style="font-size: 20px"></span>
                                                </div>
                                                <div
                                                    class="net_sales_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                    <span style="font-size: 0.8rem"></span></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-sm-3 avg_order_value_sorting border-end" data-sort-by="2">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="avg_order_value_label mb-3">
                                                <span style="font-size: 14px">Average Order Value</span>
                                            </div>
                                            <div class="avg_order_value_data d-flex">
                                                <div class="avg_order_value_total col-sm-9"><span style="font-size: 20px"></span>
                                                </div>
                                                <div
                                                    class="avg_order_value_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                    <span style="font-size: 0.8rem"></span></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-sm-3 avg_product_per_order_sorting" data-sort-by="4">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="avg_product_per_order_label mb-3">
                                                <span style="font-size: 14px">Average product per order</span>
                                            </div>
                                            <div class="avg_product_per_order_data d-flex">
                                                <div class="avg_product_per_order_total col-sm-9"><span style="font-size: 20px"></span>
                                                </div>
                                                <div
                                                    class="avg_product_per_order_percentage percentage text-center fw-medium rounded pb-1 col-sm-3">
                                                    <span style="font-size: 0.8rem"></span></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <canvas id="line_chart" style="width: 100%; max-height: 400px"></canvas>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header">
                                <strong>Order</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Status</th>
                                            <th>Customer</th>
                                            <th>Product(s)</th>
                                            <th>Product Sold</th>
                                            <th>Coupon(s)</th>
                                            <th>Net Sales</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
            //--------- date range picker -------------------
            const daterangepicker = $('#dropdown_datepicker').daterangepicker({
                locale: {
                    format: "MMMM DD, YYYY",
                },
                startDate: moment('{!! $start_date !!}'),
                endDate: moment('{!! $end_date !!}'),
            });

            $('.daterangepicker').addClass('text-black');

            $("#show_product_select").select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: true,
            });

            $(function() {
                var table = $('.table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.analytic.order') !!}',
                        data: function(d) {
                            var form = {};
                            $.each($('#form').serializeArray(), function() {
                                form[this.name] = this.value;
                            });
                            d.form_data = form;
                        },
                    },
                    columns: [
                        {
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'product_sku',
                            name: 'product_sku'
                        },
                        {
                            data: 'product_sold',
                            name: 'product_sold'
                        },
                        {
                            data: function(row) {
                                var coupons = [];

                                if (row.sales_order_total.length > 0){
                                    row.sales_order_total.forEach(function(item) {
                                        if (item.code === 'coupon') {
                                            coupons.push(item.title);
                                        }
                                    });
                                    return coupons.join('<br>');
                                } else {
                                    return '-';
                                }
                                
                            },
                            name: 'coupon'
                        },
                        {
                            data: 'net_sales',
                            name: 'net_sales'
                        },
                    ],
                    initComplete: function(settings, json) {
                        getOrderDataByDateRange();
                    }
                });

                $('#dropdown_datepicker').on('apply.daterangepicker', function(event, picker) {
                    start_date = picker.startDate;
                    end_date = picker.endDate;

                    if (start_date.month() === end_date.month()) {
                        table.draw();
                        getOrderDataByDateRange();
                    } else {
                        swal.fire({
                            title: 'Fail',
                            text: 'You can only select date within the same month!',
                            icon: 'error',
                            confirmButtonClass: 'btn btn-danger',
                            confirmButtonText: 'OK',
                        });
                    }

                });

                $('#show_product_select').on('select2:select', function() {
                    table.draw();
                    getOrderDataByDateRange();
                });

                $('#show_product_select').on('select2:unselecting', function() {
                    table.draw();
                    getOrderDataByDateRange();
                });

                //------- change summary css ------------------
                $('.summary li').on('click', function(e) {
                    e.preventDefault();
                    var sort_by = $(this).data('sort-by');

                    $('.summary li').removeClass('active');
                    $(this).addClass('active');

                    $('.summary li').css({
                        'box-shadow': 'none',
                        'background-color': '#f8f9fa'
                    });
                    $('.summary li.active').css({
                        'box-shadow': 'inset 0 4px 0 #007cba',
                        'background-color': '#FFFFFF'
                    });

                    getOrderDataByDateRange(sort_by);

                    if(sort_by == 6 || sort_by == 4){
                        table.order([sort_by, 'desc']).draw();
                    }
                });
            });

            //------ create line chart -------------------
            const data = {
                labels: [],
                datasets: [{
                    label: '',
                    data: [],
                    fill: false,
                    borderWidth: 1,
                    borderColor: '#31688e',
                    tension: 0,
                    pointBackgroundColor: '#31688e',
                }, {
                    label: '',
                    data: [],
                    fill: false,
                    borderWidth: 1,
                    borderColor: '#35b779',
                    tension: 0,
                    pointBackgroundColor: '#35b779',
                }]
            };


            const lineChart = new Chart('line_chart', {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                        },
                        y: {
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        },
                    }
                }
            });

            //------------- axios call for product sold by date range ---------------------
            function getOrderDataByDateRange(sort_by) {
                axios({
                        method: "post",
                        url: '{!! route('admin.analytic.getOrderDataByDateRange') !!}',
                        data: function() {
                            var form = {};
                            $.each($('#form').serializeArray(), function() {
                                form[this.name] = this.value;
                            });
                            return {
                                form_data: form
                            };
                        }(),
                    })
                    .then(response => {
                        var order_data_current = response.data.order_data_current;
                        var order_data_previous = response.data.order_data_previous;

                        updateLineChart(order_data_current, order_data_previous, sort_by);
                        updateOrderSummary(order_data_current, order_data_previous);
                    })
                    .catch(error => {
                        swal.fire({
                            title: 'Fail',
                            text: error,
                            icon: 'error',
                            confirmButtonClass: 'btn btn-danger',
                            confirmButtonText: 'OK',
                        });
                    });
            }

            //--------------------------- update line chart ------------------------------- 
            function updateLineChart(order_data_current, order_data_previous, sort_by = null) {

                var currentDatasetLabel = [];
                var previousDatasetLabel = [];
                var dayOfMonth = [];

                var currentDay = $('#dropdown_datepicker').data('daterangepicker').endDate._d;

                for (let i = 1; i <= moment(currentDay).format('DD'); i++) {
                    dayOfMonth.push(i + '/' + moment(currentDay).format('M'));
                }

                //------------------ current year of date range -------------------------
                for (let j = 1; j <= dayOfMonth.length; j++) {
                    var data = 0;

                    $.each(order_data_current, function(date, salesDataArray) {
                        var date = new Date(date);
                        var compareDate = date.getDate();

                        if (compareDate === j) {
                            $.each(salesDataArray, function(index, salesData) {
                                switch (sort_by) {
                                    case 6:
                                        data += parseFloat(salesData['net_sales']);
                                    break;

                                    case 2:
                                        data += parseFloat(salesData['avg_order_value']);
                                    break;

                                    case 4:
                                        data += Math.round(parseFloat(salesData['avg_item']));
                                    break;
                                
                                    default:
                                        data += parseInt(salesData['orders']);
                                    break;
                                }
                            });
                        }
                    });

                    currentDatasetLabel.push(data);
                }
               
                //-------------------- previous year of date range -------------------------
                for (let k = 1; k <= dayOfMonth.length; k++) {
                    var data = 0;

                    $.each(order_data_previous, function(date, salesDataArray) {
                        var date = new Date(date);
                        var compareDate = date.getDate();

                        if (compareDate === k) {
                            $.each(salesDataArray, function(index, salesData) {
                                switch (sort_by) {
                                    case 6:
                                        data += parseFloat(salesData['net_sales']);
                                    break;

                                    case 2:
                                        data += parseFloat(salesData['avg_order_value']);
                                    break;

                                    case 4:
                                        data += Math.round(parseFloat(salesData['avg_item']));
                                    break;
                                
                                    default:
                                        data += parseInt(salesData['orders']);
                                    break;
                                }
                            });
                        }
                    });

                    previousDatasetLabel.push(data);
                }

                var start_date = $('#dropdown_datepicker').data('daterangepicker').startDate._d;
                var end_date = $('#dropdown_datepicker').data('daterangepicker').endDate._d;

                var currentLabel = moment(start_date).format('MMMM YYYY');
                var previousLabel = moment(end_date).subtract(1, "year").format('MMMM YYYY');

                //---------------- different display for line chart title --------------------------
                if (moment(end_date).format('MMMM') != moment(start_date).format('MMMM')) {
                    currentLabel = moment(start_date).format('MMMM') + ' - ' + moment(end_date).format('MMMM YYYY');
                    previousLabel = moment(start_date).format('MMMM') + ' - ' + previousLabel;

                    if (moment(end_date).format('YYYY') != moment(start_date).format('YYYY')) {
                        currentLabel = moment(start_date).format('MMMM YYYY') + ' - ' + moment(end_date).format(
                            'MMMM YYYY');
                        previousLabel = moment(start_date).subtract(1, "year").format('MMMM YYYY') + ' - ' +
                            previousLabel;
                    }
                }

                //--------- update line chart -----------------
                lineChart.data.datasets[0].data = currentDatasetLabel;
                lineChart.data.datasets[0].label = currentLabel;
                lineChart.data.datasets[1].data = previousDatasetLabel;
                lineChart.data.datasets[1].label = previousLabel;
                lineChart.data.labels = dayOfMonth;
                lineChart.update();
            }

            //-------------------- update product summary ---------------------
            function updateOrderSummary(order_data_current, order_data_previous) {
                var avg_product_per_order = 0;
                var avg_order_value = 0;
                var total_net_sales = 0;
                var total_orders = 0;
                
                var avg_product_per_order_prev = 0;
                var avg_order_value_prev = 0;
                var total_net_sales_previous = 0;
                var total_orders_previous = 0;

                $.each(order_data_current, function(date, salesDataArray) {
                    $.each(salesDataArray, function(index, salesData) { 
                        total_orders += parseInt(salesData['orders']);
                        total_net_sales += parseFloat(salesData['net_sales']);
                        avg_product_per_order += Math.round(parseFloat(salesData['avg_item']));
                        avg_order_value += parseFloat(salesData['avg_order_value']);
                    });
                });                

                $.each(order_data_previous, function(date, salesDataArray) {
                    $.each(salesDataArray, function(index, salesData) { 
                        total_orders_previous += parseInt(salesData['orders']);
                        total_net_sales_previous += parseFloat(salesData['net_sales']);
                        avg_product_per_order_prev += Math.round(parseFloat(salesData['avg_item']));
                        avg_order_value_prev += parseFloat(salesData['avg_order_value']);
                    });
                });  

                avg_product_per_order = avg_product_per_order / total_orders;
                avg_order_value = avg_order_value / total_orders;
                avg_product_per_order_prev = avg_product_per_order_prev / total_orders_previous;
                avg_order_value_prev = avg_order_value_prev / total_orders_previous;    

                var avg_product_per_order_percent = ((avg_product_per_order - avg_product_per_order_prev) / avg_product_per_order_prev) * 100;
                var avg_order_value_percent = ((avg_order_value - avg_order_value_prev) / avg_order_value_prev) * 100;
                var net_sales_percent = ((total_net_sales - total_net_sales_previous) / total_net_sales_previous) * 100;
                var orders_percent = ((total_orders - total_orders_previous) / total_orders_previous) * 100;

                $('.order_total span').text(total_orders);
                $('.net_sales_total span').text('$' + total_net_sales.toFixed(2));
                $.isNumeric(avg_order_value) ? $('.avg_order_value_total span').text('$' + avg_order_value.toFixed(2)) : 
                $('.avg_order_value_total span').text('$0.00');
                $.isNumeric(avg_product_per_order) ? $('.avg_product_per_order_total span').text(Math.round(avg_product_per_order)) : 
                $('.avg_product_per_order_total span').text('0');

                $.isNumeric(orders_percent) ? $('.order_percentage span').text(orders_percent.toFixed(1) + '%') :
                    $('.order_percentage span').text('');
                $.isNumeric(net_sales_percent) ? $('.net_sales_percentage span').text(net_sales_percent.toFixed(1) + '%') :
                    $('.net_sales_percentage span').text('');
                $.isNumeric(avg_order_value_percent) ? $('.avg_order_value_percentage span').text(avg_order_value_percent.toFixed(1) + '%') :
                    $('.avg_order_value_percentage span').text('');
                $.isNumeric(avg_product_per_order_percent) ? $('.avg_product_per_order_percentage span').text(avg_product_per_order_percent.toFixed(1) + '%') :
                    $('.avg_product_per_order_percentage span').text('');
                
                $('.percentage span').each(function() {
                    var value = parseFloat($(this).text().split('%'));

                    if ($.isNumeric(value)) {
                        value > 0 ? $(this).parent().removeClass('bg-success bg-danger').addClass(
                                'bg-success') : $(this).parent().removeClass('bg-success bg-danger')
                            .addClass('bg-danger');
                    } else {
                        $(this).parent().removeClass('bg-success bg-danger');
                    }
                });

                $('.summary li').each(function() {
                    $(this).hasClass('active') ? $(this).css('box-shadow', 'inset 0 4px 0 #007cba') : $(
                        this).css('background-color', '#f8f9fa');
                });
            }
        });
    </script>
@endsection
