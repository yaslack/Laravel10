<script>
import { ref } from 'vue';
import {dateInput} from './dateRangePicker.vue';

export const showFilterModal = ref(false);

export const toggleModalFilter = (value = "") => {

    // Update the value of the importedShowing ref
    showFilterModal.value = !showFilterModal.value;


    if(showFilterModal.value == false && value == "add"){


    }
  };


</script>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import dateRangePicker from './dateRangePicker.vue';



function checkForm(event) {
    console.log(dateInput.value.placeholder)
    event.preventDefault();
    if(dateInput.value.placeholder == null){
       router.post('/',{ dateRange: "All" });
       toggleModalFilter("add");
    }
    else if(/\d/.test(dateInput.value.placeholder.split(' - ')[1]) ){
        console.log("c bon")
        router.post('/',{ dateRange: dateInput.value.placeholder });
        toggleModalFilter("add");
    }
    else{
        alert("Sélectionner un début et une fin")
    }

}

</script>
<template>
    <Transition name="bounce">
        <div v-show="showFilterModal" id="modal-form" class="overfloaw-y-auto">
            <div class="overlay"></div>
            <form @submit.prevent="checkForm" method="POST" class="modal">
                <button @click="toggleModalFilter()" id="btn-modal" type="button" class="bg-red-900 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Close menu</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="text-center">
                    <h2 class="p-8">Filtrage d'évènement</h2>
                </div>
                <div class="text-center">
                        <dateRangePicker/>
                </div>
                <div class="text-center">
                    <button id="submitButton" type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>
    </Transition>
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
    top: 25%;
    scale: 100%;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}

#btn-modal{
    position: absolute;
    top: 10px;
    right: 10px;
}

button{
    transition: all 0.5s;
}

.bounce-enter-active {
  animation: bounce-in 0.5s;
}
.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.25);
  }
  100% {
    transform: scale(1);
  }
}

</style>