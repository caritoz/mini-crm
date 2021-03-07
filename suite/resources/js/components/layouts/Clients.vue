<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3 class="display-4 text-left">Clients</h3>
            </div>
            <div class="col-md-9">
                <span class="text-right"><router-link to="/clients/add" class="nav-item nav-link">Add ++</router-link></span>
            </div>
            <div class="col-md-12">
                <ListClient/>
            </div>
        </div>
    </div>
</template>

<script>
    import ListClient from '../clients/ListClient'
    export default {
        name: "Clients",
        components: {
            ListClient
        }
    }
</script>
