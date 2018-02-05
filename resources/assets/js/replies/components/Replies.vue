<template>
    <div>
        <div class="card horizontal" v-for="data in replies" :class="{'lime light-4' : data.highlighted}">
            <div class="card-images">
                <img :src="data.user.photo_url" alt="" class="circle responsive-img" style="max-width: 35%; margin:0 auto;">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title">{{ data.user.name }} - {{ responded }}</span>
                    <blockquote>
                        <p>{{ data.body }}</p>
                    </blockquote>
                    <div class="card-action" v-if="logged.role === 'admin' ">
                        <a :href="'/replies/highlite/' + data.id">destacar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM DE RESPOSTA !-->
        <div class="card grey lighten-4" v-if="logged.id && isClosed == '0'">
            <div class="card-content">
                <span class="card-title">{{ reply }}</span>
                <form @submit.prevent="save()">
                    <div class="input-field">
                        <textarea rows="10" class="materialize-textarea" :placeholder="yourAnswer" v-model="reply_to_save.body"></textarea>
                    </div>
                    <button type="submit" class="btn green accent-2">{{ send }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['responded', 'reply', 'yourAnswer', 'send', 'threadId', 'isClosed'],
        data(){
            return {
                replies: [],
                logged: window.user || {},
                is_closed: this.isClosed,
                thread_id: this.threadId,
                reply_to_save: {
                    body: '',
                    thread_id: this.threadId
                }
            }
        },
        methods: {
            save(){
                window.axios.post('/replies/', this.reply_to_save).then(() => {
                    this.getReplies()
                });
            },
            getReplies(){
                window.axios.get('/replies/' + this.thread_id).then((response) => {
                        this.replies = response.data
                });
            }
        },
        mounted() {
            this.getReplies()
            Echo.channel('new.reply.' + this.thread_id).listen('NewReply', (e) => {
                if(e.reply){
                    this.getReplies()
                }
            });
        }
    }
</script>
