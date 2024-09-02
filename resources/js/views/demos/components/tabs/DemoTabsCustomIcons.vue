<template>
  <VTabs
    next-icon="tabler-arrow-right"
    prev-icon="tabler-arrow-left"
  >
    <VTab
      v-for="i in 10"
      :key="i"
    >
      Item {{ i }}
    </VTab>
  </VTabs>
  <VDivider />
</template>
