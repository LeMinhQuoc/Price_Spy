<table>
    <thead>
        <tr>
            <th>Select</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$category->name}}</td>
            <td>
                <button class="add-product-button">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>