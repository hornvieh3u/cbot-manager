<script setup>
import { useRoute } from 'vue-router'
import axios from '@axios'

const router = useRoute()
const projectData = ref([])

const fetchProjectData = () => {
  if (router.params.tab === 'projects') {
    axios.get('/pages/profile', { params: { tab: router.params.tab } }).then(response => {
      projectData.value = response.data
    })
  }
}

watch(router, fetchProjectData, { immediate: true })
</script>

<template>
  <VRow v-if="projectData">
    <VCol
      v-for="data in projectData"
      :key="data.title"
      cols="12"
      sm="6"
      lg="4"
    >
      <VCard>
        <VCardItem>
          <template #prepend>
            <VAvatar :image="data.avatar" />
          </template>

          <VCardTitle>Social Banners</VCardTitle>
          <p class="mb-0">
            <span class="font-weight-medium me-1">Client:</span>
            <span>Christian Jimenez</span>
          </p>

          <template #append>
            <div class="mt-n8 me-n3">
              <VBtn
                icon
                variant="text"
                color="default"
                size="x-small"
              >
                <VIcon
                  size="20"
                  icon="tabler-dots-vertical"
                  class="text-disabled"
                />

                <VMenu activator="parent">
                  <VList density="compact">
                    <VListItem
                      v-for="(item, index) in ['Rename Project', 'View Details', 'Add to favorites']"
                      :key="index"
                      :value="index"
                    >
                      <VListItemTitle>{{ item }}</VListItemTitle>
                    </VListItem>
                    <VDivider class="my-2" />
                    <VListItem
                      title="Leave Project"
                      value="Leave Project"
                      class="text-error"
                    />
                  </VList>
                </VMenu>
              </VBtn>
            </div>
          </template>
        </VCardItem>

        <VCardText>
          <div class="d-flex align-center justify-space-between flex-wrap gap-x-2 gap-y-4">
            <div class="pa-2 bg-light-secondary rounded">
              <h6 class="text-base font-weight-medium">
                {{ data.budgetSpent }} <span class="text-body-1">/ {{ data.budget }}</span>
              </h6>
              <span>Total Budget</span>
            </div>

            <div>
              <h6 class="text-base font-weight-medium">
                Start Date: <span class="text-body-1">{{ data.startDate }}</span>
              </h6>
              <h6 class="text-base font-weight-medium mb-1">
                Deadline: <span class="text-body-1">{{ data.deadline }}</span>
              </h6>
            </div>
          </div>

          <p class="mt-4 mb-0">
            {{ data.description }}
          </p>
        </VCardText>

        <VDivider />

        <VCardText>
          <div class="d-flex align-center justify-space-between flex-wrap gap-2">
            <h6 class="text-base font-weight-semibold">
              All Hours: <span class="text-body-1">{{ data.hours }}</span>
            </h6>

            <VChip
              label
              :color="data.chipColor"
              size="small"
            >
              {{ data.daysLeft }} Days left
            </VChip>
          </div>

          <div class="d-flex align-center justify-space-between flex-wrap text-sm mt-4 mb-2">
            <span>Task: {{ data.tasks }}</span>
            <span>95% Completed</span>
          </div>
          <VProgressLinear
            rounded
            rounded-bar
            height="8"
            :model-value="data.completedTask"
            :max="data.totalTask"
            color="primary"
          />

          <div class="d-flex align-center justify-space-between flex-wrap gap-2 mt-3">
            <div class="d-flex align-center">
              <div class="v-avatar-group me-2">
                <VAvatar
                  v-for="avatar in data.avatarGroup"
                  :key="avatar.name"
                  :image="avatar.avatar"
                  :size="32"
                />
              </div>
              <span class="text-xs">
                280 members
              </span>
            </div>

            <span>
              <VIcon
                icon="tabler-message-dots"
                class="me-1"
              />
              <span>{{ data.comments }}</span>
            </span>
          </div>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>
