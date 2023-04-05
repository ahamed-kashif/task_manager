import Vue from "vue";
import TaskList from "./components/TaskList.vue";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
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
