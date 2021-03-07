<template>
    <div v-if="!image">
        <input type="file" @change="onFileChange">
    </div>
    <div v-else>
        <img :src="image" class="img-thumbnail" />
        <button @click="removeImage" class="btn btn-link">Remove image</button>
    </div>
</template>

<script>
    import { EventBus } from "../../event-bus";

    export default {
        name: "UploadFile",
        data() {
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.$emit('receiveFileChange', files[0])
            },
            createImage(file) {
                let image = new Image();
                let reader = new FileReader();
                let vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            }
        }
    }
</script>

<style scoped>
    img {
        width: 30%;
        /*margin: auto;*/
        /*display: block;*/
        /*margin-bottom: 10px;*/
    }
    button {

    }
</style>
