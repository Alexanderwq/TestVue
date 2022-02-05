<template>
    <my-post>
    </my-post>
    <my-form 
        :srcImg="srcImg" 
        :captcha="captcha" 
        @create="createComment">
    </my-form>
    <my-list 
        :comments="comments" 
        @delete="deleteComment">
    </my-list>
</template>

<script>
    import myForm from "./components/myForm.vue"
    import myList from "./components/myList.vue"
    import myPost from "./components/myPost.vue"
    
    export default {
        components: {
            myForm,
            myList,
            myPost,
        },

        data(){
            return {
                comments: [],
                srcImg: "img/captcha.png?" + Math.random(), // путь для изображения 
            }
        },

        methods: {
            createComment(newComment){ 
                newComment.id = this.comments.length;
                this.comments.unshift(newComment);
                this.addCommentFetch(newComment); // добавляем в бд
                this.reloadCaptchaFetch(); // обновляем код капчи
                this.srcImg = "img/captcha.png?" + Math.random(); // обновляем путь изображения капчи
            },

            deleteComment(clickedId){ // удаление с массива и из БД
                this.comments.find((item, i) => {    // ищем элемент с таким же id и удаляем из массива
                    if (item.id == clickedId){
                        this.sendIdFetch(clickedId);
                        return this.comments.splice(i, 1);
                    }
                })
            },
           
            async loadCommentsFetch(){            // запрос с api постов
                let response = await fetch('/getComments.php');
                let result = await response.json();
                this.comments = result;
            },

            async sendIdFetch(body){ // отправка ID на удаление
                await fetch('/delete.php', {
                    method: 'POST',
                    body: JSON.stringify(body),
                });
                
            },

            async addCommentFetch(body){  // добавляем в базу данных
                let res = await fetch('/sendComment.php', {
                    method: 'POST',
                    body: JSON.stringify(body),
                });
                return res;
            },

            async reloadCaptchaFetch(){            // обновление кода капчи
                let response = await fetch('/captcha.php');
                let result = await response.text();
                console.log(result);
            },
        },

        mounted(){
            this.loadCommentsFetch();
            this.reloadCaptchaFetch();
            this.srcImg = "img/captcha.png?" + Math.random();
        }
    }
</script>

<style scoped>

</style>