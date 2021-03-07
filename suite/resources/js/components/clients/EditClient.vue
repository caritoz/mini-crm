<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-left">Edit Client</h3>
                <div class="row">
                    <div class="col-md-6">
                        <form @submit.prevent="updateClient" @keydown="errors.clear($event.target.name)" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" v-model="first_name">
                                <span class="help is-danger text-danger" v-if="errors.has('first_name')" v-text="errors.get('first_name')"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" v-model="last_name">
                                <span class="help is-danger text-danger" v-if="errors.has('last_name')" v-text="errors.get('last_name')"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" v-model="email">
                                <span class="help is-danger text-danger" v-if="errors.has('email')" v-text="errors.get('email')"></span>
                            </div>

                            <div class="form-group">
                                <label>Avatar</label>
                                <UploadFile @receiveFileChange="handleChangeFile"></UploadFile>
                            </div>

                            <div class="form-group float-right mt-5">
                                <button type="submit" class="btn btn-primary" :disabled="errors.any()">Update Client</button>
                                <a @click="$router.go(-1)" class="btn btn-link">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <img :src="getPic()" class="img-thumbnail" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UploadFile from '../partials/UploadFile'
    import {mapActions, mapGetters, mapState} from "vuex";

    export default {
        name: "EditClient",
        components: {
            UploadFile
        },
        data() {
            return {
                file: '',
            }
        },
        beforeMount() {
            // console.log(`At this point, vm.$el has not been created yet.`)
        },
        computed: {
            ...mapState({
                errors: state => state.clients.errors
            }),
            ...mapGetters({
                client: 'clients/entity',
            }),
            // ...mapActions([
            //     'updateClient'
            // ]),
            first_name: {
                get () {
                    return this.$store.state.clients.entity.first_name
                },
                set (value) {
                    this.$store.commit('clients/updateFirstName', value)
                }
            },
            last_name:{
                get () {
                    return this.$store.state.clients.entity.last_name;
                },
                set (value) {
                    this.$store.commit('clients/updateLastName', value)
                }
            },
            email:{
                get () {
                    return this.$store.state.clients.entity.email;
                },
                set (value) {
                    this.$store.commit('clients/updateEmail', value)
                }
            }
        },
        mounted() {
            this.getClient()
        },
        methods: {
            handleChangeFile(elem) {
                this.file = elem;
                // this.$store.dispatch('clients/updateAvatar', elem)
            },
            getPic(){
                return this.$store.state.clients.entity.full_path_avatar;
            },
            getClient(){
                this.$store.dispatch('clients/editClient', {
                    id: this.$route.params.id
                })
            },
            // ...mapActions([
            //     'updateClient'
            // ]),
            updateClient(event) {
                let data = new FormData(event.target);
                data.append('client_id', this.$store.state.clients.entity.id)
                data.append('avatar', this.file)

                this.$store.dispatch('clients/updateClient', data )
            },
            cancel(){
                this.$router.push({name: 'Clients'});
            },
        }
    }
</script>

<style scoped></style>
