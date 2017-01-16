<template>
    <grid :position="grid" modifiers="padded" v-bind:class="animationClass">
        <section :class="addClassModifiers('internet-connection', online ? 'up': 'down')">
            <div class="internet-connection__icon">
                <h1 v-if="online">System Online</h1>
                <h1 v-if="!online">Connection Lost</h1>
            </div>
            <div class="internet-connection__lastHeartbeatInfo">Last Heartbeat: {{ actionDate(lastHeartBeatReceivedAt) }}</div>
        </section>
    </grid>
</template>

<script>
import echo from '../mixins/echo';
import Grid from './Grid';
import { addClassModifiers, actionDate } from '../helpers';
import moment from 'moment';

export default {

    components: {
        Grid,
    },

    mixins: [echo],

    props: ['grid'],

    data() {
        return {
            online: true,
            lastHeartBeatReceivedAt: moment(),
            animationClass: '',
        };
    },

    created() {
        setInterval(this.determineConnectionStatus, 1000);
    },

    methods: {
        addClassModifiers,
        actionDate,

        determineConnectionStatus() {
            const lastHeartBeatReceivedSecondsAgo = moment().diff(this.lastHeartBeatReceivedAt, 'seconds');

            this.online = lastHeartBeatReceivedSecondsAgo < 125;
        },

        getEventHandlers() {
            return {
                'InternetConnectionStatus.Heartbeat': () => {
                    this.lastHeartBeatReceivedAt = moment();
                    this.animationClass = 'animated pulse';
                    var that = this;
                    setTimeout(function (){ that.animationClass = '';} ,3000);
                },
                'Refresh.RefreshSignal': () => {
                    document.location.href = document.location.href;
                },
            };
        },
    },
};
</script>
