<!-- eslint-disable vue/no-mutating-props -->
<script setup>
const props = defineProps({
  id: {
    type: Number,
    required: true,
  },
  data: {
    type: Object,
    required: true,
    default: () => ({
      title: 'App Design',
      cost: 24,
      hours: 1,
      description: 'Designed UI kit & app pages.',
    }),
  },
})

const emit = defineEmits([
  'removeProduct',
  'totalAmount',
])

const itemsOptions = [
  {
    title: 'App Design',
    cost: 24,
    hours: 1,
    description: 'Designed UI kit & app pages.',
  },
  {
    title: 'App Customization',
    cost: 26,
    hours: 1,
    description: 'Customization & Bug Fixes.',
  },
  {
    title: 'ABC Template',
    cost: 28,
    hours: 1,
    description: 'Vuetify admin template.',
  },
  {
    title: 'App Development',
    cost: 32,
    hours: 1,
    description: 'Native App Development.',
  },
]

const selectedItem = ref({
  title: 'App Customization',
  cost: 26,
  hours: 1,
  description: 'Customization & Bug Fixes.',
})

watch(selectedItem, () => {
  props.data.cost = structuredClone(toRaw(selectedItem.value.cost))
  props.data.hours = structuredClone(toRaw(selectedItem.value.hours))
  props.data.description = structuredClone(toRaw(selectedItem.value.description))
  props.data.title = structuredClone(toRaw(selectedItem.value.title))
})

const removeProduct = () => {
  emit('removeProduct', props.id)
}

const totalPrice = computed(() => Number(props.data.cost) * Number(props.data.hours))

watch(totalPrice, () => {
  emit('totalAmount', totalPrice.value)
}, { immediate: true })
</script>

<template>
  <!-- eslint-disable vue/no-mutating-props -->
  <div class="add-products-header mb-2 d-none d-md-flex">
    <VRow class="font-weight-medium px-4">
      <VCol
        cols="12"
        md="6"
      >
        <span class="text-sm">
          Item
        </span>
      </VCol>
      <VCol
        cols="12"
        md="2"
      >
        <span class="text-sm">
          Cost
        </span>
      </VCol>
      <VCol
        cols="12"
        md="2"
      >
        <span class="text-sm">
          Hours
        </span>
      </VCol>
      <VCol
        cols="12"
        md="2"
      >
        <span class="text-sm">
          Price
        </span>
      </VCol>
    </VRow>
  </div>

  <VCard
    flat
    border
    class="d-flex flex-row"
  >
    <!-- 👉 Left Form -->
    <div class="pa-5 flex-grow-1">
      <VRow>
        <VCol
          cols="12"
          md="6"
        >
          <VSelect
            v-model="selectedItem"
            :items="itemsOptions"
            label="Select Item"
            return-object
            class="mb-3"
          />

          <VTextarea
            v-model="props.data.description"
            rows="2"
            label="Description"
            placeholder="Description"
          />
        </VCol>
        <VCol
          cols="12"
          md="2"
          sm="4"
        >
          <VTextField
            v-model="props.data.cost"
            type="number"
            label="Cost"
          />

          <div class="text-body-2 text-no-wrap mt-4">
            <p class="mb-1">
              Discount
            </p>
            <span>0%</span>
            <span class="mx-2">
              0%
              <VTooltip activator="parent">Tax 1</VTooltip>
            </span>
            <span>
              0%
              <VTooltip activator="parent">Tax 2</VTooltip>
            </span>
          </div>
        </VCol>
        <VCol
          cols="12"
          md="2"
          sm="4"
        >
          <VTextField
            v-model="props.data.hours"
            type="number"
            label="Hours"
          />
        </VCol>
        <VCol
          cols="12"
          md="2"
          sm="4"
        >
          <p class="text-sm-center my-2">
            <span class="d-inline d-md-none">Price: </span>
            <span class="text-body-1">${{ totalPrice }}</span>
          </p>
        </VCol>
      </VRow>
    </div>

    <!-- 👉 Item Actions -->
    <div class="d-flex flex-column justify-space-between border-s pa-1">
      <VBtn
        icon
        size="x-small"
        color="default"
        variant="text"
        @click="removeProduct"
      >
        <VIcon
          size="20"
          icon="tabler-x"
        />
      </VBtn>

      <VBtn
        icon
        size="x-small"
        color="default"
        variant="text"
      >
        <VIcon
          size="20"
          icon="tabler-settings"
        />
      </VBtn>
    </div>
  </VCard>
</template>
