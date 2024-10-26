<!DOCTYPE html>
<html>
<head>
    <title>Employee Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Attendance Details for {{ $employee->name }}</h1>
    <table>
        <thead>
            <tr>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_out }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
