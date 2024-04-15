<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import Footer from "@/Pages/Components/Footer.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import {reactive} from "vue";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    }
})

const page = usePage()

const form = reactive({
    title: page.props.post.title,
    content: page.props.post.content,
    board_id: page.props.post.board_id,
    image_name: page.props.post.image_name,
    image_path: page.props.post.image_path,
    image: null,
})

const onChangeImg = (e) => {
    form.image = e.target.files[0];
}

const onHandleSave = () => {
    // router.put(route('posts.update'))
    // router.put(route('posts.update', { id: props.post.id }), formData) <<gpt가 알려준 코드
}

const handleSubmit = async () => {
    // console.log(form.image)

    const formData = new FormData();
    formData.append('image', form.image)
    formData.append('title', form.title)
    formData.append('content', form.content)
    // formData.append('board_id', form.board_id)


    await router.post(route('posts.update', page.props.post.id), formData);
    //put매서드를 사용하면 이미지 수정이 안됨
    //post로 하니까 잘들어옴,,
    //라우터도 post로 변경 했음.

};



</script>

<template>
    <Navigation/>

    <div class="w-full">
        <h1 class="mt-5 text-center text-2xl">게시글 수정</h1>

        <div class="w-full flex justify-center mt-3">
            <div class="w-1/2">
                <input v-model="form.title" class="border-gray-300 w-8/12 rounded-tl-xl border-r-white" type="text"
                       placeholder="제목을 입력하세요.">
                <input v-model="form.board_id" class="border-gray-300 w-4/12 rounded-tr-xl text-center" type="text"
                       readonly>

            </div>

        </div>
        <div class="w-full">
            <form @submit.prevent="handleSubmit" method="post" enctype="multipart/form-data">

                <div class="relative w-1/2 mx-auto">
                    <!--                <img v-if="formData.image_name" :src="route('storage.images.show', {filename: formData.image_name})" :alt="formData.image_name" class="absolute z-0 inset-0 mx-auto mr-3 mt-3 border border-gray-300 h-40 w-40">-->
                    <!--                <input v-else type="file" id="image">-->
                    <template v-if="form.image_name">
                        <img :src="route('storage.images.show', {filename: form.image_name ? form.image_name : null})"
                             :alt="form.image_name"
                             class="absolute z-0 inset-0 mx-auto mr-3 mt-3 border border-gray-300 h-auto w-40">
                    </template>
                    <template v-if="!form.image_name">
                        <div
                            class=" absolute  inset-0 mx-auto mr-3 mt-3 h-40 w-40 flex flex-col justify-end">
                            <label for="image" class="w-full h-full cursor-pointer">
                                <span class="h-full w-full border border-dashed border-gray-300 flex justify-center items-center">
                                    이미지 넣기
                                </span>
                            </label>
                            <input accept="image/" name="image" type="file" id="image" class="text-sm h-10 mt-1"
                                   @change="form.image = $event.target.files[0]">
                        </div>


                    </template>

                    <textarea v-model="form.content" placeholder="내용을 입력하세요."
                              class="border-gray-300 w-full m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>
                </div>
                <!--            <textarea v-model="formData.content"  placeholder="내용을 입력하세요." class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>-->
                <div class="w-1/2 flex justify-end m-auto">
                    <button type="submit"
                            class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-100">
                        수정하기
                    </button>
                </div>
            </form>

        </div>


    </div>
    <Footer/>
</template>
