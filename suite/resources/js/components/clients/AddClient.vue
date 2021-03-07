<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-left">Add Client</h3>
                <div class="row">
                    <div class="col-md-6">
                        <form @submit.prevent="addClient" @keydown="errors.clear($event.target.name)">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" v-model="client.first_name">
<!--                                <input type="text" class="form-control" v-model="client.first_name" @keydown="errors.clear('first_name')">-->
                                <span class="help is-danger text-danger" v-if="errors.has('first_name')" v-text="errors.get('first_name')"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" v-model="client.last_name">
                                <span class="help is-danger text-danger" v-if="errors.has('last_name')" v-text="errors.get('last_name')"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" v-model="client.email">
                                <span class="help is-danger text-danger" v-if="errors.has('email')" v-text="errors.get('email')"></span>
                            </div>

                            <div class="form-group">
                                <label>Avatar</label>
                                <UploadFile @receiveFileChange="handleChangeFile"></UploadFile>
                            </div>

                            <button type="submit" class="btn btn-primary" :disabled="errors.any()">Add Client</button>
                            <router-link to="/clients" class="btn btn-link">Cancel</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UploadFile from '../partials/UploadFile'
    import {mapActions, mapState} from 'vuex'
    export default {
        name: "AddClient",
        components: {
            UploadFile
        },
        computed: {
            ...mapState({
                errors: state => state.clients.errors
            })
        },
        data() {
            return {
                client: {},
                file: '',
            }
        },
        methods: {
            handleChangeFile(elem) {
                this.file = elem;
                // this.$store.dispatch('clients/updateAvatar', elem)
            },
            addClient(event) {
                let data = new FormData(event.target);
                data.append('avatar', this.file)

                this.$store.dispatch('clients/addClient', data)
            }
        }
    }
</script>

<style scoped></style>
