<div class="card card-accent-info mb-3">
    <div class="card-body">
        <form id="form">
            <div class="row">
                <div class="col-md-6 search-filter">
                    <label>Date Range</label>
                    <input id="dropdown_datepicker" name="date_range" type="text" class="form-control" />
                </div>
                <div class="col-md-6 search-filter">
                    <label>Show:</label>
                    <select class="form-select" id="show_product_select" name="product_id"
                        data-placeholder="All Products" required>
                        <option value="">All Products</option>
                        @foreach ($productDropdown as $product_id => $product_name)
                        <option value="{{ $product_id }}">
                            {{ $product_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
