<script setup>
import {inject} from "vue";
import {router} from "@inertiajs/vue3";

const route = inject('route')
const logout = () => {
    router.post(route('logout'));
};

</script>
<template>
    <div class="sticky top-0 z-50">
        <ul class="flex justify-end gap-5 text-lg p-5 bg-black text-white">
            <li><a href="/post" class="hover:text-blue-500 transition">Home</a></li>
            <li v-if="!$page.props.auth.user" ><a href="/login" class="hover:text-blue-500 transition">login</a></li>
            <li v-if="$page.props.auth.user" class="hover:text-blue-500 transition"><a href="/dashboard">' {{$page.props.auth.user.name}} ' 님</a></li>
            <li v-if="!$page.props.auth.user" class="mr-5 hover:text-blue-500 transition"><a href="/register">join</a></li>
            <li v-if="$page.props.auth.user" class="mr-5 cursor-pointer ">
                <a @click="logout" class="hover:text-blue-500 transition">logout</a>
            </li>
        </ul>
    </div>
</template>
