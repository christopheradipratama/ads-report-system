@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">{{ __('Report') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="reportTable" class="table table-stripped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Reporter</th>
                                            <th>Category</th>
                                            <th>Ticket ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Evidence</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('report') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            width: '5%'
                        },
                        {
                            data: 'reporter_name',
                            name: 'reporter_name',
                            orderable: true,
                            searchable: true,
                            width: '15%'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name',
                            orderable: true,
                            searchable: true,
                            width: '10%'
                        },
                        {
                            data: 'ticket_id',
                            name: 'ticket_id',
                            orderable: true,
                            searchable: true,
                            width: '10%'
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true,
                            width: '10%'
                        },
                        {
                            data: 'description',
                            name: 'description',
                            orderable: false,
                            searchable: false,
                            width: '10%'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            width: '10%'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            width: '20%',
                            render: function(data, type, row, meta) {
                                return '<img src="' + data + '" width="150px">';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '10%'
                        }
                    ]
                });
            });
        </script>
    </body>

    </html>
@endsection
