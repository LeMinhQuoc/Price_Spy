<form action="{{ route('store_products') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="sku">SKU:</label>
        <input type="text" class="form-control" id="sku" name="sku" required>
    </div>

    <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" class="form-control" id="barcode" name="barcode" required>
    </div>

    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>