<template lang="">
    <div class="max-w-md w-full px-3">
        <form action=""  @submit.prevent="addEvent">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 m-auto mb-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            {{revele}}
            <div>
                <div>
                    <label class="text-gray-700">Titre</label>
                    <input id="password" type="text" class="block w-full px-4 py-2 mt-1 text-gray-700
                     bg-white border border-gray-200 rounded-md focus:border-blue-400 
                     focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                     v-model="event.title">
                </div>

                <div class="my-3">
                    <label class="text-gray-700">Début</label>
                    <input type="date" class="block w-full px-4 py-2 mt-1
                     text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400
                      focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                      v-model="event.start_at">
                </div>
                <div class="my-3">
                    <label class="text-gray-700">Fin</label>
                    <input type="date" class="block w-full px-4 py-2 mt-1 text-gray-700 
                    bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 
                    focus:ring-opacity-40 focus:outline-none focus:ring"
                    v-model="event.end_at">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="w-full px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 
                rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                type="submit">Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: "EventAdd",
    data() {
        return {
            event:{
                title: '',
                start_at: null,
                end_at: null,
            }
        }
    },
    methods: {
        addEvent(){
            axios.post('/api/events', this.event)
                .then(res => console.log(res))
                .catch(err => console.log(err))
                .finally(()=> this.loadin=false)
        }
    },
}
</script>
<style lang="css">
    .cont{
        background: rgba(206, 230, 255, 0.281);
        backdrop-filter: blur(20px);
    }
</style>