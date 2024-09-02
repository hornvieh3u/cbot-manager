<template>
  <div class="demo-space-y">
    <VProgressLinear
      model-value="15"
      color="primary"
      reverse
    />

    <VProgressLinear
      color="primary"
      indeterminate
      reverse
    />

    <VProgressLinear
      model-value="30"
      buffer-value="55"
      color="primary"
      reverse
      streams
    />
  </div>
</template>
