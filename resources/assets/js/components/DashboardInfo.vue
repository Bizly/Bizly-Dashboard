<template>
    <grid :position="grid" modifiers="overflow padded blue">
        <section class="dashboard-info">
            <img class="dashboard-info__logo" :src="company_logo_src_url"/>
            <h1 class="dashboard-info__title">Dash v0.1</h1>
            <div class="github-file__content" v-html="contents"></div>
        </section>
    </grid>
</template>

<script>
import echo from '../mixins/echo';
import Grid from './Grid';
import saveState from 'vue-save-state';

export default {

    components: {
        Grid,
    },

    mixins: [echo, saveState],

    props: ['fileName', 'grid','title','company_logo_src_url'],

    data() {
        return {
            contents: '',
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'GitHub.FileContentFetched': response => {
                    this.contents = response.fileContent[this.fileName];
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: `github-file-${this.fileName}`,
            };
        },
    },
};
</script>
