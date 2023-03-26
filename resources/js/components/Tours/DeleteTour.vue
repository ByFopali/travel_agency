<template>

</template>

<script>
export default {
    methods: {
        deletePost(postId) {
            axios.delete(`/api/posts/${postId}`)
                .then(response => {
                    console.log(response.data);
                    // Обробка успішного видалення поста
                })
                .catch(error => {
                    console.log(error.response.data);
                    // Обробка помилки
                });
        }
    }
}
</script>

<style scoped>

</style>
