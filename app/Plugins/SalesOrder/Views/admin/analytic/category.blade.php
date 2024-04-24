@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
                                <ul class="summary d-flex p-0 border-bottom border-1" style="list-style: none">
                                    <li class="col-sm-4 product_sold_sorting border-end border-1 active" data-sort-by="1">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="product_sold_label mb-3">
                                                <span style="font-size: 14px">Products Sold</span>
                                            </div>
                                            <div class="product_sold_data d-flex">
                                                <div class="product_sold_total col-sm-10"><span
                                                        style="font-size: 20px"></span></div>
                                                <div
                                                    class="product_sold_percentage percentage text-center fw-medium rounded pb-1 col-sm-2">
                                                    <span style="font-size: 0.8rem"></span></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-sm-4 net_sales_sorting border-end border-1" data-sort-by="2">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="net_sales_label mb-3">
                                                <span style="font-size: 14px">Net Sales</span>
                                            </div>
                                            <div class="net_sales_data d-flex">
                                                <div class="net_sales_total col-sm-10"><span style="font-size: 20px"></span>
                                                </div>
                                                <div
                                                    class="net_sales_percentage percentage text-center fw-medium rounded pb-1 col-sm-2">
                                                    <span style="font-size: 0.8rem"></span></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-sm-4 orders_sorting" data-sort-by="3">
                                        <a href="#" class="text-decoration-none p-4 d-flex flex-column text-reset">
                                            <div class="orders_label mb-3">
                                                <span style="font-size: 14px">Orders</span>
                                            </div>
                                            <div class="orders_data d-flex">
                                                <div class="orders_total col-sm-10"><span style="font-size: 20px"></span>
                                                </div>
                                                <div
                                                    class="orders_percentage percentage text-center fw-medium rounded pb-1 col-sm-2">
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
                                <strong>Category</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Products Sold</th>
                                            <th>Net Sales</th>
                                            <th>Orders</th>
                                            <th>Products</th>
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
                        url: '{!! route('admin.analytic.category') !!}',
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
                            data: 'category',
                            name: 'category'
                        },
                        {
                            data: 'product_sold',
                            name: 'product_sold'
                        },
                        {
                            data: 'net_sales',
                            name: 'net_sales'
                        },
                        {
                            data: 'orders',
                            name: 'orders'
                        },
                        {
                            data: 'products',
                            name: 'products'
                        },
                    ],
                    order: [
                        [1, 'desc']
                    ],
                    initComplete: function(settings, json) {
                        getCategoryDataByDateRange();
                    }
                });

                $('#dropdown_datepicker').on('apply.daterangepicker', function(event, picker) {
                    start_date = picker.startDate;
                    end_date = picker.endDate;

                    if (start_date.month() === end_date.month()) {
                        table.draw();
                        getCategoryDataByDateRange();
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
                    getCategoryDataByDateRange();
                });

                $('#show_product_select').on('select2:unselecting', function() {
                    table.draw();
                    getCategoryDataByDateRange();
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

                    getCategoryDataByDateRange(sort_by);
                    table.order([sort_by, 'desc']).draw();
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
            function getCategoryDataByDateRange(sort_by) {
                axios({
                        method: "post",
                        url: '{!! route('admin.analytic.getCategoryDataByDateRange') !!}',
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
                        var category_data_current = response.data.category_data_current;
                        var category_data_previous = response.data.category_data_previous;

                        updateLineChart(category_data_current, category_data_previous, sort_by);
                        updateCategorySummary(category_data_current, category_data_previous);
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
            function updateLineChart(category_data_current, category_data_previous, sort_by = null) {

                var currentDatasetLabel = [];
                var previousDatasetLabel = [];
                var dayOfMonth = [];
                var currentDay = $('#dropdown_datepicker').data('daterangepicker').endDate._d;

                for (let i = 1; i <= moment(currentDay).format('DD'); i++) {
                    dayOfMonth.push(i + '/' + moment(currentDay).format('M'));
                }

                //------------------ current year of date range -------------------------
                for (let j = 1; j <= dayOfMonth.length; j++) {
                    var salesFound = false;

                    category_data_current.forEach(element => {
                        var date = new Date(element['date']);
                        var compareDate = date.getDate();

                        if (compareDate === j) {

                            if (sort_by && sort_by > 1) {
                                sort_by == 2 ? currentDatasetLabel.push(parseFloat(element['net_sales'])) :
                                    currentDatasetLabel.push(parseInt(element['orders']));
                            } else {
                                currentDatasetLabel.push(parseFloat(element['product_sold']));
                            }
                            salesFound = true;
                        }
                    });

                    if (!salesFound) {
                        currentDatasetLabel.push(0);
                    }
                }

                //-------------------- previous year of date range -------------------------
                for (let k = 1; k <= dayOfMonth.length; k++) {
                    var salesFound = false;

                    category_data_previous.forEach(element => {

                        var date = new Date(element['date']);
                        var compareDate = date.getDate();

                        if (compareDate === k) {
                            if (sort_by && sort_by > 1) {
                                sort_by == 2 ? previousDatasetLabel.push(parseFloat(element['net_sales'])) :
                                    previousDatasetLabel.push(parseInt(element['orders']));
                            } else {
                                previousDatasetLabel.push(parseFloat(element['product_sold']));
                            }
                            salesFound = true;
                        }
                    });

                    if (!salesFound) {
                        previousDatasetLabel.push(0);
                    }
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
                        console.log('here');
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
            function updateCategorySummary(category_data, category_data_previous) {
                var total_product_sold = 0;
                var total_net_sales = 0;
                var total_orders = 0;
                var total_category_data_previous = 0;
                var total_net_sales_previous = 0;
                var total_orders_previous = 0;

                category_data.forEach(element => {
                    total_product_sold += parseInt(element['product_sold']);
                    total_net_sales += parseFloat(element['net_sales']);
                    total_orders += parseInt(element['orders']);
                });

                category_data_previous.forEach(element => {
                    total_category_data_previous += parseInt(element['product_sold']);
                    total_net_sales_previous += parseFloat(element['net_sales']);
                    total_orders_previous += parseInt(element['orders']);
                });

                var product_sold_percent = ((total_product_sold - total_category_data_previous) /
                    total_category_data_previous) * 100;
                var net_sales_percent = ((total_net_sales - total_net_sales_previous) / total_net_sales_previous) *
                    100;
                var orders_percent = ((total_orders - total_orders_previous) / total_orders_previous) * 100;

                $('.product_sold_total span').text(total_product_sold);
                $('.net_sales_total span').text('$' + total_net_sales.toFixed(2));
                $('.orders_total span').text(total_orders);

                $.isNumeric(product_sold_percent) ? $('.product_sold_percentage span').text(product_sold_percent.toFixed(1) + '%') :
                    $('.product_sold_percentage span').text('');
                $.isNumeric(net_sales_percent) ? $('.net_sales_percentage span').text(net_sales_percent.toFixed(1) + '%') :
                    $('.net_sales_percentage span').text('');
                $.isNumeric(orders_percent) ? $('.orders_percentage span').text(orders_percent.toFixed(1) + '%') :
                    $('.orders_percentage span').text('');

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
