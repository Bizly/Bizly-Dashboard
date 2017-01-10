@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey'))

    <div class="dashboard" id="dashboard">
            <github-file file-name="README" title="Bizly Dashboard" grid="a1"></github-file>
            <current-time grid="b1" dateformat="dddd, MMMM D, YYYY"></current-time>
            <rain-forecast grid="c1"></rain-forecast>
            <internet-connection grid="d1"></internet-connection>
            <google-vacation-calendar grid="a2:a4"></google-vacation-calendar>
            <google-company-calendar grid="b2:b4"></google-company-calendar>
            <system-statistics grid="d2:d4"></system-statistics>
            <system-activity grid="e1:e4"></system-activity>


    </div>

@endsection
