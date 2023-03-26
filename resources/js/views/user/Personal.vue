<template>
    <div class="w-96 mx-auto">
        <div class="mb-4">
            <div>
                <input v-model="title" class="mb-3 p-2 w-96 rounded-3xl border border-state-300" type="text" placeholder="title">
            </div>
            <div>
                <textarea v-model="content" class="mb-3 p-2 w-96 rounded-3xl border border-state-300" placeholder="content"></textarea>
            </div>
            <div class="flex mb-3 items-center">
                <div>
                    <input @change="storeImage" ref="file" type="file" class="hidden">
                    <a href="#" class="block p-2 w-16 text-center text-sm rounded-3xl bg-sky-500 text-white" @click.prevent="selectFile()">Image</a>
                </div>
                <div v-if="image" class="ml-3">
                    <a @click.prevent="image = null" href="#">Cancel</a>
                </div>
            </div>
            <div v-if="image">
                <img :src="image.url" alt="preview">
            </div>
            <div>
                <a @click.prevent="store" href="#" class="block p-2 w-32 text-center rounded-3xl bg-green-600 text-white ml-auto
                                   hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border">Publish</a>
            </div>
        </div>

<!--        Вывод списка-->
        <div v-if="posts">
            <h1 class="mb-6 pb-6 border-b border-gray-600">Posts</h1>
            <Post v-for="post in posts" :post="post"></Post>
<!--            <div v-for="post in posts" class="mb-6 pb-6 border-b border-gray-600">-->
<!--                <h1 class="text-xl">{{ post.title }}</h1>-->
<!--                <img class="my-3 mx-auto" v-if="post.image_url" :src="post.image_url" alt="post.title">-->
<!--                <p>{{ post.content }}</p>-->
<!--                <p class="mt-2 text-right text-slate-500 ml-auto text-sm">{{ post.date }}</p>-->
<!--            </div>-->
        </div>

    </div>
</template>

<script>

import Post from "../../components/Post.vue";
export default {
    name: "Personal",

    data() {
        return {
            title: '',
            content: '',
            image: null,
            posts: []
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
            axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data.data;
                });
            //console.log(this.posts);
        },

        store() {
            const id = this.image ? this.image.id : null;
            axios.post('/api/posts', {title: this.title, content: this.content, image_id: id})
            .then( res => {
                this.title = '';
                this.content = '';
                this.image = null;
                this.posts.unshift(res.data.data);
                //console.log(res);
            })
        },

        selectFile() {
            this.fileInput = this.$refs.file;
            this.fileInput.click();
        },

        storeImage(e) {
            const file = e.target.files[0];

            const formData = new FormData();
            formData.append('image', file);

            axios.post('/api/post_images/', formData)
            .then(res => {
                //console.log(res);
                this.image = res.data.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
