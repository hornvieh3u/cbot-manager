<script setup>
import congoImg from '@images/illustrations/congo-illustration.png'
</script>

<template>
  <VCard>
    <VRow no-gutters>
      <VCol cols="7">
        <VCardText>
          <h6 class="text-h6">
            Congratulations John! 🎉
          </h6>
          <p class="mb-2">
            Best seller of the month
          </p>
          <h5 class="text-h5 font-weight-semibold text-primary mb-2">
            $48.9k
          </h5>
          <VBtn>View Sales</VBtn>
        </VCardText>
      </VCol>

      <VCol cols="5">
        <VCardText class="pb-0 px-0 position-relative h-100">
          <VImg
            :src="congoImg"
            height="140"
            class="w-100 position-absolute"
            style="bottom: 0;"
          />
        </VCardText>
      </VCol>
    </VRow>
  </VCard>
</template>
