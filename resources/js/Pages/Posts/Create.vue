<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import {inject, onMounted, reactive, watchEffect} from "vue";
import Footer from "@/Pages/Components/Footer.vue";

const route = inject('route')
const page = usePage()
const form = reactive({
    title : '',
    content : '',
    created_at : '',
    board_id : '자유게시판',
    user_id : page.props.auth.user.id,
    image : null,
})

const submitForm = ()=>{
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('content', form.content);
    formData.append('board_id', form.board_id);
    formData.append('user_id', form.user_id);
    formData.append('image', form.image);

    router.post(route('posts.store'), formData)
    //이미지가 계속 null로 들어왔었는데 위 코드로 해결
    //객체 생성후 서버로 전송
}


</script>

<template>
    <Navigation/>

    <div class="w-full">
        <h1 class="mt-5 text-center text-2xl">게시글 쓰기</h1>
        <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data">

        <div class="w-full flex justify-center mt-3">

            <div class="w-1/2">
                <input v-model="form.title" class="border-gray-300 w-8/12 rounded-tl-xl border-r-white" type="text" placeholder="제목을 입력하세요.">
                <select v-model="form.board_id" class="border-gray-300 w-4/12 rounded-tr-xl">
                    <option value="자유게시판" selected>자유게시판</option>
                    <option value="그냥게시판">그냥게시판</option>
                </select>

                <!--이미지업로드-->
                <div class="border border-gray-300 p-2 border-t-0">
                    <label for="image"></label>
                    <input  accept="image/" type="file" name="image" id="image" class="text-sm" @change="form.image = $event.target.files[0]"/>
                </div>
            </div>



        </div>
        <div class="w-full">
            <textarea v-model="form.content" placeholder="내용을 입력하세요." class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl" name="content"></textarea>

        </div>

        <div class="w-1/2 flex justify-end m-auto">
            <button type="submit" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-100">저장하기</button>
        </div>
        </form>



    </div>
    <Footer/>

</template>
