@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey','company_name'))

    <div class="dashboard" id="dashboard">
            <dashboard-info company_logo_src_url="{{ $company_logo_src_url }}" grid="a1:b1"></dashboard-info>
            <current-time grid="c1:d2" dateformat="dddd, MMMM D, YYYY"></current-time>
            <current-weather-conditions grid="e1:f2"></current-weather-conditions>
            <internet-connection grid="a2:b2"></internet-connection>
            <google-vacation-calendar grid="a3:b8"></google-vacation-calendar>
            <google-company-calendar grid="c3:d8"></google-company-calendar>
            <system-statistics grid="e3:f5"></system-statistics>
            <github-file file-name="README" title="Bizly Dashboard" grid="g1:h2"></github-file>
            <system-activity grid="i1:j8"></system-activity>

    </div>

@endsection

@section('footer')

    <div class="footer">{{ $company_name }} Company Dashboard | &copy; 2015-2017 Bizly, Inc</div>

@endsection
