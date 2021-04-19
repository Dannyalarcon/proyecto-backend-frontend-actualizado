new Vue({
    el: "#app2",
    data: { 
        info: [],
        id_agenda: ""
    },


    created() {
        axios.get("http://localhost/mayris_api/apis/agenda/view_cita_finalizado.php").then(result => {
            console.log('tus datos se han impreso correctamente!')
            console.log(result.data)
        });
    },
    mounted() {
        axios.get("http://localhost/mayris_api/apis/agenda/view_cita_finalizado.php").then((result) => {
            (this.info = result.data)
        }).catch(e => {
            this.errors.push(e)
        })
    },
 

})
