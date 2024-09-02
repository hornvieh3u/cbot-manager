<script setup>
import { useRoute } from 'vue-router'
import axios from '@axios'

const router = useRoute()
const connectionData = ref([])

const fetchProjectData = () => {
  if (router.params.tab === 'connections') {
    axios.get('/pages/profile', { params: { tab: router.params.tab } }).then(response => {
      connectionData.value = response.data
    })
  }
}

watch(router, fetchProjectData, { immediate: true })
</script>

<template>
  <VRow>
    <VCol
      v-for="data in connectionData"
      :key="data.name"
      sm="6"
      lg="4"
      cols="12"
    >
      <VCard>
        <div class="vertical-more">
          <VBtn
            icon
            variant="text"
            color="default"
            size="x-small"
          >
            <VIcon
              size="20  "
              icon="tabler-dots-vertical"
              class="text-disabled"
            />

            <VMenu activator="parent">
              <VList density="compact">
                <VListItem
                  v-for="(item, index) in ['Share connection', 'Block connection']"
                  :key="index"
                  :value="index"
                >
                  <VListItemTitle>{{ item }}</VListItemTitle>
                </VListItem>

                <VDivider class="my-2" />

                <VListItem
                  title="Delete"
                  value="Delete"
                  class="text-error"
                />
              </VList>
            </VMenu>
          </VBtn>
        </div>

        <VCardItem>
          <VCardTitle class="d-flex flex-column align-center justify-center">
            <VAvatar
              size="100"
              :image="data.avatar"
            />

            <p class="mt-4 mb-0">
              {{ data.name }}
            </p>
            <span class="text-body-1">{{ data.designation }}</span>

            <div class="d-flex align-center flex-wrap gap-2 mt-2">
              <VChip
                v-for="chip in data.chips"
                :key="chip.title"
                label
                :color="chip.color"
                size="small"
              >
                {{ chip.title }}
              </VChip>
            </div>
          </VCardTitle>
        </VCardItem>

        <VCardText>
          <div class="d-flex justify-space-around">
            <div class="text-center">
              <h6 class="text-h6 font-weight-semibold">
                {{ data.projects }}
              </h6>
              <span class="text-body-1">Projects</span>
            </div>
            <div class="text-center">
              <h6 class="text-h6">
                {{ data.tasks }}
              </h6>
              <span class="text-body-1">Tasks</span>
            </div>
            <div class="text-center">
              <h6 class="text-h6">
                {{ data.connections }}
              </h6>
              <span class="text-body-1">Connections</span>
            </div>
          </div>

          <div class="d-flex justify-center gap-4 mt-5">
            <VBtn
              :prepend-icon="data.isConnected ? 'tabler-user-check' : 'tabler-user-plus'"
              :variant="data.isConnected ? 'elevated' : 'tonal'"
            >
              Connected
            </VBtn>

            <VBtn
              icon
              variant="tonal"
              color="default"
              size="small"
              class="rounded"
            >
              <VIcon
                size="22"
                icon="tabler-mail"
              />
            </VBtn>
          </div>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>

<style lang="scss">
.vertical-more {
  position: absolute;
  inset-block-start: 1rem;
  inset-inline-end: 0.5rem;
}
</style>
