<template>
    <div class="">
        <input class="border border-r-2" type="text"  placeholder="rechercher" >
        <ul>
            <li v-for="adherent in adherents" :key="adherent.id">{{ adherent.nom}}</li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data: () => ({
        adherents : []
    }),
    created() {
        axios.get('/adherents')
            .then(response => {
                this.adherents = response.data
            })
            .catch(error => console.log(error))
    }
    ,
    methods:{
        getAdhrents(){

        }
    }
}
</script>
