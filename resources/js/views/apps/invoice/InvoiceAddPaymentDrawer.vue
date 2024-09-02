<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'

const props = defineProps({
  isDrawerOpen: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDrawerOpen',
  'submit',
])

const invoiceBalance = ref('')
const paymentAmount = ref('')
const paymentDate = ref('')
const paymentMethod = ref()
const paymentNote = ref('')

const onSubmit = () => {
  emit('update:isDrawerOpen', false)
  emit('submit', {
    invoiceBalance: invoiceBalance.value,
    paymentAmount: paymentAmount.value,
    paymentDate: paymentDate.value,
    paymentMethod: paymentMethod.value,
    paymentNote: paymentNote.value,
  })
}

const handleDrawerModelValueUpdate = val => {
  emit('update:isDrawerOpen', val)
}
</script>

<template>
  <VNavigationDrawer
    temporary
    location="end"
    :width="400"
    :model-value="props.isDrawerOpen"
    class="scrollable-content"
    @update:model-value="handleDrawerModelValueUpdate"
  >
    <!-- 👉 Header -->
    <div class="d-flex align-center pa-6 pb-1">
      <h6 class="text-h6">
        Add Payment
      </h6>

      <VSpacer />

      <VBtn
        icon
        size="32"
        color="default"
        variant="tonal"
        class="rounded"
        @click="handleDrawerModelValueUpdate(false)"
      >
        <VIcon
          size="18"
          icon="tabler-x"
        />
      </VBtn>
    </div>

    <PerfectScrollbar :options="{ wheelPropagation: false }">
      <VCard flat>
        <VCardText>
          <VForm @submit.prevent="onSubmit">
            <VRow>
              <VCol cols="12">
                <VTextField
                  v-model="invoiceBalance"
                  label="Invoice Balance"
                />
              </VCol>

              <VCol cols="12">
                <VTextField
                  v-model="paymentAmount"
                  label="Payment Amount"
                />
              </VCol>

              <VCol cols="12">
                <AppDateTimePicker
                  v-model="paymentDate"
                  label="Payment Date"
                />
              </VCol>

              <VCol cols="12">
                <VSelect
                  v-model="paymentMethod"
                  label="Select Payment Method"
                  :items="['Cash', 'Bank Transfer', 'Debit', 'Credit', 'Paypal']"
                />
              </VCol>

              <VCol cols="12">
                <VTextarea
                  v-model="paymentNote"
                  label="Internal Payment Note"
                />
              </VCol>

              <VCol cols="12">
                <VBtn
                  type="submit"
                  class="me-3"
                >
                  Send
                </VBtn>

                <VBtn
                  type="reset"
                  color="secondary"
                  variant="tonal"
                  @click="$emit('update:isDrawerOpen', false)"
                >
                  Cancel
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </PerfectScrollbar>
  </VNavigationDrawer>
</template>
