<script setup>
const skill = ref(20)
const knowledge = ref(33)
const power = ref(78)
</script>

<template>
  <div>
    <VProgressLinear
      v-model="power"
      color="primary"
      height="8"
    />

    <br>

    <VProgressLinear
      v-model="skill"
      color="primary"
      height="20"
    >
      <template #default="{ value }">
        <strong>{{ Math.ceil(value) }}%</strong>
      </template>
    </VProgressLinear>

    <br>

    <VProgressLinear
      v-model="knowledge"
      height="20"
      color="primary"
    >
      <strong>{{ Math.ceil(knowledge) }}%</strong>
    </VProgressLinear>
  </div>
</template>
