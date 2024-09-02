<script setup>
import { useRoute } from 'vue-router'
import axios from '@axios'

const router = useRoute()
const teamData = ref([])

const fetchTeamData = () => {
  if (router.params.tab === 'teams') {
    axios.get('/pages/profile', { params: { tab: router.params.tab } }).then(response => {
      teamData.value = response.data
    })
  }
}

watch(router, fetchTeamData, { immediate: true })
</script>

<template>
  <VRow v-if="teamData">
    <VCol
      v-for="team in teamData"
      :key="team.title"
      cols="12"
      md="6"
      lg="4"
    >
      <VCard :title="team.title">
        <template #prepend>
          <VAvatar
            size="38"
            :image="team?.avatar"
          />
        </template>

        <template #append>
          <div class="me-n3">
            <VBtn
              icon
              variant="text"
              color="default"
              size="x-small"
            >
              <VIcon
                size="20"
                icon="tabler-star"
                class="text-disabled"
              />
            </VBtn>

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
                    v-for="(item, index) in ['Rename Team', 'View Details', 'Add to favorites']"
                    :key="index"
                    :value="index"
                  >
                    <VListItemTitle>{{ item }}</VListItemTitle>
                  </VListItem>
                  <VDivider class="my-2" />
                  <VListItem
                    title="Delete Team"
                    value="Delete Team"
                    class="text-error"
                  />
                </VList>
              </VMenu>
            </VBtn>
          </div>
        </template>

        <VCardText>
          <span class="text-base">{{ team.description }}</span>
        </VCardText>

        <VCardText class="d-flex align-center">
          <div class="v-avatar-group">
            <VAvatar
              v-for="data in team.avatarGroup"
              :key="data.name"
              size="32"
            >
              <VImg :src="data.avatar" />

              <VTooltip
                activator="parent"
                location="top"
              >
                {{ data.name }}
              </VTooltip>
            </VAvatar>
          </div>

          <VSpacer />

          <div class="d-flex align-center gap-2">
            <VChip
              v-for="data in team.chips"
              :key="data.title"
              label
              :color="data.color"
              size="small"
              class="font-weight-medium"
            >
              {{ data.title }}
            </VChip>
          </div>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>
