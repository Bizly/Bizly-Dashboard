@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey','company_name'))

    <div class="dashboard" id="dashboard">
            <dashboard-info company_logo_src_url="{{ $company_logo_src_url }}" grid="a1"></dashboard-info>
            <github-file file-name="README" title="Bizly Dashboard" grid="c3"></github-file>
            <current-time grid="b1" dateformat="dddd, MMMM D, YYYY"></current-time>
            <current-weather-conditions grid="c1:c2"></current-weather-conditions>
            <internet-connection grid="d1"></internet-connection>
            <google-vacation-calendar grid="a2:a4"></google-vacation-calendar>
            <google-company-calendar grid="b2:b4"></google-company-calendar>
            <system-statistics grid="d2:d4"></system-statistics>
            <system-activity grid="e1:e4"></system-activity>

    </div>

@endsection

@section('footer')

    <div class="footer">{{ $company_name }} Company Dashboard | &copy; 2015-2017 Bizly, Inc</div>

@endsection
