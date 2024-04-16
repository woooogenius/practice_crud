<script setup>

import Navigation from "@/Pages/Components/Navigation.vue";
import {inject, onMounted, ref, watch} from "vue";
import {router, usePage, Link} from "@inertiajs/vue3";
import Footer from "@/Pages/Components/Footer.vue";


const route = inject('route')

defineProps({
    data: {
        type: Object,
        default: () => {
        },
    },
})

const dateFormat = (postTime) => {
    const date = new Date(postTime);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}/${month}/${day} ${hours}:${minutes}`;
}

const deletePost = (postId) => {
    if (confirm('삭제하시겠습니까?')) {
        router.delete(route('posts.destroy', postId));
    }
}

const editPost = (postId) => {
    router.get(route('posts.edit', postId));
}
const detailPost = (postId) => {
    router.get(route('posts.detail', postId));
}


// let selectedBoard ='';
// const setSelectedBoard = (e)=>{
//     selectedBoard = e.target.value;
// }


const selectedBoard = ref('');

const page = usePage()

const linkPage = (url) => {
    router.get(url);
}

const onChangeBoardOption = (e) => {
    const boardId = e.target.value
    if(boardId){
        router.get(route('posts.home', {
            'board_id': boardId
        }))
    }else if(boardId === ''){
        router.get(route('posts.home'),{
            'board_id' : ''
        })
    }
}

onMounted(() => {
    console.log(page.props.data)
})



</script>

<template>
    <div>
        <Navigation/>

        <div class="w-full pl-10 pr-10 pb-40">

            <h1 class="mt-5 text-center text-2xl">Board Home</h1>
            <div class="flex flex-row justify-end">
                <select v-model="selectedBoard" @change="onChangeBoardOption" class="border border-gray-300 rounded-3xl text-sm">
                    <option value="">게시판선택</option>
                    <option value="">전체게시물</option>
                    <option value="자유게시판">자유게시판</option>
                    <option value="그냥게시판">그냥게시판</option>
                </select>
                <button
                    class="ml-2 px-5 py-2 rounded-3xl border border-gray-300 hover:bg-black hover:text-white transition delay-100">
                    <a href="/post/create">게시글 등록</a>
                </button>
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
<!--                        <div>{{data}}</div>-->
            <div v-for="(post, index) in $page.props.data.data" :key="post.id">
                <div>
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


            <!--페이지네이션-->
            <!--            <ul class="flex justify-center mt-5">-->
            <!--                <li v-if="data.prev_page_url !== null" class="mr-3 border border-gray-300 px-2 rounded-xl hover:bg-black hover:text-white transition delay-75">-->
            <!--                    <button  @click="linkPage(data.prev_page_url)"><<</button>-->
            <!--                </li>-->

            <!--                <li v-for="(page, idx) in data.last_page" :key="page.url" class="mr-2 border border-gray-300 w-6 h-6 text-center hover:bg-black hover:text-white text-sm rounded-xl transition">-->
            <!--                    <button class="w-full h-full" @click="linkPage(`${data.path + `?page=${idx+1}`}`)">{{ page }}</button>-->
            <!--                </li>-->

            <!--                <li v-if="data.next_page_url !== null">-->
            <!--                    <button  @click="linkPage(data.next_page_url)" class="border border-gray-300 px-3 rounded-xl hover:bg-black hover:text-white transition delay-75">>></button>-->
            <!--                </li>-->

            <!--            </ul>-->


            <!--pagination feedback code-->
            <div class="flex flex-row justify-center mt-5">

                    <!--게시판별 페이지네이션-->
                    <template v-for="(link, index) in data.links">
                        <Link v-if="link.url != null"
                              :class="[link.active ? 'bg-gray-900 text-white': '']"
                              class="mr-3 border border-gray-300 px-2 rounded-xl hover:bg-black hover:text-white transition delay-75"
                              :href="route('posts.home', {
                                  board_id: $page.props.board_id,
                                  page: index
                              })"
                        > <!--베열형태를 사용하면 코드중복 방지-->
                            <span v-html="link.label"></span>
                        </Link> <!--페이지 이동할 때 전체 페이지 리로딩 대신 부분 리로딩으로 사용 가능-->
                    </template>


            </div>


        </div>

    </div>
    <Footer/>

</template>
