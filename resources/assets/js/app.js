/*

Integrated Browser Fiddle: https://jsfiddle.net/2rywva39/


 */

import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import DashboardInfo from './components/DashboardInfo';
import CurrentTime from './components/CurrentTime';
import GithubFile from './components/GithubFile';
import GoogleVacationCalendar from './components/GoogleVacationCalendar';
import GoogleCompanyCalendar from './components/GoogleCompanyCalendar';
import InternetConnection from './components/InternetConnection';
import LastFm from './components/LastFm';
import SystemActivity from './components/SystemActivity';
import SystemStatistics from './components/SystemStatistics';
import CurrentWeatherConditions from './components/CurrentWeatherConditions';
import Animations from './components/Animations';


new Vue({

    el: '#dashboard',

    components: {
        DashboardInfo,
        CurrentTime,
        GithubFile,
        GoogleVacationCalendar,
        GoogleCompanyCalendar,
        InternetConnection,
        LastFm,
        SystemActivity,
        SystemStatistics,
        CurrentWeatherConditions,
        Animations,
    },

    created() {
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
        });
    },
});


