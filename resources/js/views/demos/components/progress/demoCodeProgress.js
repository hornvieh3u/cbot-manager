export const circularColor = { ts: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      model-value="100"
      color="primary"
    />

    <VProgressCircular
      model-value="80"
      color="secondary"
    />

    <VProgressCircular
      model-value="60"
      color="success"
    />

    <VProgressCircular
      model-value="40"
      color="info"
    />

    <VProgressCircular
      model-value="20"
      color="warning"
    />

    <VProgressCircular
      model-value="20"
      color="error"
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      model-value="100"
      color="primary"
    />

    <VProgressCircular
      model-value="80"
      color="secondary"
    />

    <VProgressCircular
      model-value="60"
      color="success"
    />

    <VProgressCircular
      model-value="40"
      color="info"
    />

    <VProgressCircular
      model-value="20"
      color="warning"
    />

    <VProgressCircular
      model-value="20"
      color="error"
    />
  </div>
</template>
` }

export const circularIndeterminate = { ts: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      indeterminate
      color="primary"
    />

    <VProgressCircular
      indeterminate
      color="secondary"
    />

    <VProgressCircular
      indeterminate
      color="success"
    />

    <VProgressCircular
      indeterminate
      color="info"
    />

    <VProgressCircular
      indeterminate
      color="warning"
    />

    <VProgressCircular
      indeterminate
      color="error"
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      indeterminate
      color="primary"
    />

    <VProgressCircular
      indeterminate
      color="secondary"
    />

    <VProgressCircular
      indeterminate
      color="success"
    />

    <VProgressCircular
      indeterminate
      color="info"
    />

    <VProgressCircular
      indeterminate
      color="warning"
    />

    <VProgressCircular
      indeterminate
      color="error"
    />
  </div>
</template>
` }

export const circularRotate = { ts: `<script setup lang="ts">
const interval = ref()
const progressValue = ref(0)

onMounted(() => {
  interval.value = setInterval(() => {
    if (progressValue.value === 100)
      return progressValue.value = 0
    progressValue.value += 10
  }, 1000)
})

onBeforeUnmount(() => {
  clearInterval(interval.value)
})
</script>

<template>
  <div class="demo-space-x">
    <VProgressCircular
      :rotate="360"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="90"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="170"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="-90"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>
  </div>
</template>
`, js: `<script setup>
const interval = ref()
const progressValue = ref(0)

onMounted(() => {
  interval.value = setInterval(() => {
    if (progressValue.value === 100)
      return progressValue.value = 0
    progressValue.value += 10
  }, 1000)
})
onBeforeUnmount(() => {
  clearInterval(interval.value)
})
</script>

<template>
  <div class="demo-space-x">
    <VProgressCircular
      :rotate="360"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="90"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="170"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>

    <VProgressCircular
      :rotate="-90"
      :size="70"
      :width="6"
      :model-value="progressValue"
      color="primary"
    >
      {{ progressValue }}
    </VProgressCircular>
  </div>
</template>
` }

export const circularSize = { ts: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      :width="3"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="50"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="50"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="70"
      :width="7"
      color="primary"
      indeterminate
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-x">
    <VProgressCircular
      :width="3"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="50"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="50"
      color="primary"
      indeterminate
    />

    <VProgressCircular
      :size="70"
      :width="7"
      color="primary"
      indeterminate
    />
  </div>
</template>
` }

export const linearBuffering = { ts: `<script setup lang="ts">
const modelValue = ref(10)
const bufferValue = ref(20)
const interval = ref()

const startBuffer = () => {
  clearInterval(interval.value)

  interval.value = setInterval(() => {
    modelValue.value += Math.random() * (15 - 5) + 5
    bufferValue.value += Math.random() * (15 - 5) + 6
  }, 2000)
}

onMounted(startBuffer)

onBeforeUnmount(() => {
  clearInterval(interval.value)
})

watch(modelValue, () => {
  if (modelValue.value < 100)
    return false

  modelValue.value = 0
  bufferValue.value = 10
  startBuffer()
})
</script>

<template>
  <div class="demo-space-y">
    <VProgressLinear
      v-model="modelValue"
      color="primary"
      height="8"
      :buffer-value="bufferValue"
    />

    <VProgressLinear
      v-model="modelValue"
      color="primary"
      height="8"
      :buffer-value="bufferValue"
    />

    <VProgressLinear
      v-model="modelValue"
      :buffer-value="bufferValue"
      color="primary"
      height="8"
    />

    <VProgressLinear
      v-model="modelValue"
      :buffer-value="bufferValue"
      color="primary"
      height="8"
    />
  </div>
</template>
`, js: `<script setup>
const modelValue = ref(10)
const bufferValue = ref(20)
const interval = ref()

const startBuffer = () => {
  clearInterval(interval.value)
  interval.value = setInterval(() => {
    modelValue.value += Math.random() * (15 - 5) + 5
    bufferValue.value += Math.random() * (15 - 5) + 6
  }, 2000)
}

onMounted(startBuffer)
onBeforeUnmount(() => {
  clearInterval(interval.value)
})
watch(modelValue, () => {
  if (modelValue.value < 100)
    return false
  modelValue.value = 0
  bufferValue.value = 10
  startBuffer()
})
</script>

<template>
  <div class="demo-space-y">
    <VProgressLinear
      v-model="modelValue"
      color="primary"
      height="8"
      :buffer-value="bufferValue"
    />

    <VProgressLinear
      v-model="modelValue"
      color="primary"
      height="8"
      :buffer-value="bufferValue"
    />

    <VProgressLinear
      v-model="modelValue"
      :buffer-value="bufferValue"
      color="primary"
      height="8"
    />

    <VProgressLinear
      v-model="modelValue"
      :buffer-value="bufferValue"
      color="primary"
      height="8"
    />
  </div>
</template>
` }

export const linearColor = { ts: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      model-value="15"
      bg-color="primary"
      color="primary"
    />

    <VProgressLinear
      model-value="30"
      bg-color="secondary"
      color="secondary"
    />

    <VProgressLinear
      model-value="45"
      bg-color="success"
      color="success"
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      model-value="15"
      bg-color="primary"
      color="primary"
    />

    <VProgressLinear
      model-value="30"
      bg-color="secondary"
      color="secondary"
    />

    <VProgressLinear
      model-value="45"
      bg-color="success"
      color="success"
    />
  </div>
</template>
` }

export const linearIndeterminate = { ts: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      indeterminate
      color="primary"
    />

    <VProgressLinear
      indeterminate
      color="primary"
    />

    <VProgressLinear
      indeterminate
      color="primary"
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      indeterminate
      color="primary"
    />

    <VProgressLinear
      indeterminate
      color="primary"
    />

    <VProgressLinear
      indeterminate
      color="primary"
    />
  </div>
</template>
` }

export const linearReversed = { ts: `<template>
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
`, js: `<template>
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
` }

export const linearRounded = { ts: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />
  </div>
</template>
`, js: `<template>
  <div class="demo-space-y">
    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />

    <VProgressLinear
      model-value="100"
      color="primary"
      rounded
    />
  </div>
</template>
` }

export const linearSlots = { ts: `<script setup lang="ts">
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
`, js: `<script setup>
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
` }

