<script setup>
const textareaValue = ref('This is clearable text.')
</script>

<template>
  <VTextarea
    v-model="textareaValue"
    clearable
    clear-icon="tabler-circle-x"
    label="Text"
  />
</template>
