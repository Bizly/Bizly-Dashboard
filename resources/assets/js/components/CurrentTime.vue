<template>
    <grid :position="grid" modifiers="red" v-bind:class="shakeNow">
        <section class="current-time">
            <time class="current-time__content">
                <span class="current-time__time">{{ time }}</span>
                <br>
                <span class="current-time__date">{{ date }}</span>
            </time>
        </section>
    </grid>
</template>

<script>
import Grid from './Grid';
import moment from 'moment';

export default {

    components: {
        Grid,
    },

    props: {
        dateformat: {
            type: String,
            default: 'DD-MM-YYYY',
        },
        timeformat: {
            type: String,
            default: 'h:mm:ss a',
        },
        grid: {
            type: String,
        },
    },

    data() {
        return {
            date: '2017-01-01',
            time: '12:00:00',
            shakeNow: '',
        };
    },

    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 1000);
        //this.shakeNow = true;
    },

    methods: {
        refreshTime() {
            this.date = moment().format(this.dateformat);
            this.time = moment().format(this.timeformat);
            this.shakeNow = 'animated shake';
        },
    },
};
</script>
