<script setup>
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import {log} from './Welcome.js';

</script>

<template>
    <Head title="Welcome" />



        <div class="flex items-center justify-center h-screen bg-cyan-950">
            <div @click="log" class="bg-white event-handler">
              {{moment(new Date()).locale('fr').format('dddd D MMMM, YYYY [&nbsp;] HH:mm')}}
            </div>

    </div>
    
</template>

<style>
@import "Welcome.scss";

</style>
