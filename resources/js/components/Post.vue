<template>
    <div class="mb-6 pb-6 border-b border-gray-600">
        <h1 class="text-xl">{{ post.title }}</h1>
        <img class="my-3 mx-auto" v-if="post.image_url" :src="post.image_url" alt="post.title">
        <p>{{ post.content }}</p>
        <div class="flex justify-between items-center mt-2">
            <div class="flex">


                <svg @click.prevent="toggleLike(post)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    :class="['mr-2 stroke-sky-500 w-6 h-6 cursor-pointer hover:fill-sky-500', post.is_liked ? 'fill-sky-500' : 'fill-white']">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <p>{{ post.likes_count }}</p>
            </div>

            <p class="text-right text-slate-500 ml-auto text-sm">{{ post.date }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",

    props: [
        'post'
    ],

    methods: {
        toggleLike(post) {
            axios.get(`/api/posts/${post.id}/toggle_like`)
                .then(res => {
                    post.is_liked = res.data.is_liked;
                    post.likes_count = res.data.likes_count;
                    //console.log(res.data.is_liked);
                });
        }
    },
}
</script>

<style scoped>

</style>
