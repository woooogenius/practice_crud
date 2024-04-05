<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import Footer from "@/Pages/Components/Footer.vue";
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps({
    post : {
        type : Object,
        required : true,
    }
})

const formData = useForm({
    title :props.post.title,
    content : props.post.content,
    board : props.post.board_id,

})

const onHandleSave = ()=>{
    // router.put(route('posts.update'))
    // router.put(route('posts.update', { id: props.post.id }), formData) <<gpt가 알려준 코드
}

const handleSubmit = async () => {
    await formData.put(`/edit/${props.post.id}`);
};






</script>

<template>
    <Navigation/>

    <div class="w-full">
        <h1 class="mt-5 text-center text-2xl">게시글 수정</h1>

        <div class="w-full flex justify-center mt-3">
            <div class="w-1/2">
                <input v-model="formData.title" class="border-gray-300 w-8/12 rounded-tl-xl border-r-white" type="text" placeholder="제목을 입력하세요.">
                <input v-model="formData.board" class="border-gray-300 w-4/12 rounded-tr-xl" type="text" readonly>

            </div>

        </div>
        <div class="w-full">
            <textarea v-model="formData.content"  placeholder="내용을 입력하세요." class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>

        </div>

        <div class="w-1/2 flex justify-end m-auto">
            <button @click="()=>handleSubmit()" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-100">수정하기</button>
        </div>



    </div>
    <Footer/>
</template>
