<template>
    <div class="card lime lighten-4">
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
                <tr>
                    <td>1</td>
                    <td>Title of Thread Laravel Real Time</td>
                    <td>6</td>
                    <td>
                        <a href="/threads/1">{{ action }}</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'replies', 'action']
    }
</script>
