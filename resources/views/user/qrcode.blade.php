@extends('layouts.master')
@section('content')
    <div class="container" style="text-align: center">
        <h2 class="mt-5 mb-3">Scan QrCode to view/update Profile Data</h2>
        @if ($url != '')
            {!! QrCode::size(300)->generate($url) !!}
        @endif

    </div>
@endsection
