<script>
export default {
    inheritAttrs: false
}
</script>

<script setup>

</script>

<template>
    <div class="overflow-x-auto rounded-lg">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
                <table v-bind="$attrs">
                    <slot></slot>
                </table>
            </div>
        </div>
    </div>
</template>