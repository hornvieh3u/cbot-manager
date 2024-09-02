<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import avatar2 from '@images/avatars/avatar-2.png'
import pumaShoes from '@images/pages/puma-shoes.jpeg'
</script>

<template>
  <VCard title="Timeline Card">
    <VCardText>
      <VTimeline
        side="end"
        align="start"
        truncate-line="both"
        density="compact"
        class="v-timeline-density-compact"
      >
        <!-- SECTION Flight -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-send"
                  color="primary"
                />
              </VAvatar>
            </div>
          </template>

          <VCard
            class="bg-light-error"
            variant="text"
          >
            <VCardText>
              <h6 class="d-flex justify-space-between font-weight-semibold text-base mb-3">
                <span>Get on the flight</span>
                <small class="text-sm">Wednesday</small>
              </h6>

              <p class="mb-1">
                <span>Charles de Gaulle Airport, Paris</span>
                <VIcon
                  size="20"
                  icon="tabler-arrow-right"
                  class="mx-2"
                />
                <span>Heathrow Airport, London</span>
              </p>
              <p class="mb-1">
                6:30 AM
              </p>

              <a
                href="#"
                class="d-flex align-center"
              >
                <VIcon
                  color="primary"
                  icon="tabler-link"
                  size="18"
                  class="me-1"
                />
                <h6 class="text-primary font-weight-semibold text-sm">
                  booking-card.pdf
                </h6>
              </a>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Interview Schedule -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-brush"
                  color="success"
                />
              </VAvatar>
            </div>
          </template>

          <VCard
            class="bg-light-primary"
            variant="text"
          >
            <VCardText>
              <h6 class="d-flex justify-space-between font-weight-semibold text-base mb-3">
                <span>Interview Schedule</span>
                <small class="text-sm">April, 18</small>
              </h6>

              <p class="mb-0">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus quos, voluptates voluptas rem veniam expedita.
              </p>

              <!-- 👉 Divider -->
              <VDivider class="my-4" />

              <!-- 👉 Person -->
              <div class="d-flex justify-space-between align-center">
                <!-- 👉 Avatar & Personal Info -->
                <span class="d-flex align-start">
                  <VAvatar
                    size="40"
                    :image="avatar2"
                    class="me-2"
                  />

                  <div>
                    <h6 class="text-sm font-weight-semibold">Rebecca Godman</h6>
                    <span>Javascript Developer</span>
                  </div>
                </span>

                <!-- 👉 Person Actions -->
                <div>
                  <VBtn
                    icon
                    size="x-small"
                    variant="text"
                    color="default"
                  >
                    <VIcon
                      size="20"
                      icon="tabler-message"
                    />
                  </VBtn>
                  <VBtn
                    size="x-small"
                    variant="text"
                    color="default"
                    icon
                  >
                    <VIcon
                      size="20"
                      icon="tabler-phone"
                    />
                  </VBtn>
                </div>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Puma Shoes -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-basket"
                  color="error"
                />
              </VAvatar>
            </div>
          </template>

          <VCard
            class="bg-light-info"
            variant="text"
          >
            <!-- 👉 content -->
            <VCardText>
              <h6 class="d-flex justify-space-between font-weight-semibold text-base mb-3">
                <span>Sold Puma POPX Blue Color</span>
                <small class="text-sm">January, 10</small>
              </h6>

              <div class="d-flex align-sm-center flex-sm-row flex-column mb-3">
                <VImg
                  height="62"
                  width="62"
                  :src="pumaShoes"
                  class="rounded me-4"
                />
                <div>
                  <span>
                    PUMA presents the latest shoes from its collection. Light &amp; comfortable made with highly durable material.
                  </span>
                </div>
              </div>

              <div class="d-flex justify-space-between flex-column flex-sm-row gap-3">
                <div class="text-sm-center">
                  <p class="mb-0 text-base font-weight-semibold">
                    Customer
                  </p>
                  <span>Micheal Scott</span>
                </div>
                <div class="text-sm-center">
                  <p class="mb-0 text-base font-weight-semibold">
                    Price
                  </p>
                  <span>$375.00</span>
                </div>
                <div class="text-sm-center">
                  <p class="mb-0 text-base font-weight-semibold">
                    Quantity
                  </p>
                  <span>1</span>
                </div>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- 👉 Design Review -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-user-circle"
                  color="info"
                />
              </VAvatar>
            </div>
          </template>

          <VCard
            class="bg-light-success"
            variant="text"
          >
            <VCardText>
              <h6 class="d-flex justify-space-between font-weight-semibold text-base mb-3">
                <span>Design Review</span>
                <small class="text-sm">September, 20</small>
              </h6>

              <p>
                Weekly review of freshly prepared design for our new application.
              </p>
              <div class="d-flex align-center">
                <VAvatar
                  size="40"
                  class="me-2"
                >
                  <VImg :src="avatar1" />
                </VAvatar>
                <h6 class="text-sm font-weight-semibold">
                  John Doe (Client)
                </h6>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
      </VTimeline>
    </VCardText>
  </VCard>
</template>

<style lang="scss" scoped>
.v-timeline-avatar-wrapper {
  background-color: rgb(var(--v-theme-surface));
}
</style>
