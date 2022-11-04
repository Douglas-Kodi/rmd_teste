<template>
    <div class="w3-row">
        <!----------------------------------------- SHOW ----------------------------------------->
        <table class="w3-table w3-striped w3-white">
            <tr>
                <td class="w3-center" width="10%">
                    <div v-for="(categoria, index) in categorias" :key="index">
                        <i v-if="produto.idcateg == categoria.id"><img v-bind:src="'/storage/img/categoria/'+categoria.imagem" style="max-height:30px;"></i>
                    </div>
                </td>
                <td class="w3-center" width="20%"><p>{{ produto.nome }}</p></td>
                <td width="50%">
                    <center>
                        <div v-if="produto.imagem!=null">
                            <img v-bind:src="'/storage/img/produto/'+produto.imagem" style="max-height:30px;" v-bind:alt="produto.imagem" />
                        </div>
                        <div v-else>
                            <td><i>Não possui imagem</i></td>
                        </div>
                    </center>
                </td>
                <td class="w3-center" width="10%"><a v-on:click="updateModal(produto.id)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M7.875 2.292a.125.125 0 00-.032.018A7.24 7.24 0 004.75 8.25a7.247 7.247 0 003.654 6.297c.57.327.982.955.941 1.682v.002l-.317 6.058a.75.75 0 11-1.498-.078l.317-6.062v-.004c.006-.09-.047-.215-.188-.296A8.747 8.747 0 013.25 8.25a8.74 8.74 0 013.732-7.169 1.547 1.547 0 011.709-.064c.484.292.809.835.809 1.46v4.714a.25.25 0 00.119.213l2.25 1.385c.08.05.182.05.262 0l2.25-1.385a.25.25 0 00.119-.213V2.478c0-.626.325-1.169.81-1.461a1.547 1.547 0 011.708.064 8.74 8.74 0 013.732 7.17 8.747 8.747 0 01-4.41 7.598c-.14.081-.193.206-.188.296v.004l.318 6.062a.75.75 0 11-1.498.078l-.317-6.058v-.002c-.041-.727.37-1.355.94-1.682A7.247 7.247 0 0019.25 8.25a7.24 7.24 0 00-3.093-5.94.125.125 0 00-.032-.018l-.01-.001c-.003 0-.014 0-.031.01-.036.022-.084.079-.084.177V7.19a1.75 1.75 0 01-.833 1.49l-2.25 1.385a1.75 1.75 0 01-1.834 0l-2.25-1.384A1.75 1.75 0 018 7.192V2.477c0-.098-.048-.155-.084-.176a.062.062 0 00-.031-.011l-.01.001z"></path></svg></a></td>
                <td class="w3-center" width="10%"><a v-on:click="removeModal(produto.id)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z"></path><path d="M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z"></path><path d="M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z"></path></svg></a></td>
            </tr>
            <!----------------------------------------- UPDATE ----------------------------------------->
            <div :id="'updateModal'+produto.id" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-top">
                    <header class="w3-container w3-teal w3-display-container w3-padding-32 w3-medium"> 
                        <span v-on:click="updateModalClose(produto.id)" @click="clearUpdate" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
                    </header>
                    <form>
                        <div style="padding:15px;">
                            <select class="w3-select w3-border" v-model="produto.idcateg">
                                <option value="" disabled selected>Selecione a categoria do produto</option>
                                <option v-for="(categoria, index) in categorias" :key="index" :value="categoria.id"><td>{{ categoria.nome }}</td></option>
                            </select>
                            <label>Digite o nome do produto:</label>
                            <input class="w3-input w3-border w3-round" v-model="produto.nome" />
                            <center>
                                <div :id="'updateImg'+produto.id" class="w3-image w3-mobile" style="width:35%">
                                    <div class="w3-display-container">
                                        <div v-if="avatarUp == null">
                                            <div v-if="produto.imagem!=null">
                                                <img v-bind:src="'/storage/img/produto/'+produto.imagem" v-bind:alt="produto.imagem">
                                                <span class="w3-button w3-display-topright" @click="clearImg(produto.id)"><i class="fa fa-remove"></i></span>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <img :src="avatarUp">
                                            <span class="w3-button w3-display-topright" @click="clearImg(produto.id)"><i class="fa fa-remove"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <label :for="'imagesArrayUp'+produto.id" class="w3-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z"></path></svg></label>
                                <input :id="'imagesArrayUp'+produto.id" type="file" name="imagemUp" @change="getFileUp" @click="showImg(produto.id)" />
                            </center>
                        </div>
                        <footer class="w3-container w3-teal w3-padding-16">
                            <button type="button" class="w3-button w3-right w3-theme" @click="updateProduto(produto.id); clearUpdate();" v-on:click="updateModalClose(produto.id)"><i class="fa fa-pencil"></i> &nbsp;Edit</button> 
                        </footer>
                    </form>
                </div>
            </div>
            <!----------------------------------------- DELETE ----------------------------------------->
            <div :id="'removeModal'+produto.id" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-top">
                    <header class="w3-container w3-teal w3-display-container w3-padding-16 w3-large"> 
                        <span v-on:click="removeModalClose(produto.id)" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
                        <h5>Atenção!!!</h5>
                    </header>
                    <div class="w3-container w3-padding-24 w3-center">
                        <p>Deseja mesmo excluir esse cadastro? {{ produto.id }}</p>
                    </div>
                    <footer class="w3-container w3-teal w3-padding-16">
                        <button type="button" class="w3-button w3-theme-d1 w3-right" @click="removeProduto(produto.id);" v-on:click="removeModalClose(produto.id)"><i class="fa fa-trash"></i> &nbsp;Excluir</button>
                    </footer>
                </div>
            </div>
        </table>
    </div>
</template>

<script>
export default {
    props:['categorias', 'produto'],
    data: function (){
        return {
            avatarUp: null,
        };
    },
    methods:{
        updateModal:function(event){
            return document.getElementById('updateModal'+event).style.display='block';
        },
        updateModalClose:function(event){
            return document.getElementById('updateModal'+event).style.display='none';
        },
        removeModal:function(event){
            return document.getElementById('removeModal'+event).style.display='block';
        },
        removeModalClose:function(event){
            return document.getElementById('removeModal'+event).style.display='none';
        },
        getFileUp(e){
            this.imagemUp = e.target.files[0]
            
            let loadImageUp = e.target.files[0]
            let loadReaderUp = new FileReader();
            loadReaderUp.readAsDataURL(loadImageUp);
            loadReaderUp.onload = e => {
                this.avatarUp = e.target.result
            }
        },
        clearUpdate(){
            this.imagemUp = null;
            this.loadImageUp = null;
            this.loadReaderUp = null;
            this.avatarUp = null;
        },
        clearImg(e){
            this.imagemUp = "clear";
            this.loadImageUp = null;
            this.loadReaderUp = null;
            this.avatarUp = null;
            this.avatar = null;
            return document.getElementById('updateImg'+e).style.display='none';
        },
        showImg(e){
            document.getElementById('updateImg'+e).style.display='block';
        },
        updateProduto(event){
            let config = {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            };
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('idcateg', this.produto.idcateg);
            formData.append('nome', this.produto.nome);
            formData.append('imagemUp', this.imagemUp);
            
            axios.post('api/produto/'+ event, formData, config)
            .then(response=>{
                if(response.status == 200){
                    this.$emit('reloadProdutos');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removeProduto(event){
            axios.delete('api/produto/' + event)
            .then(response => {
                if(response.status == 200){
                    this.$emit('reloadProdutos');
                }
            })
            .catch(error => {
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