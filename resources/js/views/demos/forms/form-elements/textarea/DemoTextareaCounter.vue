<script setup>
const textareaValue = ref('Hello!')
</script>

<template>
  <VTextarea
    v-model="textareaValue"
    counter
    label="Text"
  />
</template>
