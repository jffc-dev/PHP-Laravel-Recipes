<template>
    <input 
        type="submit" 
        value="Eliminar ×" 
        class="btn btn-danger mr-1"
        @click="EliminarCategoria"
    >
</template>

<script>
    export default {
        props: ['categoriaId'],
        methods: {
            EliminarCategoria(){
                this.$swal({
                    title: '¿Deseas eliminar esta categoria?',
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
                            id : this.categoriaId
                        }
                        //Petición al servidor
                        axios.post(`/categorias/${this.categoriaId}`, {params, _method: 'delete'}).then(respuesta => {
                            this.$swal({
                                title: 'Categoria Eliminada',
                                text: 'Se eliminó a categoria',
                                icon: 'success'
                            });
                            
                            //Eliminar del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                            // this.$el.parentElement.parentElement.remove()
                            //Toca video 95

                        }).catch(error => {
                            console.log(error)
                        })

                    }
                })
            }
        }
    }
</script>