<template>
    <form method="POST" class = "form">
        <input type="text" v-model="newComment.author" name="author" class="form__author" placeholder = "Введите ваше имя">
        <textarea type="text" v-model="newComment.text" name="text" class = "form__text" placeholder = "Оставьте свой комментарий..."></textarea>
        <my-captcha :srcImg="srcImg" @check="this.captchaValue = !$event"></my-captcha>
        <button @click="createComment" class="form__btn">Добавить комментарий</button>
        
    </form>
</template>

<script>
    import myCaptcha from "./myCaptcha.vue"
    export default {
        components: {
            myCaptcha,
        },

        props: ["srcImg"], // передаем путь для картинки в myCaptcha

        data() {
            return {
                newComment: {
                    author: "",
                    text: "",
                },
                captchaValue: null,
            }
        },

        methods: {
            createComment(e) {
                e.preventDefault();
                console.log(this.captchaValue)
                if (this.captchaValue){
                    this.newComment.id = null; // Id будет создаваться перед пушом в массив
                    this.newComment.time = new Date().getHours() + ":" + new Date().getMinutes(); // время

                    let currentYear = new Date().getFullYear(); 
                    let today = ("0" + new Date().getDate()).slice(-2); // дата с нулем
                    let currentMonth = ("0" + (new Date().getMonth() + 1)).slice(-2);
                    this.newComment.date = `${today}.${currentMonth}.${currentYear}`;

                    this.$emit("create", this.newComment); 

                    this.newComment = {    // сброс значений со всех полей
                        author: "",
                        text: "",
                    }
                }
            },
        }
    }
</script>

<style scoped>
    .form{
        display: flex;
        margin: 40px 0;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .form-wrapper{
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 10px;
        position: relative;
    }

    .create__text{
        resize: none;
        margin-top: 5px;
        width: auto;
        height: auto;
        border: 1px solid #229CFF;
        border-radius: 2px;
        font-size: 16px;
        margin: 30px 0;
    }

    .form__text{
        margin: 15px 0;
        width: 300px;
        height: 100px;
    }

    .form__btn{
        background: #288ce4;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        padding: 5px 10px;
        color: #fff;
    }

</style>