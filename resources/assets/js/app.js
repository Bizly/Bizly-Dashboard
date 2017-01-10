import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import CurrentTime from './components/CurrentTime';
import GithubFile from './components/GithubFile';
import GoogleVacationCalendar from './components/GoogleVacationCalendar';
import GoogleCompanyCalendar from './components/GoogleCompanyCalendar';
import InternetConnection from './components/InternetConnection';
import LastFm from './components/LastFm';
import PackagistStatistics from './components/PackagistStatistics';
import RainForecast from './components/RainForecast';
import SystemActivity from './components/SystemActivity';
import SystemStatistics from './components/SystemStatistics';

new Vue({

    el: '#dashboard',

    components: {
        CurrentTime,
        GithubFile,
        GoogleVacationCalendar,
        GoogleCompanyCalendar,
        InternetConnection,
        LastFm,
        PackagistStatistics,
        RainForecast,
        SystemActivity,
        SystemStatistics,
    },

    created() {
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
        });
    },
});
