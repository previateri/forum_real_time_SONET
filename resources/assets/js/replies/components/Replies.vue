<template>
    <div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Thiago {{ responded }}</span>
                <blockquote>
                    <p>Quos quam sequi quod incidunt. Odit maiores nihil officia adipisci. Voluptatem consequatur quos corporis est ipsum sunt.</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Thiago {{ responded }}</span>
                <blockquote>
                    <p>Quos quam sequi quod incidunt. Odit maiores nihil officia adipisci. Voluptatem consequatur quos corporis est ipsum sunt.</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Thiago {{ responded }}</span>
                <blockquote class="">
                    <p>Quos quam sequi quod incidunt. Odit maiores nihil officia adipisci. Voluptatem consequatur quos corporis est ipsum sunt.</p>
                </blockquote>
            </div>
        </div>
        <div class="card grey lighten-4">
            <div class="card-content">
                <span class="card-title">{{ reply }}</span>
                <form action="">
                    <div class="input-field">
                        <textarea rows="10" class="materialize-textarea" :placeholder="yourAnswer"></textarea>
                    </div>
                    <button type="submit" class="btn green accent-2">{{ send }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['responded', 'reply','yourAnswer', 'send']
    }
</script>
