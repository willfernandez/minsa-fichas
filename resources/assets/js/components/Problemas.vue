<template>

</template>

<script>
    export default {
        props: ['options_problema'],
        created: function () {
            this.getCategoria();
        },
        watch: {
            categoria_adverso: function()
            {
                console.log(this.categoria_adverso);
            }
        },
        methods :
        {
            getCategoria: function(){
                console.log('entre');
                this.$http.get('/categorias').then(function(response){
                    this.options = response.body;
                });
            },
        }
    }
</script>