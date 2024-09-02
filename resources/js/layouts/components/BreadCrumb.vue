<!-- To do refactoring later... -->
<script setup>
import { useRoute } from 'vue-router';
const route = useRoute()

</script>

<template>
    <span class="text-h6" :style="{ color: '#7367F0', textTransform: 'capitalize !important' }">
        {{ route.name === 'home' && Object.keys(route.query).length !== 0 ? 'Map Detail' : route.name.split('-').join(' ') }}
    </span>
</template>