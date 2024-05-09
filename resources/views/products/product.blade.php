<table>
      <thead>
        <tr>
          <th>Select</th>
          <th>Product Name</th>
          <th>SKU</th>
          <th>Barcode</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($product_detail as $product)
        <tr>
          <td><input type="checkbox"></td>
          <td>{{$product->name}}</td>
          <td>{{$product->sku}}</td>
          <td>{{$product->barcode}}</td>
          <td>
            <button class="add-product-button">Edit</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>