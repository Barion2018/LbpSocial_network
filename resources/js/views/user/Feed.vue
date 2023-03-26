<template>
    <div class="w-96 mx-auto">
    <!--        Вывод списка-->
        <div v-if="posts">
            <h1 class="mb-6 pb-6 border-b border-gray-600">Posts</h1>
            <Post v-for="post in posts" :post="post"></Post>
        </div>

    </div>
</template>

<script>
import Post from "../../components/Post.vue";

export default {
    name: "Feed",

    data() {
        return {
            posts: [],
        }
    },

    components: {
        Post
    },

    mounted() {
        this.getPosts();
    },

    methods: {
        getPosts() {
            axios.get(`/api/users/following_posts`)
                .then(res => {
                    this.posts = res.data.data;
                });
            // console.log(this.$route.params.id);
        },
    }
}
</script>

<style scoped>

</style>
