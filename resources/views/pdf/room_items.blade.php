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
        <h1 class="report-title">Room Items Report</h1>
    </div>


    <table>
        <thead>
            <!-- start row -->
            <tr>
                <th>#</th>
                <th>Room Name</th>
                <th>Item</th>
                <th>Total</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @php
                $no = 1;
                $groupedByRoom = $groupedItems->groupBy('rooms_id');
            @endphp

            @foreach ($groupedByRoom as $roomId => $items)
                @php
                    $roomName = $room->firstWhere('id', $roomId)->room_name ?? 'Unknown Room';
                @endphp

                @foreach ($items as $index => $item)
                    @php
                        $itemName = $mainData->firstWhere('id', $item->item_id)->name ?? 'Unknown Item';
                    @endphp

                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($items) }}">{{ $no++ }}</td>
                            <td rowspan="{{ count($items) }}">{{ $roomName }}</td>
                        @endif

                        <td>{{ $itemName }}</td>
                        <td>{{ $item->total_amount }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>

    </table>
    <div class="footer">
        © Copyright {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('Y') }} Dutory.
    </div>
</body>

</html>