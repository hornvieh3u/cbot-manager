<script setup>
const currentActiveTab = ref('New')

const orders = [
  {
    tabName: 'New',
    timeline1: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Myrtle Ullrich',
        address: '101 Boulder, California(CA), 95959',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Barry Schowalter',
        address: '939 Orange, California(CA),92118',
      },
    ],
    timeline2: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Veronica Herman',
        address: '162 Windsor, California(CA), 95492',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Helen Jacobs',
        address: '487 Sunset, California(CA), 94043',
      },
    ],
  },
  {
    tabName: 'Preparing',
    timeline1: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Barry Schowalter',
        address: '939 Orange, California(CA),92118',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Myrtle Ullrich',
        address: '101 Boulder, California(CA), 95959',
      },
    ],
    timeline2: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Veronica Herman',
        address: '162 Windsor, California(CA), 95492',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Helen Jacobs',
        address: '487 Sunset, California(CA), 94043',
      },
    ],
  },
  {
    tabName: 'Shipping',
    timeline1: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Veronica Herman',
        address: '101 Boulder, California(CA), 95959',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Barry Schowalter',
        address: '939 Orange, California(CA),92118',
      },
    ],
    timeline2: [
      {
        icon: 'tabler-circle-check',
        type: 'SENDER',
        name: 'Myrtle Ullrich',
        address: '162 Windsor, California(CA), 95492',
      },
      {
        icon: 'tabler-map-pin',
        type: 'RECEIVER',
        name: 'Helen Jacobs',
        address: '487 Sunset, California(CA), 94043',
      },
    ],
  },
]
</script>

<template>
  <VCard
    title="Orders"
    subtitle="62 Deliveries in Progress"
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

    <VTabs
      v-model="currentActiveTab"
      grow
    >
      <VTab
        v-for="order in orders"
        :key="order.tabName"
        :value="order.tabName"
      >
        {{ order.tabName }}
      </VTab>
    </VTabs>
    <VDivider />

    <VCardText>
      <VWindow
        v-model="currentActiveTab"
        class="disable-tab-transition"
      >
        <VWindowItem
          v-for="order in orders"
          :key="order.tabName"
          :value="order.tabName"
        >
          <VTimeline
            side="end"
            align="start"
            truncate-line="both"
            density="compact"
            class="v-timeline-density-compact"
          >
            <VTimelineItem
              v-for="item in order.timeline1"
              :key="item.icon"
              fill-dot
              size="x-small"
            >
              <template #icon>
                <div
                  class="v-timeline-avatar-wrapper rounded-circle"
                  style="background-color: rgb(var(--v-theme-surface)) ;"
                >
                  <VAvatar>
                    <VIcon
                      size="22"
                      :icon="item.icon"
                      :color="item.type === 'SENDER' ? 'success' : 'primary'"
                    />
                  </VAvatar>
                </div>
              </template>
              <p :class="`text-sm text-${item.type === 'SENDER' ? 'success' : 'primary'} mb-0`">
                {{ item.type }}
              </p>
              <p class="font-weight-semibold mb-0">
                {{ item.name }}
              </p>
              <p class="text-disabled mb-0">
                {{ item.address }}
              </p>
            </VTimelineItem>
          </VTimeline>

          <VDivider
            class="my-3"
            style="border-style: dashed;"
          />

          <VTimeline
            side="end"
            align="start"
            truncate-line="both"
            density="compact"
            class="v-timeline-density-compact"
          >
            <VTimelineItem
              v-for="item in order.timeline2"
              :key="item.icon"
              fill-dot
              size="x-small"
            >
              <template #icon>
                <div
                  class="v-timeline-avatar-wrapper rounded-circle"
                  style="background-color: rgb(var(--v-theme-surface)) ;"
                >
                  <VAvatar>
                    <VIcon
                      size="22"
                      :icon="item.icon"
                      :color="item.type === 'SENDER' ? 'success' : 'primary'"
                    />
                  </VAvatar>
                </div>
              </template>
              <p :class="`text-sm text-${item.type === 'SENDER' ? 'success' : 'primary'} mb-0`">
                {{ item.type }}
              </p>
              <p class="font-weight-semibold mb-0">
                {{ item.name }}
              </p>
              <p class="text-disabled mb-0">
                {{ item.address }}
              </p>
            </VTimelineItem>
          </VTimeline>
        </VWindowItem>
      </VWindow>
    </VCardText>
  </VCard>
</template>
