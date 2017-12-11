

<template>
    <grid :position="grid" modifiers="overflow padded blue">
       <section class="google-calendar">
           <h1>System Activity</h1>
           <chartist 
			    id-chart="ct-chart"
			    ratio="ct-major-second"
			    type="Line"
			    :data="chartData"
			    :options="chartOptions" >
			</chartist>
       </section>
    </grid>
</template>

<script>
import { actionDate } from '../helpers';
import echo from '../mixins/echo';
import Grid from './Grid';
import saveState from 'vue-save-state';
import chartist from 'chartist-vuejs';

export default {

    components: {
        Grid,
    },

    mixins: [echo, saveState],

    props: ['grid'],

    data() {
        return {
            actions: [],
            chartData: {
	            labels: ["A", "B", "C"],
	            series:[[1, 6, 5]]
	        },
	        chartOptions: {

	        }
        };
    },

    methods: {
        actionDate,

        getEventHandlers() {
            return {
                'Dashboard.SystemActionCompleted': response => {
                    this.actions.unshift(response.action);
                    if(this.actions.length > 20){
                      var nToSplice = this.actions.length - 20;
                      this.actions.splice(-1,nToSplice);
                      console.log('splicing last '+nToSplice);
                    }
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'system-actions',
            };
        },
    },
};
</script>
