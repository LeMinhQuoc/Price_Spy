{{-- Giả định rằng bạn đã truyền $users và $products từ controller vào view --}}
<?php $users = [
    ['name' => 'Nguyễn Văn A', 'email' => 'anv@example.com'],
    ['name' => 'Trần Thị B', 'email' => 'btt@example.com']
];

$products = [
    ['id' => 'P001', 'name' => 'Sản phẩm 1', 'price' => '100,000 VND'],
    ['id' => 'P002', 'name' => 'Sản phẩm 2', 'price' => '150,000 VND']
];

// Kiểm tra xem nút nào được nhấn
$display = 'users';?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Web Động với Blade</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <form action="{{ url('p_page') }}" method="get">
        <button type="submit" name="action" value="users">Người Dùng</button>
        <button type="submit" name="action" value="products">Sản Phẩm</button>
    </form>

    @if ($display == 'users')
    <table>
        <tr>
            <th>Tên</th>
            <th>Email</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if ($display == 'products')
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['price'] }}</td>
        </tr>
        @endforeach
    </table>
    @endif

</body>
</html>