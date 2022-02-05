<template>
    <div class="form-wrapper">
            <img :src='srcImg' alt="captcha">
            <input v-model="this.textCaptcha" @blur="checkCaptcha" type="text" name="captcha" class="form__captcha-text" placeholder = "Введите капчу">
            <div class="form__captcha-error" v-if="disabledError">
                Неверное значение капчи!
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                disabledError: false,
                textCaptcha: "",
            }
        },

        props: ["srcImg"],
                
        methods: {
            checkCaptcha(){
                if (this.textCaptcha == this.getCookie("captcha")){  // проверка ввода капчи
                    this.disabledError = false;
                    this.textCaptcha = ""; // обнулим поле ввода, если верно
                    
                } else{ 
                    this.disabledError = true;
                }
                this.$emit("check", this.disabledError);
            }, 

            getCookie(c_name){
                    if (document.cookie.length>0){
                        let c_start=document.cookie.indexOf(c_name + "=")
                    if (c_start!=-1){ 
                        c_start=c_start + c_name.length+1 
                        let c_end=document.cookie.indexOf(";",c_start)
                        if (c_end==-1) c_end=document.cookie.length
                    return unescape(document.cookie.substring(c_start,c_end))
                    } 
                }
            },
        },

    }
</script>

<style scoped>
    .form__captcha-error{
        border: 2px solid red;
        padding: 10px;
        border-radius: 12px;
        position: absolute;
        top: -50px;
        right: 0%;
        background: rgb(255, 50, 50);
        color: #fff;
    }
</style>>