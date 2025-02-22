<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  >

</head>
<body>

   <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Import Results</h1>

                    <!-- Valid Rows -->
                    <h2>Valid Rows ({{ count($validRows) }})</h2>
                    @if(count($validRows) > 0)
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($validRows as $row)
                                    <tr>
                                        <td>{{ $row[0] }}</td> <!-- Changed to lowercase keys -->
                                        <td>{{ $row[1] }}</td> <!-- Changed to lowercase keys -->
                                        <td>{{ $row[2] }}</td> <!-- Changed to lowercase keys -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No valid rows found.</p>
                    @endif
                
                    <!-- Failed Rows -->
                    <h2>Failed Rows ({{ count($failedRows) }})</h2>
                    @if(count($failedRows) > 0)
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>Errors</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($failedRows as $failedRow)
                                    <tr>
                                        <td>{{ $failedRow['row'] }}</td>
                                        <td>
                                            <ul>
                                                @foreach($failedRow['errors'] as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $failedRow['data'][0] }}</td> <!-- Changed to lowercase keys -->
                                        <td>{{ $failedRow['data'][1] }}</td> <!-- Changed to lowercase keys -->
                                        <td>{{ $failedRow['data'][2] }}</td> <!-- Changed to lowercase keys -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No failed rows found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
   </div>

</body>
</html>
