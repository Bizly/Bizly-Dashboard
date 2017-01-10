<template>
    <grid :position="grid" modifiers="padded">
        <section :class="addClassModifiers('rain-forecast', status)">
            <h1 class="rain-forecast__title rain-forecast__title--rainy">{{temperature}}&deg;</h1>
            <h1 class="rain-forecast__title rain-forecast__title--rainy" v-if="status == 'wet'">STAY INSIDE</h1>
            <img :src="icon_url" :alt="icon_alt"/>
            <div class="rain-forecast__background"></div>
            <div class="rain-forecast__graph" >
                <graph
                  :labels="graphLabels"
                  :values="graphData"
                  line-color="rgba(19,134,158, .5)"
                  background-color="rgba(19,134,158, .25)"
                ></graph>
            </div>
        </section>
    </grid>
</template>

<script>
import { filter, map, sumBy } from 'lodash';
import echo from '../mixins/echo';
import Graph from './Graph';
import Grid from './Grid';
import { addClassModifiers } from '../helpers';

export default {

    components: {
        Grid,
        Graph,
    },

    mixins: [echo],

    props: ['grid'],

    computed: {
        status() {
            if (this.noRainPredicted === true) {
                return 'dry';
            }

            if (this.nothingButRainPredicted === true) {
                return 'wet';
            }

            return 'rainy';
        },

        noRainPredicted() {
            const rainScore = sumBy(this.forecast, foreCastItem => {
                return parseInt(foreCastItem.chanceOfRain);
            });

            return rainScore === 0;
        },

        nothingButRainPredicted() {
            const foreCastItemWithNoRain = filter(this.forecast, foreCastItem => {
                return foreCastItem.chanceOfRain < 40;
            }).length;

            return foreCastItemWithNoRain.length === 0;
        },

        currentTemperature() {
            console.log(this.forecast);
            return this.forecast.main.temp;
        },

        graphLabels() {
            return map(this.forecast, 'minutes');
        },

        graphData() {
            return map(this.forecast, 'chanceOfRain');
        },

        graphPeriod() {
            return this.forecast[this.forecast.length - 1].minutes;
        },
    },

    data() {
        return {
            forecast: [],
            temperature: 0,
            icon_url: '',
            icon_alt: 'Not Loaded',
        };
    },

    methods: {
        addClassModifiers,

        getEventHandlers() {
            return {
                'Weather.CurrentConditionsFetched': response => {
                    //this.forecast = response.forecast;
                    this.temperature = response.conditions.current_observation.temp_f;
                    this.icon_url = response.conditions.current_observation.icon_url;
                    this.icon_alt = response.conditions.current_observation.icon;
                },
            };
        },
    },
};
</script>
