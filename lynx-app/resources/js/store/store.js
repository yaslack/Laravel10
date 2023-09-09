// store.js
import { ref } from 'vue';

export const showing = ref(false);


export const variableChangeEvent = new Event('variableChange');

export const toggleModal = (value = "") => {
    console.log(showing.value)
    // Update the value of the importedShowing ref

    showing.value = !showing.value;


    if(showing.value == false && value == "add"){
        document.dispatchEvent(variableChangeEvent);

    }
  };

