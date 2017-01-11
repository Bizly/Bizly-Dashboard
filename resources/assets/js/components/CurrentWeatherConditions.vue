<template>
    <grid :position="grid" modifiers="padded softgrey">
        <section class="weather">
            <h1>{{temperature}}&deg; {{icon_alt}}</h1>
            <img class="weather__icon" :src="icon_url" :alt="icon_alt"/>
            <div>{{humidity}}</div>
            <div class="weather__updated-at">{{updatedAt}}</div>
            <div title="Weather Underground API Required Attribution" class="weather__attribution">
                <img src="/images/weather-underground-logo.png" alt="Attribution for Weather Undergound API Usage"/>
            </div>
        </section>
    </grid>
</template>

<script>

import echo from '../mixins/echo';
import Grid from './Grid';
import { addClassModifiers } from '../helpers';
import moment from 'moment';

export default {

    components: {
        Grid,
    },

    mixins: [echo],

    props: ['grid'],

    data() {
        return {
            temperature: 0,
            icon_url: '',
            icon_alt: 'Not Loaded',
            updatedAt: 'Loading...',
            humidity: '0%',
        };
    },

    methods: {
        addClassModifiers,

        getEventHandlers() {
            return {
                'Weather.CurrentConditionsFetched': response => {
                    //this.forecast = response.forecast;
                    const weather = response.conditions.current_observation;
                    this.temperature = weather.temp_f;
                    this.icon_url = weather.icon_url;
                    this.icon_alt = weather.icon;
                    this.updatedAt = weather.observation_time;
                    this.humidity = weather.relative_humidity;
                    console.log('weather',weather);
                },
            };
        },
    },
};
</script>
