<script setup>
import { onMounted, ref, watch } from 'vue';
import moment from 'moment/dist/moment';
import fr from 'moment/dist/locale/fr';
import { showing, toggleModal, variableChangeEvent } from "../store/store.js";
import Modal from "../Components/Modale.vue";
import ModalFilter,{toggleModalFilter} from "../Components/ModalFilter.vue";
import { router } from '@inertiajs/vue3';

moment.updateLocale('fr', fr);

var date = moment(new Date()).format('dddd D MMMM, YYYY \u00A0 HH:mm');

const eventList = ref('');

let props = defineProps({
  eventList: Object,
});

// Create a reactive variable that mirrors the prop
const reactiveEventList = ref(props.eventList);

// Watch for changes in the prop and update the reactive variable
watch(() => props.eventList, (newVal) => {
  reactiveEventList.value = newVal;
  generateList();
});

onMounted(() => {
  // Call the necessary logic directly without checking a flag
  generateList();
});

function handleVariableChange() {
  // Call the necessary logic directly without setting flags
  generateList();
}

document.addEventListener('variableChange', handleVariableChange);

function generateList() {
  eventList.value = ''; // Clear eventList before generating new content

  for (let i = 0; i < reactiveEventList.value.length; i++) {
    eventList.value += '<div>';
    eventList.value += `<a>${reactiveEventList.value[i]['title']} ${reactiveEventList.value[i]['start_date']} - ${reactiveEventList.value[i]['end_date']}</a>`;
    eventList.value += `<p id="description">${reactiveEventList.value[i]['description']}</p>`;
    var createdAt = convertTimestamp(reactiveEventList.value[i]['created_at']);
    eventList.value += `<p id="timestamp">Créer le : ${createdAt}</p>`;
    eventList.value += `<button id="${reactiveEventList.value[i]['created_at']}" class="remove-button">REMOVE</button>`;
    eventList.value += '</div>';
  }
}

function handleEventListClick(event) {
  const target = event.target;

  if (target && target.classList.contains('remove-button')) {
    const buttons = document.querySelectorAll('.remove-button');
    const index = Array.from(buttons).indexOf(target);
    const customId = target.getAttribute("id")
    removeEvent(index,customId);
  }
}

function removeEvent(index, id) {
  reactiveEventList.value.splice(index, 1);
  router.post('/removeEvent',{ id: id });
  generateList();
}

function convertTimestamp(timestamp) {
  // Use Moment.js to parse and format the timestamp
  var formattedDate = moment(timestamp).format('YYYY-MM-DD HH:mm:ss');
  return formattedDate;
}


</script>


<template>
    <Head title="Calendar Event" />
        <div class="flex items-center justify-center h-screen">
          <div>
          </div>
          <div class="bg-white grab-bing flex flex-col  shadow-lg shadow-cyan-500/50">
            <div id="stick-top" class=" max-h-[7rem] sticky top-0 ">
              <div id="TodayDate">
                Date du jour
              </div>
              <div id="Date">
                {{date}}
              </div>
            </div>
            <div v-dragscroll @click="handleEventListClick" v-html="eventList" class="Event-element">
            </div>
            <div id="stick-bottom" class="max-h-[7rem] sticky bottom-0 flex pb-3 w-full bg-[#ca1f56] pt-2 space-x-8">              
              <div @click="toggleModal()" id="modal">
                <img src="./assets/plus.png"  width="500" height="600"/> 
              </div>
              <div @click="toggleModalFilter()" id="calendar">
                <img src="./assets/calendar.png"  width="500" height="600"/> 
              </div>
            </div>
            
          </div>
          
        </div>
        <Modal />
        <ModalFilter />
        
</template>

<style scoped>
@import "Welcome.css";


</style>
