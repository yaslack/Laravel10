<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Modal from "../Components/Modale.vue"


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
              <div id="event">
                <img src="./assets/event.png" alt="Girl in a jacket" width="500" height="600"/> 
              </div>
              <div id="modal">
                <img src="./assets/plus.png" alt="Girl in a jacket" width="500" height="600"/> 
              </div>
              <div id="calendar">
                <img src="./assets/calendar.png" alt="Girl in a jacket" width="500" height="600"/> 
              </div>
            </div>
            
          </div>
          
        </div>
        <Modal />
        
</template>

<style>
@import "Welcome.css";

</style>
