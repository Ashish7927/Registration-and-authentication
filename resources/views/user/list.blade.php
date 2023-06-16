@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <h2 class="mt-5 mb-3"> User List</h2>
        <table class="table table-bordered m-a-0" id="myTable">
            <thead class="dker">
                <tr>
                    <th>Sl No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email </th>
                    <th>Created At </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($Users as $User)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $User->first_name}}</td>
                        <td>{{ $User->last_name}}</td>
                        <td>{{ $User->email }}</td>
                        <td>{{ $User->created_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready( function () {
          $.extend( $.fn.dataTable.defaults, {
            "ordering": false,
            "lengthChange": false
          } );
                $('#myTable').DataTable();
        } );
    </script>
@endsection
