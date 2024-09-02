<script setup>
import brave from '@images/logos/brave.png'
import chrome from '@images/logos/chrome.png'
import firefox from '@images/logos/firefox.png'
import internetExplorer from '@images/logos/internet-explorer.png'
import operaMini from '@images/logos/opera-mini.png'
import safari from '@images/logos/safari.png'

const browserStates = [
  {
    avatarImg: chrome,
    title: 'Google Chrome',
    stats: '90.4',
    progress: 'secondary',
  },
  {
    avatarImg: safari,
    title: 'Apple Safari',
    stats: '70.6',
    progress: 'success',
  },
  {
    avatarImg: firefox,
    title: 'Mozilla Firefox',
    stats: '35.5',
    progress: 'primary',
  },
  {
    avatarImg: operaMini,
    title: 'Opera Mini',
    stats: '80.0',
    progress: 'error',
  },
  {
    avatarImg: internetExplorer,
    title: 'Internet Explorer',
    stats: '62.2',
    progress: 'info',
  },
  {
    avatarImg: brave,
    title: 'Brave',
    stats: '46.3',
    progress: 'warning',
  },
]
</script>

<template>
  <VCard
    title="Browser States"
    subtitle="Counter April 2022"
  >
    <template #append>
      <div class="mt-n4 me-n2">
        <VBtn
          icon
          color="default"
          size="x-small"
          variant="plain"
        >
          <VIcon
            size="22"
            icon="tabler-dots-vertical"
          />

          <VMenu activator="parent">
            <VList>
              <VListItem
                v-for="(item, index) in ['Refresh', 'Download', 'View All']"
                :key="index"
                :value="index"
              >
                <VListItemTitle>{{ item }}</VListItemTitle>
              </VListItem>
            </VList>
          </VMenu>
        </VBtn>
      </div>
    </template>

    <VCardText>
      <VList class="card-list">
        <VListItem
          v-for="state in browserStates"
          :key="state.title"
        >
          <template #prepend>
            <VAvatar
              size="28"
              :image="state.avatarImg"
            />
          </template>

          <VListItemTitle class="font-weight-semibold">
            {{ state.title }}
          </VListItemTitle>

          <template #append>
            <span class="font-weight-semibold me-3">{{ state.stats }}%</span>
            <VProgressCircular
              :model-value="state.stats"
              :color="state.progress"
              width="3"
            />
          </template>
        </VListItem>
      </VList>
    </VCardText>
  </VCard>
</template>

<style lang="scss" scoped>
.card-list {
  --v-card-list-gap: 30px;
}
</style>
