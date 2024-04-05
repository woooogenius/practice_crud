<script setup>
import Footer from "@/Pages/Components/Footer.vue";
import Navigation from "@/Pages/Components/Navigation.vue";
import {router, useForm} from "@inertiajs/vue3";
import {inject} from "vue";

const route = inject('route')
const props = defineProps({
    post : {
        type : Object,
        required : true,
    }
})

const formData = useForm({
    title : props.post.title,
    content : props.post.content,
    board : props.post.board_id,
    created : props.post.created_at,

})
const dateFormat = (postTime)=>{
    const date = new Date(postTime);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}/${month}/${day} ${hours}:${minutes}`;
}

const deletePost = (postId)=>{
    if(confirm('삭제하시겠습니까?')){
        router.delete(route('posts.destroy',postId));
    }
}

const editPost = (postId)=>{
    // router.get(route('posts.edit',postId));
    //Uncaught Error: Ziggy error: route 'posts.edit' is not in the route list.


}

</script>

<template>
    <Navigation/>

    <div class="w-full">
        <h1 class="mt-5 text-center text-2xl">게시글 상세</h1>

        <div class="w-full flex justify-center mt-3">
            <div class="w-1/2">
                <input v-model="formData.title" class="border-gray-300 w-4/12 rounded-tl-xl border-r-white" type="text" readonly>
                <input :value="dateFormat(formData.created)" type="text" class="text-center w-4/12 border-gray-300 border-r-white" readonly>
                <input v-model="formData.board" class="text-center border-gray-300 w-4/12 rounded-tr-xl" type="text" readonly>
            </div>

        </div>
        <div class="w-full">
            <textarea v-model="formData.content" readonly class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>

        </div>

        <div class="w-1/2 flex justify-end m-auto">
            <button @click="()=>deletePost(post.id)" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75">삭제하기</button>
<!--            <button @click="()=>editPost(post.id)" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75 ml-3">수정하기</button>-->
            <a :href="'/edit/' + post.id " class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75 ml-3">수정하기</a>
        </div>



    </div>
    <Footer/>
</template>
