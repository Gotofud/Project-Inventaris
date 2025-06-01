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
            background-color: red;
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
        <h1 class="report-title">Incoming Items Report</h1>
    </div>


    <table>
        @php $no = 1; @endphp
        <thead>
            <!-- start row -->
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Incoming Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Info</th>
                <th>Coming At</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            <!-- start row -->
            @foreach ($icm_item as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        <img src="{{public_path('/images/data/' . $data->mainData->img)}}" class="rounded" width="50">
                    </td>
                    <td>{{ $data->icm_code }}</td>
                    <td>{{ $data->mainData->name }}</td>
                    <td>{{ $data->mainData->category->category_name }}</td>
                    <td>{{ $data->amount }}</td>
                    <td>{{ $data->info }}</td>
                    <td>{{ $data->entry_date }}</td>
                </tr>
            @endforeach
            <!-- end row -->
        </tbody>
    </table>
    <div class="footer">
        © Copyright {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('Y') }} Dutory.
    </div>
</body>

</html>