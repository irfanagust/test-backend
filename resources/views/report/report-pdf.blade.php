<!DOCTYPE html>
<html>

<head>
    <title>report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>transaction date</th>
                <th>description</th>
                <th>credit</th>
                <th>debit</th>
                <th>amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collection as $item)
                <tr>
                    <td>{{ $item->transaction_date }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        @if ($item->debit_credit_status == 'C')
                            {{$item->amount}} 
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->debit_credit_status == 'D')
                            {{$item->amount}} 
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
