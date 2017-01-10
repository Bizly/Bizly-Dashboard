<template>
    <grid :position="grid" modifiers="padded overflow">
        <section class="packagist-statistics">
            <h1>System Statistics</h1>
            <ul>
                <li v-for="stat in stats" class="packagist-statistic">
                    <h2 class="packagist-statistics__period">{{stat.label}}</h2>
                    <span class="packagist-statistics__count">{{ formatNumber(stat.value) }}</span>
                </li>
            </ul>
        </section>
    </grid>
</template>

<script>
import { formatNumber } from '../helpers';
import echo from '../mixins/echo';
import Grid from './Grid';
import saveState from 'vue-save-state';

export default {

    components: {
        Grid,
    },

    mixins: [echo, saveState],

    props: ['grid'],

    data() {
        return {
            stats:[],
        };
    },

    methods: {
        formatNumber,

        getEventHandlers() {
            return {
                'Dashboard.SystemStatisticsFetched': response => {
                    this.stats = response.stats;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'system-statistics',
            };
        },
    },
};
</script>
