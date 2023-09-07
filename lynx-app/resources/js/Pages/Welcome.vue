<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Modal from "../Components/Modale.vue";
import { showing } from "../store/store.js"
import { ref } from 'vue';

const toggelModal = () => {
  // Update the value of the importedShowing ref
  console.log(showing.value)
  showing.value = !showing.value;
};

const isActiveEvent = ref(false);
const isActiveModal = ref(false);
const isActiveCalendar = ref(false);

function toggleActive(element) {
  console.log(element)
  element = !element; // Toggle the active state
  return element;
}

</script>

<template>
    <Head title="Calendar Event" />
        <div class="flex items-center justify-center h-screen">
          <div>
          </div>
          <div v-dragscroll class="bg-white overflow-y-auto grab-bing flex flex-col rounded-[5rem]  shadow-lg shadow-cyan-500/50">
            <div id="stick-top" class="max-h-[7rem] sticky top-0">
              <div id="TodayDate">
                Date du jour
              </div>
              <div id="Date">
                {{date}}
              </div>
            </div>
            <div>
              <a>Evenèment</a>
            </div>
            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>            <div>
              <a>Evenèment</a>
            </div>
            
            
            <div id="stick-bottom" class="sticky bottom-0 flex items-stretch pb-3 w-full bg-[#ca1f56] pt-2 space-x-8">              
              <div @click="isActiveEvent = toggleActive(isActiveEvent)" :class="{ active: isActiveEvent }" id="event">
                <img src="./assets/event.png" width="500" height="600"/> 
              </div>
              <div @click="toggelModal()" id="modal">
                <img src="./assets/plus.png"  width="500" height="600"/> 
              </div>
              <div @click="isActiveCalendar = toggleActive(isActiveCalendar)" :class="{ active: isActiveCalendar }" id="calendar">
                <img src="./assets/calendar.png"  width="500" height="600"/> 
              </div>
            </div>
            
          </div>
          
        </div>
        <Modal />
        
</template>

<style>
@import "Welcome.css";

</style>
