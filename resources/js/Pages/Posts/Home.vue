<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import {inject} from "vue";
const route = inject('route')

</script>

<template>
    <div>
        <Navigation/>

        <div class="w-full pl-10 pr-10">

            <h1 class="mt-5 text-center text-2xl">Board Home</h1>
            <ul class="border border-gray-300 flex text-center mt-3">
                <li class="w-1/12 border-r border-gray-300 p-1">no</li>
                <li class="w-3/12 border-r border-gray-300 p-1">username</li>
                <li class="w-4/12 border-r border-gray-300 p-1">title</li>
                <li class="w-2/12 border-r border-gray-300 p-1">created at</li>
                <li class="w-1/12 border-r border-gray-300 p-1">edit</li>
                <li class="w-1/12 p-1">delete</li>
            </ul>

            <ul class="border border-gray-300 flex text-center border-t-0">
                <li class="w-1/12 border-r border-gray-300 p-3">1</li>
                <li class="w-3/12 border-r border-gray-300 p-3">test</li>
                <li class="w-4/12 border-r border-gray-300 p-3">test</li>
                <li class="w-2/12 border-r border-gray-300 p-3">today</li>
                <li class="w-1/12 border-r border-gray-300 p-3">
                    <button class="border border-gray-300 pl-3 pr-3 rounded-xl hover:bg-black hover:text-white transition delay-100">edit</button>
                </li>
                <li class="w-1/12 p-3">
                    <button class="border border-gray-300 pl-3 pr-3 rounded-xl hover:bg-black hover:text-white transition delay-100">del</button>
                </li>
            </ul>


            <div class="flex flex-row justify-end mt-5">
                <button class="px-5 py-2 rounded-3xl border border-gray-300 hover:bg-black hover:text-white transition delay-100">
                    <a href="/create">게시글 등록</a>
                </button>
            </div>






        </div>

    </div>

</template>
