<template>
    <li class= 'comment'>
        <p class='comment__author'>{{comment.author}}</p>
        <span class='comment__date'>{{comment.date}}</span>
        <p class='comment__text'>{{comment.text}}</p>
        <span class='comment__close' @click="deleteComment"></span>
        <span class="comment__time">{{comment.time}}</span>
    </li>
</template>

<script>
    export default {
        props: {
            comment: {
                type: Object,
                required: true,
            }
        },

        methods: {
            deleteComment(e) { // передача ID для удаления выше
                let clickedId = e.target.parentNode.getAttribute("id");
                this.$emit("deleteComment", clickedId)
            }
        }
    }
</script>

<style scoped>
    .comment{
        max-width: 400px;
        height: auto;
        word-break: break-all;
        padding: 20px;
        box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.1);
        margin: 15px auto;
        position: relative;
    }

    .comment__author{
        color: #288ce4;
        margin-top: 0;
        margin-right: 10px;
        display: inline;
    }

    .comment__close {
            position: absolute;
            right: 15px;
            top: 15px;
            width: 32px;
            height: 32px;
            opacity: 0.3;
            cursor: pointer;
        }

    .comment__close:hover {
        opacity: 1;
        
    }

    .comment__close:before, 
    .comment__close:after {
        position: absolute;
        left: 15px;
        content: ' ';
        height: 33px;
        width: 2px;
        background-color: #333;
    }
        
    .comment__close:before {
        transform: rotate(45deg);
    }
        
    .comment__close:after {
        transform: rotate(-45deg);
    }

    .comment__date{
        color: #288ce4;
    }
</style>