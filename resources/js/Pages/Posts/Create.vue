<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import {useForm} from "@inertiajs/vue3";
const form = useForm({
    title : '',
    content : '',
    created_at : '',
    board_id : '자유게시판',
})

const submitForm = ()=>{
   form.post(route('posts.store'),{
        onSuccess : ()=>{
            form.title = '';
            form.content = '';
        },
        onFinish : ()=>{

        }
    })
}
</script>

<template>
    <Navigation/>

    <div class="w-full">
        <h1 class="mt-5 text-center text-2xl">게시글 쓰기</h1>

        <div class="w-full flex justify-center mt-3">
            <div class="w-1/2">
                <input v-model="form.title" class="border-gray-300 w-8/12 rounded-tl-xl border-r-white" type="text" placeholder="제목을 입력하세요.">
                <select v-model="form.board_id" class="border-gray-300 w-4/12 rounded-tr-xl">
                    <option value="자유게시판" selected>자유게시판</option>
                    <option value="그냥게시판">그냥게시판</option>
                </select>
            </div>

        </div>
        <div class="w-full">
            <textarea v-model="form.content" placeholder="내용을 입력하세요." class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>

        </div>

        <div class="w-1/2 flex justify-end m-auto">
            <button @click="submitForm" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-100">저장하기</button>
        </div>



    </div>
</template>
