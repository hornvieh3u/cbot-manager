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

const emailFrom = ref('shelbyComapny@email.com')
const emailTo = ref('qConsolidated@email.com')
const invoiceSubject = ref('Invoice of purchased Admin Templates')

const paymentMessage = ref(`Dear Queen Consolidated,

Thank you for your business, always a pleasure to work with you!

We have generated a new invoice in the amount of $95.59

We would appreciate payment of this invoice by 05/11/2019`)

const onSubmit = () => {
  emit('update:isDrawerOpen', false)
  emit('submit', {
    emailFrom: emailFrom.value,
    emailTo: emailTo.value,
    invoiceSubject: invoiceSubject.value,
    paymentMessage: paymentMessage.value,
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
        Send Invoice
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
                  v-model="emailFrom"
                  label="Form"
                />
              </VCol>

              <VCol cols="12">
                <VTextField
                  v-model="emailTo"
                  label="To"
                />
              </VCol>

              <VCol cols="12">
                <VTextField
                  v-model="invoiceSubject"
                  label="Subject"
                />
              </VCol>

              <VCol cols="12">
                <VTextarea
                  v-model="paymentMessage"
                  rows="10"
                  label="Message"
                />
              </VCol>

              <VCol cols="12">
                <div class="mb-6">
                  <VChip
                    label
                    color="primary"
                    size="small"
                  >
                    <VIcon
                      start
                      icon="tabler-link"
                    />
                    Invoice Attached
                  </VChip>
                </div>
                <VBtn
                  type="submit"
                  class="me-3"
                >
                  Send
                </VBtn>

                <VBtn
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
