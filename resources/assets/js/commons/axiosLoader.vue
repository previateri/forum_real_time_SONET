<template>
    <div id="preloader" v-show="counter > 0">
        <div class="image">
            <img src="/img/preloader.gif">
            <p>Aguarde...</p>
        </div>

    </div>
</template>

<style>
    #preloader {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(85,85,85,0.6);
    }
    #preloader .image{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 85px;
        height: 70px;
        padding: 5px;
        border: 2px solid #34495E;
        background-color: #FFF;
    }
    #preloader .image img{
        max-width: 100%;
    }
    #preloader .image p {
        text-align: center;
        font-size: 0.7em;
        text-transform: uppercase;
        color: #34495E;
    }
</style>

<script>
    export default{
        data(){
            return {
                counter: 0
            }
        },
        mounted(){
            axios.interceptors.request.use((config) => {
                this.counter++;
                return config;
            }, (error) => {
                return Promise.reject(error);
            });

            axios.interceptors.response.use((response) => {
                this.counter--;
                return response;
            } , (error) => {
                this.counter--;
                return Promise.reject(error);
            });
        }
    }
</script>