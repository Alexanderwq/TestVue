<template>
    <ul class="list">
        <list-item 
            v-for="comment in comments" 
            :comment="comment" 
            :key="comment.id" 
            :id="comment.id"
            @deleteComment="deleteComment">
            <!-- два атрибута id: один для ключа vue, другой атрибут ID получения Id по клику-->
        </list-item>
    </ul>
</template>

<script>
    import listItem from "./listItem.vue"

    export default {
        components: {
            listItem,
        },

        props: {
            comments: {
                type: Array,
                required: true,
            }
        },

        methods: {
            deleteComment(clickedId){
                this.$emit("delete", clickedId);
            }
        }
    }
</script>

<style scoped>
    .list{
        list-style: none;
        margin: 0 auto;
        padding: 0;
    }
</style>