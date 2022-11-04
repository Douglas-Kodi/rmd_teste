<template><br>
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h6 class="w3-opacity w3-padding-16">Cadastro de Produto</h6>
                    <form class="w3-container">
                        <select class="w3-select w3-border" v-model="produto.idcateg">
                            <option value="" disabled selected>Selecione a categoria do produto</option>
                            <option v-for="(categoria, index) in categorias" :key="index" :value="categoria.id"><td>{{ categoria.nome }}</td></option>
                        </select>
                        <label>Digite o nome do produto:</label>
                        <input class="w3-input w3-border w3-round" v-model="produto.nome" />
                        <br><label for="imagesArray" class="w3-button w3-left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z"></path></svg></label>
                        <input id="imagesArray" multiple type="file" name="imagem" @change="getFile" />
                        <button type="button" class="w3-button w3-right w3-theme" @click="addProduto()"><i class="fa fa-pencil"></i> &nbsp;Cadastrar</button> 
                        <img :src="avatar" class="w3-round" style="max-height:40px;padding:0px 10px;">
                    </form>
                </div>
            </div>
        </div>
    </div><br>
</template>

<script>
export default {
    props:['categorias'],
    name: "Publication",
    data: function (){
        return {
            produto: {
                idcateg:"",
                nome:"",
                imagem:"",
            },
            avatar:null
        };
    },
    methods:{
        getFile(e){
            this.imagem = e.target.files[0]
            
            let loadImage = e.target.files[0]
            let loadReader = new FileReader();
            loadReader.readAsDataURL(loadImage);
            loadReader.onload = e => {
                this.avatar = e.target.result
            }
        },
        addProduto(){
            let config = {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            };
            let formData = new FormData();
            formData.append('idcateg', this.produto.idcateg);
            formData.append('nome', this.produto.nome);
            formData.append('imagem', this.imagem);

            axios.post('api/produto/store', formData, config)
            .then(response=>{
                if(response.status == 201){
                    this.produto.nome = "";
                    this.avatar = null;
                    this.$emit('reloadProdutos');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
input[type="file"] { 
   display: none;
}
</style>