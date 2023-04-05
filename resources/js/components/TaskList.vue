<template>
    <div>
        <div v-if="!loading && tasks.length > 0" >
            <draggable
                :list="tasks"
                :disabled="false"
                ghost-class="ghost"
                :move="onMove"
                @start="false"
                @end="reorder"
            >
                <div v-for="task in tasks" :key="task.priority" class="flex flex-row justify-between border-b-2 border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                        <tr class="">
                            <td class="p-2 w-1/6" style="width: 5%">
                                <div class="flex flex-col">
                                    <h1 class="text-gray-400 cursor-pointer">||</h1>
                                </div>
                            </td>
                            <td class="w-5/6">
                                <accordion class="flex flex-col" :title="task.name" :key="task.id">
                                    <table class="table-auto p-4">
                                        <tbody>
                                        <tr>
                                            <td><strong>Description</strong></td>
                                            <td class="pl-3">{{ task.description }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deadline</strong></td>
                                            <td class="pl-3">{{ task.deadline }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table-auto p-4">
                                        <tbody>
                                        <tr>
                                            <td class="p-4"><a :href="task.edit_url" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">Edit</a></td>
                                            <td class="p-4">
                                                <form method="post" :action="task.delete_url" class="m-0">
                                                    <input type="hidden" :value="csrf" name="_token"/>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3" onclick="return confirm('are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </accordion>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </draggable>
        </div>
        <div v-else-if="!loading && tasks.length <= 0" >
            <div class="p-6 flex flex-row justify-center">
                <img src="/imgs/empty-tray-svgrepo-com.svg" width="100" height="100"/>
            </div>
        </div>
        <div v-else-if="loading" class="px-6 py-12 flex flex-row justify-center">
            <loader color="rgb(156 163 175 / 400)" size="50px"></loader>
        </div>
        <div v-else>
            <div class="p-6 flex flex-row justify-center">
                <strong>No Project is selected</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Accordion from "./util/Accordion.vue";
import draggable from "vuedraggable";
import loader from "vue-spinner/src/BounceLoader.vue"
export default {
    name: "TaskList",
    components: {Accordion, draggable, loader},
    props:{
        updateUrl:{
            required:true,
            type:String
        }
    },
    data(){
        return {
            tasks:[],
            loading:false
        }
    },
    computed:{
        csrf: function (){
            return $('meta[name="csrf-token"]').attr('content')
        },
        api_token: function (){
            return $('meta[name="api-token"]').attr('content')
        },
        filteredList: function () {
            return this.tasks.filter(task => {
                return (task.title.toLowerCase().includes(this.search.toLowerCase()))
            })
        },
    },
    methods:{
        async fetchTasks(url){
            this.loading = true;
            await axios.get(url,{
                params:{
                    api_token:this.api_token
                }
            }).then((res) => {
                this.tasks = res.data.data
            }).catch((err) => {
                alert(err.message)
            }).finally(() => {
                this.loading = false
            })
        },
        async handleFetchTasks(event){
            if(Object.keys(event.detail).length < 0){
                console.log(Object.keys(event.detail).length)
                return -1;
            }
            await this.fetchTasks(event.detail.url)
        },
        onMove(e){
            let index = this.tasks.find(item => item.id === e.draggedContext.element.id)
            console.log(e.draggedContext.element.id)
        },
        async reorder(e) {
            let items = this.tasks.map(function(item, index) {
                return { id: item.id, name: item.name, priority: index }
            })
            window.console.log(...items)
            // check if we are within the debounce time limit, do nothing
            if(this.debounce) return

            // debounce!
            this.debounce = setTimeout(function(items) {
                this.debounce = false

                // send it to your db
                axios.post(this.updateUrl, {
                    'api_token': this.api_token,
                    list:items
                })
            }.bind(this, items), 2000)
        },
    },
    mounted(){
        document.addEventListener("fetch-tasks", this.handleFetchTasks);
    },
    created() {
        document.addEventListener("fetch-tasks", this.handleFetchTasks);
    }
}
</script>

<style scoped>
td div h1{
    display:block;
    overflow:hidden;
    width:100%;
    white-space:nowrap;
}
</style>
