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

    <div class="form-group">
        <label for="web">Link web:</label>
        <input type="text" class="form-control" id="web" name="web" required>
    </div>
   
    <div>
        <select name="cate_id">
        @foreach($cates as $cate)
            <option value="{{$cate->id}}">{{$cate->name}}</option>
        @endforeach
        </select>
    </div>
    
<!--
    <div>
        <select name="web_id">
        @foreach($webs as $web)
            <option value="{{$web->id}}">{{$web->web_name}}</option>
        @endforeach
        </select>
    </div>
-->

    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>