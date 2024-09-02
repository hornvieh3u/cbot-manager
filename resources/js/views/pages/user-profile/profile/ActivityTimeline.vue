<script setup>
import avatar2 from '@images/avatars/avatar-2.png'
</script>

<template>
  <VCard>
    <VCardItem>
      <template #prepend>
        <VIcon icon="tabler-timeline" />
      </template>

      <VCardTitle>Activity Timeline</VCardTitle>

      <template #append>
        <div>
          <VBtn
            icon
            color="default"
            variant="text"
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
                  v-for="(item, index) in ['Share timeline', 'Suggest edits0', 'Report bug']"
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
    </VCardItem>

    <VCardText>
      <VTimeline
        density="compact"
        align="start"
        truncate-line="both"
        class="v-timeline-density-compact"
      >
        <VTimelineItem
          dot-color="warning"
          size="x-small"
        >
          <div class="d-flex justify-space-between align-center flex-wrap">
            <h4 class="text-base font-weight-semibold me-1 mb-1">
              Client Meeting
            </h4>
            <span class="text-sm text-disabled text-no-wrap">Today</span>
          </div>
          <p class="mb-2">
            Project meeting with john @10:15am
          </p>

          <div class="d-flex align-center mt-3">
            <VAvatar
              size="38"
              class="me-3"
              :image="avatar2"
            />
            <div>
              <h6 class="text-base font-weight-semibold ">
                Lester McCarthy (Client)
              </h6>
              <span>
                CEO of Infidel
              </span>
            </div>
          </div>
        </VTimelineItem>

        <VTimelineItem
          dot-color="primary"
          size="x-small"
        >
          <div class="d-flex justify-space-between align-center flex-wrap">
            <h4 class="text-base font-weight-semibold me-1 mb-1">
              Create a new project for client 😎
            </h4>
            <span class="text-sm text-disabled text-no-wrap">2 Day Ago</span>
          </div>

          <p class="mb-1">
            Add files to new design folder
          </p>
        </VTimelineItem>

        <VTimelineItem
          dot-color="info"
          size="x-small"
        >
          <div class="d-flex justify-space-between align-center flex-wrap">
            <h4 class="text-base font-weight-semibold me-1 mb-1">
              Shared 2 New Project Files
            </h4>
            <span class="text-sm text-disabled text-no-wrap">6 Day Ago</span>
          </div>
          <p class="mb-0">
            Sent by Mollie Dixon
          </p>
          <div class="d-flex align-center mt-3">
            <VIcon
              color="warning"
              icon="tabler-file-text"
              size="20"
              class="me-2"
            />
            <h6 class="font-weight-semibold text-sm me-3">
              App Guidelines
            </h6>

            <VIcon
              color="success"
              icon="tabler-table"
              size="20"
              class="me-2"
            />
            <h6 class="font-weight-semibold text-sm">
              Testing Results
            </h6>
          </div>
        </VTimelineItem>

        <VTimelineItem
          dot-color="secondary"
          size="x-small"
        >
          <div class="d-flex justify-space-between align-center flex-wrap">
            <h4 class="text-base font-weight-semibold me-1 mb-1">
              Project status updated
            </h4>
            <span class="text-sm text-disabled text-no-wrap">10 Day Ago</span>
          </div>
          <p class="mb-1">
            WooCommerce iOS App Completed
          </p>
        </VTimelineItem>
      </VTimeline>
    </VCardText>
  </VCard>
</template>
