<template>
    <grid :position="grid" modifiers="overflow padded blue">
       <section class="google-calendar">
           <h1>System Activity</h1>
           <ul class="google-calendar__events">
              <transition-group name="list-complete" tag="p">
               <li v-bind:key="action" v-for="action in actions"  class="google-calendar__event list-complete-item">
                
                   <h2 class="google-calendar__event__title">{{ action.summary }}</h2>
                   
                   <div class="google-calendar__event__date">{{ actionDate(action.date) }}</div>
               </li>
               </transition-group>
               
           </ul>
       </section>
    </grid>
</template>

<script>
import { actionDate } from '../helpers';
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
            actions: [],
        };
    },

    methods: {
        actionDate,

        getEventHandlers() {
            return {
                'Dashboard.SystemActionCompleted': response => {
                    this.actions.unshift(response.action);
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
