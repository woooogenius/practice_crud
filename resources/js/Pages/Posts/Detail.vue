<script setup>
import Footer from "@/Pages/Components/Footer.vue";
import Navigation from "@/Pages/Components/Navigation.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import {inject, onMounted, ref} from "vue";

const route = inject('route')
const props = defineProps({
    post : {
        type : Object,
        required : true,
    },
    comments : {
        type : Array,
    },

})

const formData = useForm({
    title : props.post.title,
    content : props.post.content,
    board : props.post.board_id,
    created : props.post.created_at,
    image_path : props.post.image_path,
    image_name : props.post.image_name,

})

const commentData= useForm({
    comment : '',
    post_id : props.post.id,
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
const submitComment = ()=>{
    commentData.post(route('comment.store'),{
        onSuccess : ()=>{
            commentData.comment = '';
            commentData.post_id = '';
        },
        onFinish : ()=>{

        }
    })


}

const page = usePage();
onMounted(() => {
    commentData.post_id = page.props.post.id
})


const dateFormatNoneYear = (postTime)=>{
    const date = new Date(postTime);
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${month}/${day} ${hours}:${minutes}`;
}

const deleteComment = (commentId)=>{
    if(confirm('삭제하시겠습니까?')){
        router.delete(route('comment.destroy',commentId));
    }
}


// const onSubmitEdit = (commentId)=>{
//     const updatedComment = commentData.comment;
//     commentData.put(`/comment/${commentId}`,{
//         comment : updatedComment,
//     });
      // router.put(route('comment.update',commentId));
    // await commentData.put(`/${props.comment/commentId}`);

// }
//
// let editInputValue = '';
// let isEdit = ref(false);
//
// const onSubmitEdit = async (commentId) => {
//     try {
//         await router.put(route('comment.update', commentId),{
//             'comment': editInputValue,
//
//         });
//         editInputValue = '';
//         isEdit.value = false;
//
//     } catch (error) {
//         console.error(error);
//     }
//
// }

// const onClickEdit = (commentId)=>{
//     const commentIndex = props.post.comments.findIndex(comment => comment.id === commentId);
//     if(commentIndex !== -1){
//         isEdit.value = !isEdit.value;
//     }else{
//         isEdit.value = false;
//     }
// }

const onEditComment = (postId)=>{
    router.get(route('comment.edit',postId));
}
// const imgPath = ref(`${props.post.image_path}`);

</script>

<template>
    <Navigation/>

    <div class="w-full pb-80">
        <h1 class="mt-5 text-center text-2xl">게시글 상세</h1>

        <div class="w-full flex flex-wrap justify-center mt-3">
            <div class="w-1/2">
                <input v-model="formData.title" class="border-gray-300 w-full rounded-t-xl border-b-white text-center" type="text" readonly>
                <input :value="dateFormat(formData.created)" type="text" class="text-center w-1/2 border-gray-300 border-r-white" readonly>
                <input v-model="formData.board" class="text-center border-gray-300 w-1/2 " type="text" readonly>
            </div>

        </div>
        <div class="w-full">
<!--            <img :src="imgPath" :alt="formData.image_name">-->
            <textarea v-model="formData.content" readonly class="border-gray-300 w-1/2 m-auto block resize-none h-80 border-t-white rounded-b-xl"></textarea>

        </div>

        <div class="w-1/2 flex justify-end m-auto">
            <button @click="()=>deletePost(post.id)" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75">삭제하기</button>
<!--            <button @click="()=>editPost(post.id)" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75 ml-3">수정하기</button>-->
            <a :href="'/edit/' + post.id " class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75 ml-3">수정하기</a>
        </div>



        <h1 class="text-center text-xl mt-8">Comment</h1>

        <div class="w-full">
            <div class="flex justify-center mt-3">
                <textarea class="resize-none w-1/2 h-10 border border-gray-300 rounded-xl" v-model="commentData.comment"></textarea>

            </div>
            <div class="w-1/2 flex justify-end m-auto">
                <button @click='submitComment' v-bind="post.id" class="border border-gray-300 px-5 py-3 rounded-xl mt-3 hover:text-white hover:bg-black transition delay-75">댓글저장</button>
            </div>

            <div>
                <ul class="w-1/2 flex m-auto mt-10 p-2 text-center border-t border-b border-dashed border-gray-300">
                    <li class="w-1/12">no</li>
                    <li class="w-2/12">username</li>
                    <li class="w-4/12">content</li>
                    <li class="w-3/12">created</li>
                    <li class="w-1/12">edit</li>
                    <li class="w-1/12">del</li>
                </ul>
                <ul v-for="(comment, idx) in post.comments" class="w-1/2 flex m-auto border border-gray-300 mt-3 p-2 rounded-xl">
                    <li class="w-1/12 text-center">{{idx + 1}}</li>
                    <li class="w-2/12 text-center">{{comment.user.name}} : </li>
                    <li class="w-4/12">
<!--                        <div class="flex w-full">-->
<!--                            <form @submit.prevent="onSubmitEdit(comment.id)">-->
<!--&lt;!&ndash;                                <textarea class="resize-none w-1/2 h-10 border border-gray-300 rounded-xl" v-model="comment.comment" required></textarea>&ndash;&gt;-->
<!--                                <input  type="text" id="editInput" v-model="editInputValue" class="w-8/12 border-gray-300 mr-2">-->
<!--                                <button class="w-3/12 border border-gray-300 rounded-xl" type="submit">저장</button>-->
<!--                            </form>-->
<!--                        </div>-->





                        <div>{{comment.comment}}</div>
                    </li>
                    <li class="w-3/12 text-sm text-center">{{dateFormatNoneYear(comment.created_at)}}</li>
<!--                    <li class="w-1/12 text-center"><button @click="()=>onClickEdit(comment.id)" class="border border-gray-300 px-1.5 rounded-xl hover:bg-black hover:text-white transition">edit</button></li>-->
                    <li class="w-1/12 text-center"><button @click="()=>onEditComment(comment.id)" class="border border-gray-300 px-1.5 rounded-xl hover:bg-black hover:text-white transition">edit</button></li>
                    <li class="w-1/12 text-center"><button @click="()=>deleteComment(comment.id)" class="border border-gray-300 px-1.5 rounded-xl hover:bg-black hover:text-white transition">del</button></li>
                </ul>
            </div>


            <div>{{post}}</div>

        </div>


    </div>

    <Footer/>
</template>
