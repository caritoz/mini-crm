<template>
    <div>
        <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group">
                <li class="list-group-item" v-for="result in results" @click="getSelect(result)">
                    {{ result.label }}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default{
        name: "AutoComplete",
        data(){
            return {
                query: '',
                results: []
            }
        },
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 2){
                    axios.get('/auth/search',{params: {query: this.query}}).then(response => {
                        this.results = response.data;
                    });
                }
            },
            getSelect(elem){
                this.query = elem.label;
                this.$emit('receiveAutCompleteValue', elem.value);
                this.results = [];
            }
        }
    }
</script>
