<template>
    <div class="">
        <div class="">
            <a href="#" class="p-5 block bg-blue-dark hover:bg-blue-darker no-underline text-black border-b-1 border-gray-200 flex justify-between" @click.prevent="active = !active">
                <div class="flex flex-row">
                    <slot name="status"></slot>
                    <div class="mr-4">
                        <span class="text-start">{{this.title}}</span>
                    </div>
                </div>
                <span class="down-Arrow text-end text-gray-400 text-sm" v-show="!active">&#9660;</span>
                <span class="up-Arrow text-end text-gray-400 text-sm" v-show="active">&#9650;</span>
            </a>
        </div>
        <div class="p-2" v-show="active"><slot /></div>
    </div>
</template>

<script>
export default {
    name: "Accordion",
    data(){
        return{
            active:false
        }
    },
    props:{
        title:{
            required:true,
            type:String
        }
    },
}
</script>

<style scoped>

</style>
