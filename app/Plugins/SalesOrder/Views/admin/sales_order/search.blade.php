<div class="card card-accent-info mb-3">
    <div class="card-body">
        <form id="form">
            <div class="row">
                <div class="col-md-3 search-filter">
                    <label>Date Range</label>
                    <input id="searchDatePicker" name="date_range" type="datetime" class="form-control" name="dob"
                    data-td-target="#dob" data-td-toggle="datetimepicker" />
                </div>
                <div class="col-md-3 search-filter">
                    <label>Sales Order ID</label>
                    <input type="text" name="sales_order.sales_order_id" class="form-control" />
                </div>
                <div class="col-md-3 search-filter">
                    <label>Status</label>
                    {{ html()->select('sales_order.status')->options([null => ''] + renderSelect(App\Plugins\SalesOrder\Models\SalesOrder::ORDER_STATUS))->class('form-control')}}
                </div>
                <div class="col-md-12 text-right button-search m-2 d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-success" id="form-export">Export (Shipany)</button>
                    <button type="button" class="btn btn-primary" id="form-submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>