<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import avatar2 from '@images/avatars/avatar-2.png'
</script>

<template>
  <VCard title="Activity Timeline">
    <template #append>
      <div class="me-n2">
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
      <VTimeline
        side="end"
        align="start"
        truncate-line="both"
        density="compact"
        class="v-timeline-density-compact"
      >
        <VTimelineItem
          dot-color="primary"
          size="x-small"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold me-3">
              Client Meeting
            </h6>
            <span class="text-sm text-disabled">Today</span>
          </div>

          <!-- 👉 Content -->
          <p class="mb-1">
            Project meeting with john @10:15am
          </p>
          <div class="d-flex align-center">
            <VAvatar
              :image="avatar1"
              class="me-3"
            />
            <div>
              <p class="font-weight-semibold mb-0">
                Lester McCarthy (Client)
              </p>
              <span>CEO of Infibeam</span>
            </div>
          </div>
        </VTimelineItem>

        <VTimelineItem
          dot-color="success"
          size="x-small"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold me-3">
              Create a new project for client
            </h6>
            <span class="text-sm text-disabled">2 Day Ago</span>
          </div>

          <!-- 👉 Content -->
          <p class="mb-1">
            Add files to new design folder
          </p>
        </VTimelineItem>

        <VTimelineItem
          dot-color="error"
          size="x-small"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold me-3">
              Shared 2 New Project Files
            </h6>
            <span class="text-sm text-disabled">6 Day Ago</span>
          </div>

          <!-- 👉 Content -->
          <p class="mb-1">
            <span class="me-2">Sent by Mollie Dixon</span>
            <VAvatar
              :image="avatar2"
              size="20"
            />
          </p>
          <div class="d-flex align-center">
            <a
              href="#"
              class="d-flex align-center me-4"
            >
              <VIcon
                start
                size="18"
                color="warning"
                icon="tabler-file-description"
              />
              <h6 class="font-weight-semibold text-base">App Guidelines</h6>
            </a>
            <a
              href="#"
              class="d-flex align-center"
            >
              <VIcon
                start
                size="18"
                color="success"
                icon="tabler-table"
              />
              <h6 class="font-weight-semibold text-base">Testing Results</h6>
            </a>
          </div>
        </VTimelineItem>

        <VTimelineItem
          dot-color="info"
          size="x-small"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold me-3">
              Project status updated
            </h6>
            <span class="text-sm text-disabled">10 Day Ago</span>
          </div>

          <!-- 👉 Content -->
          <p class="mb-1">
            Ecommerce iOS App Completed
          </p>
        </VTimelineItem>
      </VTimeline>
    </VCardText>
  </VCard>
</template>
