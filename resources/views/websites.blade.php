<table>
    <thead>
        <tr>
            <th>Select</th>
            <th>Websites</th>
            <th>URL</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($web as $w)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$w->web_name}}</td>
            <td>{{$w->url}}</td>
            <td>
                <button class="add-product-button">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>