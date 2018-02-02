<template>
    <div class="card">
        <div class="card-content">
            <span class="card-title">{{ title }}</span>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ title }}</th>
                    <th>{{ replies }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="thread in threads_response.data" :class="{'lime light-4' : thread.fixed , 'grey-text text-light-2' : thread.closed}">
                    <td>{{ thread.id }}</td>
                    <td>{{ thread.title }}</td>
                   <td>{{ thread.replies_count || 0}}</td>
                    <td>
                        <a :href="'/threads/' + thread.id" class="btn">{{ action }}</a>
                        <a v-if="logged.role === 'admin' " :href="'/threads/pin/' + thread.id" class="btn">{{ fix }}</a>
                        <a v-if="logged.role === 'admin' " :href="'/threads/close/' + thread.id" class="btn">{{ close }}</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="card-content white" v-if="logged.id">
            <span class="card-title">{{ newThread }}</span>
            <form @submit.prevent="save()">
                <div class="input-field">
                    <input type="text" :placeholder="title" v-model="threads_to_save.title" />
                </div>
                <div class="input-field">
                    <textarea class="materialize-textarea" :placeholder="bodyThread" v-model="threads_to_save.body"></textarea>
                </div>
                <button type="submit" class="btn red accent-2">{{ send }}</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props           : ['title', 'replies', 'action', 'newThread', 'titleThread', 'bodyThread', 'send', 'fix', 'close'],
        data(){
            return {
                logged: window.user || {},
                threads_response : [],
                threads_to_save: {
                    'title' : '',
                    'body'  : ''
                }
            }
        },
        methods:{
                save(){
                    window.axios.post('/threads', this.threads_to_save).then(() => {
                        this.getThreads()
                    })
                },
                getThreads(){
                    window.axios.get('/threads').then((response) => {
                        this.threads_response = response.data
                    });
                }
        },
       mounted(){
           this.getThreads()
            Echo.channel('new.thread').listen('NewThread', (e) => {
                if (e.thread) {
                     this.threads_response.data.splice(0, 0, e.thread)
                 }
            });
       }
    }
</script>
