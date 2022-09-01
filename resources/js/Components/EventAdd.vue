<template lang="">
    <div v-if="revele" class="cont fixed inset-0 z-20 h-screen w-full flex items-center justify-center">
        <li
            class="absolute inset-y-0 right-1 list-none h-10 w-10 bg-white rounded-md 
        flex items-center justify-center shadow-md mx-2 my-3 cursor-pointer"
        v-on:click="toggleModale">x</li>
        <form action="">
            <div>
                <div>
                    <label class="text-gray-700">Titre</label>
                    <input id="password" type="text" class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                </div>

                <div class="my-3">
                    <label class="text-gray-700">Tag</label>
                    <input id="password" type="text" class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                </div>
                <div class="my-3">
                    <label class="text-gray-700">Début</label>
                    <input id="passwordConfirmation" type="date" class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                </div>
                <div class="my-3">
                    <label class="text-gray-700">Fin</label>
                    <input id="passwordConfirmation" type="date" class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="w-full px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: "EventAdd",
    props: ['revele', 'toggleModale'],
}
</script>
<style lang="css">
    .cont{
        background: rgba(206, 230, 255, 0.281);
        backdrop-filter: blur(20px);
    }
</style>