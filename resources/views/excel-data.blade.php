<!DOCTYPE html>
<html>
<head>
    <title>Excel Data</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <h2>Excel Data</h2>

    @if(count($data) > 0)
        <table border="1" cellpadding="5">
            @foreach($data as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    @else
        <p>No data available</p>
    @endif

    <br>
    <a href="{{ route('excel.upload') }}">Upload Another File</a>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>