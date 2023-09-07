<script setup>
import { computed,ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import dateRangePicker from './dateRangePicker.vue';

</script>

<template>
    <div id="modal-form" class="overfloaw-y-auto">
        <div class="overlay"></div>
        <div class="modal">
            <button id="btn-modal" type="button" class="bg-red-900 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: outline/x -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div>
                <h2 class="p-8">Ajout d'évènement</h2>
            </div>
                <div class="line-1"></div>
            <div>
                <h3>Titre</h3>
                <input type="text" id="Titre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Titre" required>
            </div>
            <div>
                <h3>Desciption</h3>
                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>            </div>
                <div >
                    <span class="mx-4 text-gray-500">Date</span>
                    <dateRangePicker/>
            </div>
        </div>
    </div>
</template>

<style scoped>

#modal-form{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
}

.overlay{
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}
.modal{
    background: white;
    border: transparent;
    border-radius: 30px;
    color: rgb(32, 32, 32);
    padding: 50px;
    position: fixed;
    top: 15%;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}

#btn-modal{
    position: absolute;
    top: 10px;
    right: 10px;
}



</style>