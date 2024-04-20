<table>
    <thead>
        <tr>
            <th>Select</th>
            <th>Product Name</th>
            <th>Min/Max Price</th>
            <th>Last Change</th>
            <th>Frequency Interval</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($products as $product)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$product->name}}</td>
            <td>$10.00 - $100.00</td>
            <td>2022-01-01</td>
            <td>Weekly</td>
            <td>
                <button class="add-product-button">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>