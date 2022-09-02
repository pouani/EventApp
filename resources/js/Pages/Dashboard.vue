<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-gray-800 leading-tight flex justify-between items-center">
                <h3 class=" font-semibold text-xl">Evènements</h3>
                <button @click="toggleModale()" class="flex items-center gap-1 bg-gray-700 text-gray-200 px-4 py-2 rounded-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    Créer un évent
                </button>
            </h2>
        </template>
        <div v-if="revele" class="cont fixed inset-0 z-20 h-screen w-full flex items-center justify-center">
            <li
            class="absolute inset-y-0 right-1 list-none h-10 w-10 bg-white rounded-md 
            flex items-center justify-center shadow-md mx-2 my-3 cursor-pointer"
            @click="toggleModale()">x</li>
            <EventAdd />
        </div>
        
        <EventIndex />
    </BreezeAuthenticatedLayout>
</template>
<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import EventIndex from '@/Components/EventIndex.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import EventAdd from '../Components/EventAdd.vue';
import UpdateEvent from '@/Components/UpdateEvent.vue';
    export default {
        components:{
    BreezeAuthenticatedLayout,
    EventIndex,
    Head,
    EventAdd,
    UpdateEvent
},
        data(){
            return {
                revele: false,
            }
        },
        methods: {
            toggleModale: function(){
                this.revele = !this.revele;
            },
            
        },
    }
</script>