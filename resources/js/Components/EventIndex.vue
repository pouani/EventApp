<template lang="">
    <div>
        <div class="flex justify-between items-center pt-4 max-w-7xl px-4 mx-auto">
            <div class="group relative">
                <svg width="20" height="20" fill="currentColor" class="absolute left-6 md:left-3 top-1/2 md:-mt-2.5 -mt-0.5 text-slate-400 pointer-events-none group-focus-within:text-blue-500" aria-hidden="true">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                </svg>
                <input v-model="query" class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text" aria-label="Search events" placeholder="Search events...">
            </div>
            <ul class="flex" >
                <li class="list-none">
                    <Link href="#" @click="next(current_page)" class="page-link  px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md sm:inline hover:bg-blue-500 hover:text-white">
                        >
                    </Link>
                </li>
            </ul>
        </div>
        <div class="max-w-7xl px-4 mx-auto py-12 grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center">
            
            <div duration="550" name="nested" class="" v-for="(event, idx) in events" :key="event.id">
                
                <div class="">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                        <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200">
                            <div>
                                <div class="flex gap-3 text-gray-400">
                                    <span>start : {{formattedDate(event.start_at)}}</span>
                                    <span>end : {{formattedDate(event.end_at)}}</span>
                                </div>
                                {{ event.title }}
                            </div>
                            <li class="flex items-center gap-2
                            justify-center text-gray-600 rounded-full
                             border-solid border-gray-600 cursor-pointer">
                                <svg @click="deleteEvent(idx)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 font-semibold border">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <svg @click="toggleUpdate()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>

                            </li>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div v-if="reveleUp" class="cont fixed inset-0 z-20 h-screen w-full flex items-center justify-center">
            <li
            class="absolute inset-y-0 right-1 list-none h-10 w-10 bg-white rounded-md 
            flex items-center justify-center shadow-md mx-2 my-3 cursor-pointer"
            @click="toggleUpdate()">x</li>
            <UpdateEvent />
        </div>
    </div>
</template>
<script>
    import moment from "moment";
    import { Link } from '@inertiajs/inertia-vue3';
    import UpdateEvent from './UpdateEvent.vue';
    export default{
        components:{
            Link,
            UpdateEvent,
        },
        data() {
            return {
                events: {},
                query: '',
                current_page: 1,
                links: [],
                reveleUp: false,
            }
        },
        mounted() {
            this.next(this.current_page);
        },
        computed: {
            search() {
                return this.events.filter((event) => event.title.toLowerCase().includes(this.query))
            },
            paginated(){
                this.links.shift();
                this.links.pop();
                return this.links;
            }
        },
        methods: {
            call(page){
                axios.get('/api/events?page='+page)
                    .then(async(res) => {
                        this.events = res.data.events.data;
                        this.current_page = res.data.events.current_page;
                        console.log(res.data.events);
                    })
                    .catch(err => console.log(err));
            },
            formattedDate(date) {
                if (moment(date).isValid()) {
                    return moment(date).format("MM-YYYY");
                } else {
                    return date;
                }
            },
            next(page){
                this.current_page = page + 1;
                console.log(this.current_page)
                this.call(this.current_page);
            },
            deleteEvent(idx){
                console.log(this.events[idx].id);
                axios.delete(`/api/events/${this.events[idx].id}`)
                    .then(res => this.events.splice(idx, 1))
                    .catch(err => console.log(err))
            },
            toggleUpdate: function(){
                this.reveleUp = !this.reveleUp;
            }
        },
    }
    
</script>
<style lang="css">
 
</style>