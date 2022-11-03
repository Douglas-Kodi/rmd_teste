<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        
        <Publication 
        :categorias="categorias"
        v-on:reloadProdutos="reload()"
        />
        <div v-for="(produto, index) in produtos" :key="index">
            <Panel 
            :categorias="categorias"
            :produto="produto"
            v-on:reloadProdutos="reload()"
            />
        </div>

    </AuthenticatedLayout>
</template>

<script>
import Publication from '../Components/Dashboard/Publication.vue'
import Panel from '../Components/Dashboard/Panel.vue'

export default {
    name:"Dashboard",
    components:{
        Publication,
        Panel
    },
    data: function () {
        return {
            categorias:[],
            produtos:[],
        }
    },
    methods: {
        getCategorias(){
            axios.get('api/categorias')
            .then(response => {
                this.categorias = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        getProdutos(){
            axios.get('api/produtos')
            .then(response => {
                this.produtos = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        reload(){
            this.getCategorias();
            this.getProdutos();
        }
    },
    created(){
        this.getCategorias();
        this.getProdutos();
    }
}
</script>
