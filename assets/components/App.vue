<template>
    <div class="">


    </div>
</template>

<script>
import axios from 'axios'
export default {
    data: () => ({
        adherents : []
    }),
    created() {
        axios.get('http://127.0.0.1:8000/adherents')
            .then(response =>{
                console.log(response)
            })
    }
}
</script>
