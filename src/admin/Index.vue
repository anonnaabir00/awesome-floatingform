<template>
    <div>
        <div class="flex justify-center"><img :src=this.logopath class="w-2/6 mt-16" alt=""></div>
    <div class="w-3/6 mx-auto mt-12 mb-4 bg-white shadow-md">
        <router-view></router-view>
</div>
</div>

</template>

<script>
import Vue from 'vue';

export default {
    data() {
        return {
            logopath: affpro_settings.logopath
        }   
    },
    components: {
       
    },
    mounted() {
        
    }
}
</script>