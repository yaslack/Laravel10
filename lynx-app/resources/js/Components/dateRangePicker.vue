<script setup>
import { ref } from 'vue'


import moment from "moment/dist/moment"
import fr from "moment/dist/locale/fr";

import Modal from "../Components/Modale.vue"



moment.updateLocale('fr', fr);

var date = moment(new Date()).format('dddd D MMMM, YYYY \u00A0 HH:mm'); // Utilisez \u00A0 pour représenter l'espace insécable


var showCalendar = ref(false);

const minus = "minus";
const plus = "plus";




var startDate = moment().date(1);
var currentMonth = ref(startDate.month()+1);
var currentMonthName = ref(startDate.month(startDate.month()).format('MMMM'));
var currentYear = ref(startDate.year());

function toggleCalendar(){
    this.showCalendar =! this.showCalendar;
    generateCalendar(this.currentYear,this.currentMonth);
}

function reset(){
    this.startDate = moment().date(1);
    this.currentMonth = startDate.month()+1;
    this.currentMonthName = startDate.month(startDate.month()).format('MMMM');
    this.currentYear = startDate.year();
    this.showCalendar = false;
}

function monthSwitch(string){
    if(string === "minus"){
        if(this.currentMonth == 1){
            this.currentMonth = 12;
            this.currentYear -= 1;
        }
        else{
            this.currentMonth -= 1;
        }
    }
    else if (string === "plus"){
        if(this.currentMonth == 12){
            this.currentMonth = 1;
            this.currentYear +=1;
        }
        else{
            this.currentMonth += 1;
        }
    }
    this.currentMonthName = startDate.month(this.currentMonth-1).format('MMMM');
    generateCalendar(this.currentYear,this.currentMonth);
}


var calen = "";
function generateCalendar(cY ,cM) {
    
    var year = cY;
    var month = cM;
    var firstDayOfMonth = moment({ year, month: month - 1 }).startOf('month').day();
    var lastDateOfMonth = moment({ year, month: month - 1 }).endOf('month').date();
    var lastDayOfMonth=new Date(year, month, lastDateOfMonth).getDay();

    let monthlastdate = null;
    if(month != 1){
        monthlastdate=moment({ year, month: month - 2 }).endOf('month').date();
    }
    else{
        let tempyear = year - 1;
        monthlastdate=moment({ tempyear, month: 11 }).endOf('month').date();
    }
    
calen = "";
calen+='<tr class="table-row">'
for (let i=firstDayOfMonth; i > 0; i--) {
    calen+=`
    <td class="table-cell text-zinc-400">${monthlastdate - i + 1}</td>
    `
        }



// loop to add the dates of the current month
var toLine = firstDayOfMonth;
for (let i=1; i <=lastDateOfMonth; i++) {
    if(toLine == 0){
        calen+='</tr>'
        calen+='<tr class="table-row">'
        toLine = 1;
    }
    else{
        toLine ++;
        if(toLine == 7){
            toLine = 0;
        }
    }

    // check if the current date is today
    const isToday = moment().date(1).day() === i ? 'active' : '';
    calen+=`<td id="${isToday}" class="table-cell">${i}</td>`;

}




if(toLine != 0){
    for(let i=toLine, j=1 ; i<7 ; i++,j++){

        calen+=`<td class="table-cell text-zinc-400">${j}</td>`;
    }
}
calen +='</tr>'

}

    
</script>

<template>
    <div class="block-picker">
        <input @click="toggleCalendar()"  class="shadow appearance-none border border-grey-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" ref="pickerInput" placeholder="Début et Fin" readonly>
        <Transition>

            <div v-if="showCalendar" class="calendar" ref="calendar" >
                <h3>SELECTIONNER UNE PLAGE DE DATES</h3>
                <div class="actual-plage">
                    <h4>Avril 11 - Mai 13</h4>
                    <div>
                        <div class="shown-month-year content-center text-center space-x-[50%]">
                            <span class="fixed-width-span" id="actualMY" >{{ currentMonthName + " " + currentYear }}</span>
                            <div class="arrow space-x-10">
                                <span @click="monthSwitch(minus)">&lt;</span>
                                <span @click="monthSwitch(plus)" >&gt;</span>
                            </div>
                        </div>
                        <div class="bloc-calendar text-center">
                            <table class="table">
                                <thead class="table-header-group">
                                    <tr class="table-row">
                                        <th class="table-cell">Sun</th>
                                        <th class="table-cell">Mon</th>
                                        <th class="table-cell">Tue</th>
                                        <th class="table-cell">Wed</th>
                                        <th class="table-cell">Thu</th>
                                        <th class="table-cell">Fri</th>
                                        <th class="table-cell">sat</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tbody" class="table-row-group" v-html="calen"  >

                                </tbody>
                            </table>
                        </div>
                        <div class="btn-calendar ">
                            <button @click="reset()" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Annuler
                            </button>                        
                            <button @click="toggleCalendar()" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Ok
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>
<style>


@import url('https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,500&display=swap');

.v-enter-active,
.v-leave-active {
  transition: opacity 0.20s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
.calendar{
    font-family: 'Roboto Flex', sans-serif;
    font-size: 80%;
    color: rgb(55, 55, 55);
    flex: auto;
    position: absolute;
    height: 80%;
    left: -50%;
    width: 200%;
    background-color: rgb(255, 255, 255);
    border: transparent;
    border-radius: 10px;
    box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.6);
    user-select: none;
    transition: all 0.5s;

}


.calendar:hover{
    scale: 150%;
}
@media (max-width:1300px ), (max-height: 1000px){
    .calendar{
        top: 30%;
    }
    .calendar:hover{
        scale: 110%;
    }

}

@media (max-width:610px){
    .calendar{
        scale: 70%;
    }
    .calendar:hover{
        scale: 80%;
    }
}
@media (max-width:410px){
    .calendar{
        scale: 40%;
    }
    .calendar:hover{
        scale: 50%;
    }
}



.calendar > h3{
    padding: 3%;
}

.actual-plage{
    padding-left: 3%;
    font-size: 150%;
    flex: auto;
}

.btn-calendar{
    position: absolute;
    bottom: 5%;
    right: 5%;

}

.btn-calendar > button{
    border: transparent;
    transition: all 0.5s;
}

.shown-month-year{
    padding: 0%;
    padding-left: -90%;
    font-size: 90%;
    text-align: center;
}

.fixed-width-span {
    width: 150px; /* Adjust the width to your preference */
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* This will truncate the text with an ellipsis if it overflows */
}

.arrow{
    position: relative;
    display: inline-block;
}



.arrow > span{
    border: 2px solid rgb(0,0,0,0);
    border-width: 1rem;
    border-radius: 30px;
    transition: all 0.5s, background-color 0.1s;
}
.arrow > span:hover{
    background-color: rgb(150, 150, 150);
    color: white;
    border: 2px solid rgb(150, 150, 150);
    color: white;
    border-radius: 30px;
    border-width: 1rem;
    cursor: pointer;
    
}

.bloc-calendar{
    border-style: solid;
    font-size: 70%;
}


table{
  width: 50%;

  word-break: break-all;
  border-style: solid;

}

td{

    border: 2px solid rgb(0,0,0,0);
    border-width: 10px;
    border-radius: 30px;
    transition: all 0.5s;
}

td:hover{
    background-color: rgb(150, 150, 150);
    color: white;
    border-radius: 30px;
    cursor: pointer;
}

</style>