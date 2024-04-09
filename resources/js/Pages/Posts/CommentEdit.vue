<script setup>

import {router, useForm} from "@inertiajs/vue3";
import Navigation from "@/Pages/Components/Navigation.vue";
import Footer from "@/Pages/Components/Footer.vue";

const props = defineProps({
    comment : {type : Object, required : true}
})

const formData = useForm({
    content : props.comment.comment,
})

const handleSubmit = async (commentId) => {
    // await formData.put(`/comments/${props.comment.id}`,{
    //     comment : formData.content,
    // });
    await router.put(route('comment.update',commentId),{
        'comment': formData.content,
    });
};

const goBackBtn = ()=>{
    window.history.back()
}

</script>

<template>
    <Navigation/>

    <div class="fixed z-10 inset-0 overflow-y-auto flex justify-center items-center">

        <div class="bg-white rounded-lg overflow-hidden shadow-xl p-6 w-1/2">
            <h2 class="text-2xl font-bold mb-4">댓글수정</h2>
            <form class="flex flex-col space-y-4" @submit.prevent="()=>handleSubmit(`${props.comment.id}`)">
                <input type="text" id="editInput" v-model="formData.content" class="border border-gray-300 rounded-lg p-2">
                <div class="flex justify-end">
                    <button class="border border-gray-300 rounded-xl px-4 py-2 hover:bg-black hover:text-white transition duration-300 mr-1" type="button"@click="goBackBtn">닫기</button>
                    <button class="border border-gray-300 rounded-xl px-4 py-2 hover:bg-black hover:text-white transition duration-300" type="submit">저장</button>
                </div>
            </form>
        </div>
    </div>

    <Footer/>

</template>
