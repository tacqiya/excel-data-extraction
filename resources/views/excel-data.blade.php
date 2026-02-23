<!DOCTYPE html>
<html>
<head>
    <title>Excel Data</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <h2>Excel Data</h2>
    <a class="upload-another" href="{{ route('excel.upload') }}">Upload Another File</a>

    @if(count($data) > 0)
    <form action="{{ route('excel.export') }}" method="POST">
        @csrf

        <h4>Select columns to export:</h4>
        @foreach($columns as $key => $col)
            <label>
                <input type="checkbox" name="columns[]" value="{{ $key }}" checked>
                {{ $col }}
            </label>
        @endforeach

        <button type="submit">Download Selected Columns</button>
    </form>
    <div class="table-container">
        <table class="modern-table" border="1" cellpadding="5">
            @foreach($data as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
    @else
        <p>No data available</p>
    @endif

    <br>
    <a class="upload-another" href="{{ route('excel.upload') }}">Upload Another File</a>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>