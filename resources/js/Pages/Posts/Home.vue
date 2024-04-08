<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import {inject, ref} from "vue";
import {router} from "@inertiajs/vue3";
import Footer from "@/Pages/Components/Footer.vue";

const route = inject('route')

defineProps({
    posts:{
        type:Array,
        default: ()=>{},
    }
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
    router.get(route('posts.edit',postId));
}
const detailPost = (postId)=>{
    router.get(route('posts.detail',postId));
}



// let selectedBoard ='';
// const setSelectedBoard = (e)=>{
//     selectedBoard = e.target.value;
// }


const selectedBoard = ref('');
const setSelectedBoard = (value) => {
    selectedBoard.value = value;
}
</script>

<template>
    <div>
        <Navigation/>

        <div class="w-full pl-10 pr-10">

            <h1 class="mt-5 text-center text-2xl">Board Home</h1>
            <div class="flex flex-row justify-end">
                <select  v-model="selectedBoard" class="border border-gray-300 rounded-xl text-sm">
                    <option value="">전체보기</option>
                    <option value="자유게시판">자유게시판</option>
                    <option value="그냥게시판">그냥게시판</option>
                </select>
            </div>

            <ul class="w-full border border-gray-300 flex text-center mt-3">
                <li class="w-1/12 p-1">no</li>
                <li class="w-2/12 p-1">username</li>
                <li class="w-4/12 p-1">title</li>
                <li class="w-2/12 p-1">board</li>
                <li class="w-2/12 p-1">created at</li>
                <li class="w-1/12 p-1">edit</li>
                <li class="w-1/12 p-1">delete</li>
            </ul>

<!--            <div>{{posts}}</div>-->
            <div v-for="(post, index) in posts" >
                <div v-if="selectedBoard === '' ? true : selectedBoard === post.board_id">
                    <ul class="border border-gray-300 flex text-center border-t-0 ">
                        <li class="w-1/12 border-r border-gray-300 p-3">{{ index + 1 }}</li>
                        <li class="w-2/12 border-r border-gray-300 p-3">{{ post.user.name }}</li>
                        <li class="w-4/12 border-r border-gray-300 p-3">
                            <a @click="()=>detailPost(post.id)" class="w-full block cursor-pointer">
                                {{ post.title }}
                            </a>
                        </li>
                        <li class="w-2/12 border-r border-gray-300 p-3">{{ post.board_id }}</li>
                        <li class="w-2/12 border-r border-gray-300 p-3">{{ dateFormat(post.created_at) }}</li>
                        <li class="w-1/12 border-r border-gray-300 p-3">
                            <button
                                class="border border-gray-300 pl-3 pr-3 rounded-xl hover:bg-black hover:text-white transition delay-100"
                                @click="()=>editPost(post.id)"
                            >
                                edit
                            </button>
                        </li>
                        <li class="w-1/12 p-3">
                            <button
                                class="border border-gray-300 pl-3 pr-3 rounded-xl hover:bg-black hover:text-white transition delay-100"
                                @click="()=>deletePost(post.id)"
                            >
                                del
                            </button>
                        </li>
                    </ul>
                </div>

            </div>



            <div class="flex flex-row justify-end mt-5">
                <button class="px-5 py-2 rounded-3xl border border-gray-300 hover:bg-black hover:text-white transition delay-100">
                    <a href="/create">게시글 등록</a>
                </button>
            </div>















        </div>

    </div>
    <Footer/>

</template>
