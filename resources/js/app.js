import Vue from "vue";
import TaskList from "./components/TaskList.vue";
window.axios = require('axios');


const app = new Vue({
    el: '#app',
    components: {
        'task-list':TaskList
    },
    data:{
    },
    computed:{

    },
    methods:{
    }
});
