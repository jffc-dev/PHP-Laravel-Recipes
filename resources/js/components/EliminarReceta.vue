<template>
    <input 
        type="submit" 
        value="Eliminar ×" 
        class="btn btn-danger mr-1"
        @click="EliminarReceta"
    >
</template>

<script>
    export default {
        props: ['recetaId'],
        methods: {
            EliminarReceta(){
                this.$swal({
                    title: '¿Deseas eliminar esta receta?',
                    text: "Una vez eliminada no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        const params = {
                            id : this.recetaId
                        }
                        //Petición al servidor
                        axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'}).then(respuesta => {
                            this.$swal({
                                title: 'Receta Eliminada',
                                text: 'Se eliminó a receta',
                                icon: 'success'
                            });
                            
                            //Eliminar del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                            // this.$el.parentElement.parentElement.remove()
                            //Toca video 95

                        }).catch(error => {
                            console.log("asddd")
                        })

                    }
                }).catch(error => {
                            console.log("like")
                        })
            }
        }
    }
</script>