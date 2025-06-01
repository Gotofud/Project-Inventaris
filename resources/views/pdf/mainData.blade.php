<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Inventory Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .empty-stock {
            display: inline-block;
            background-color: #fa896b;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/images/icon-main.png') }}" alt="Dutory Logo" class="logo">
        <h1 class="report-title">Main Data Report</h1>
    </div>



    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Production Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($mainData as $data)
                <tr text-align="center">
                    <td>{{ $no++ }}</td>
                    <td>
                        <img src="{{ public_path('/images/data/' . $data->img) }}" class="rounded" width="50">
                    </td>
                    <td>{{ $data->prd_code }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->category->category_name }}</td>
                    <td>
                        @if ($data->stock > 0)
                            {{ $data->stock }}
                        @else
                            <span class="empty-stock">Empty</span>
                        @endif
                    </td>
                    <td>{{ $data->created_at->format('Y-m-d') }}
                        << /td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        © Copyright {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('Y') }} Dutory.
    </div>
</body>

</html>