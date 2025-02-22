<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  >
    <style>
        span.eror{
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="root">
        <div class="container pt-4">
            <div class="row">
                <div class="col-6 m-auto">
                  <div class="card">
                    <div class="card-body">
                        <h4 class="">Laravel Task</h4>
                        <hr>
                        <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="import">Import:</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                    @error('file')
                                       <span class="error">{{$message  }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 m-auto mt-4">
                                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- Display Messages -->
                        @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                            <p>Total Valid Rows: {{ session('validCount') }}</p>
                            <p>Total Failed Rows: {{ session('failedCount') }}</p>
                        @endif

                        @if(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif
                    </div>
                  </div>
                </div>
               
            </div>
        </div>
    </div>
</body>
</html>