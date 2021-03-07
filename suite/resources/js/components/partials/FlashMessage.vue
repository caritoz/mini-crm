<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <Transition name="slide-fade">
                    <div
                        v-if="message.text"
                        :class="{
                          'alert-danger': message.type === 'ERROR',
                          'alert-success': message.type === 'SUCCESS'
                        }"
                        class="alert fade show text-center" role="alert">
                        {{ message.text }}
                    </div>
                </Transition>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from "../../event-bus";
    export default {
        data() {
            return {
                message: {
                    text: null,
                    type: null,
                }
            };
        },
        mounted() {
            let timer;
            EventBus.$on('flash-message', (_message, _type) => {
                clearTimeout(timer);
                this.message.text = _message;
                this.message.type = _type;
                timer = setTimeout(() => {
                    this.message.text = null;
                }, 5000);
            });
        }
    };
</script>

<style scoped>
    .slide-fade-enter-active,
    .slide-fade-leave-active {
        transition: all 0.4s;
    }
    .slide-fade-enter,
    .slide-fade-leave-to {
        transform: translateX(400px);
        opacity: 0;
    }
</style>
