<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import avatar2 from '@images/avatars/avatar-2.png'
import pumaShoes from '@images/pages/puma-shoes.jpeg'

const serverSwitch = ref(false)
</script>

<template>
  <VCard
    variant="text"
    title="Timeline With Icons"
  >
    <VCardText>
      <VTimeline
        align="start"
        justify="center"
        truncate-line="both"
        :density="$vuetify.display.smAndDown ? 'compact' : 'default'"
      >
        <!-- SECTION Timeline Item: Flight -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-plane-tilt"
                  color="primary"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <!-- 👉 Header -->
              <div class="d-flex justify-space-between">
                <h6 class="text-base font-weight-semibold mb-1 me-3">
                  Get on the flight
                </h6>
                <small class="text-sm">Wednesday</small>
              </div>

              <!-- 👉 Content -->
              <p class="mb-1">
                <span>Charles de Gaulle Airport, Paris</span>
                <VIcon
                  size="20"
                  icon="tabler-arrow-right"
                  class="mx-2"
                />
                <span>Heathrow Airport, London</span>
              </p>

              <p class="mb-2">
                6:30 AM
              </p>

              <div class="d-flex align-center">
                <VIcon
                  color="primary"
                  icon="tabler-link"
                  size="20"
                  class="me-1"
                />
                <h6 class="text-primary font-weight-semibold text-sm">
                  booking-card.pdf
                </h6>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Interview -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-clock"
                  color="success"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <!-- 👉 Header -->
              <div class="d-flex justify-space-between">
                <h6 class="text-base font-weight-semibold mb-1">
                  Interview Schedule
                </h6>
                <small class="text-sm text-no-wrap">April, 18</small>
              </div>

              <p class="mb-0">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus quos, voluptates voluptas rem veniam expedita.
              </p>

              <!-- 👉 Divider -->
              <VDivider class="my-4" />

              <!-- 👉 Person -->
              <div class="d-flex justify-space-between align-center flex-wrap gap-4">
                <!-- 👉 Avatar & Personal Info -->
                <span class="d-flex align-bottom">
                  <VAvatar
                    size="40"
                    :image="avatar2"
                    class="me-3"
                  />
                  <div class="d-flex flex-column">
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
                      icon="tabler-message"
                      size="20"
                    />
                  </VBtn>
                  <VBtn
                    icon
                    size="x-small"
                    variant="text"
                    color="default"
                  >
                    <VIcon
                      icon="tabler-phone"
                      size="20"
                    />
                  </VBtn>
                </div>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Puma Shoes -->
        <VTimelineItem
          fill-dot
          size="x-small"
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-shopping-cart"
                  color="warning"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <div class="d-flex align-start flex-sm-row flex-column mb-3">
                <VImg
                  height="62"
                  width="62"
                  :src="pumaShoes"
                  class="rounded me-4"
                />

                <div>
                  <!-- 👉 Header -->
                  <div class="d-flex justify-space-between">
                    <h6 class="mb-1 font-weight-semibold text-base me-3">
                      Sold Puma POPX Blue Color
                    </h6>
                    <small class="text-sm text-no-wrap">January, 10</small>
                  </div>
                  <span>PUMA presents the latest shoes from its collection. Light &amp; comfortable made with highly durable material.</span>
                </div>
              </div>

              <!-- 👉 Timeline Item: Meta Content -->
              <div class="d-flex justify-space-between flex-sm-row flex-column gap-3">
                <div class="text-sm-center">
                  <h6 class="text-base font-weight-semibold">
                    Customer
                  </h6>
                  <span>Micheal Scott</span>
                </div>

                <div class="text-sm-center">
                  <h6 class="text-base font-weight-semibold">
                    Price
                  </h6>
                  <span>$375.00</span>
                </div>

                <div class="text-sm-center">
                  <h6 class="text-base font-weight-semibold">
                    Quantity
                  </h6>
                  <span>1</span>
                </div>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Design Review -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-edit"
                  color="info"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <!-- 👉 Header -->
              <div class="d-flex justify-space-between">
                <h6 class="mb-1 text-base font-weight-semibold">
                  Design Review
                </h6>
                <small class="text-sm text-no-wrap">September, 20</small>
              </div>

              <!-- 👉 Content -->
              <p>
                Weekly review of freshly prepared design for our new application.
              </p>
              <div class="d-flex align-center">
                <VAvatar
                  size="40"
                  :image="avatar1"
                  class="me-3"
                />
                <h6 class="text-sm font-weight-semibold">
                  John Doe (Client)
                </h6>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Ubuntu Server -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-server"
                  color="error"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <!-- 👉 Header -->
              <div class="d-flex justify-space-between">
                <h6 class="mb-1 text-base font-weight-semibold">
                  Ubuntu Server
                </h6>

                <VChip
                  color="error"
                  size="small"
                >
                  Inactive
                </VChip>
              </div>

              <!-- 👉 Content -->
              <table class="w-100 mt-3">
                <tr>
                  <td class="d-flex align-center pb-2">
                    <VIcon
                      icon="tabler-world"
                      class="me-1"
                    />
                    <span>IP Address</span>
                  </td>

                  <td class="text-right">
                    192.654.8.566
                  </td>
                </tr>

                <tr>
                  <td class="d-flex align-center pb-2">
                    <VIcon
                      icon="tabler-cpu"
                      class="me-1"
                    />
                    <span>CPU</span>
                  </td>

                  <td class="text-right">
                    4 Cores
                  </td>
                </tr>

                <tr>
                  <td class="d-flex align-center pb-2">
                    <VIcon
                      icon="tabler-cpu-2"
                      class="me-1"
                    />
                    <span>Memory</span>
                  </td>

                  <td class="text-right">
                    2 GB
                  </td>
                </tr>
              </table>

              <VDivider class="mt-3" />

              <div class="d-flex justify-space-between align-end">
                <div>
                  <VBtn
                    size="x-small"
                    variant="text"
                    color="default"
                    icon
                  >
                    <VIcon
                      icon="tabler-share"
                      size="20"
                    />
                  </VBtn>
                  <VBtn
                    size="x-small"
                    variant="text"
                    color="default"
                    icon
                  >
                    <VIcon
                      icon="tabler-reload"
                      size="20"
                    />
                  </VBtn>
                </div>

                <VSwitch v-model="serverSwitch" />
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Location -->
        <VTimelineItem
          size="x-small"
          fill-dot
        >
          <template #icon>
            <div class="v-timeline-avatar-wrapper rounded-circle">
              <VAvatar size="x-small">
                <VIcon
                  size="20"
                  icon="tabler-map-pin"
                  color="success"
                />
              </VAvatar>
            </div>
          </template>

          <VCard>
            <VCardText>
              <!-- 👉 Header -->
              <div class="d-flex justify-space-between">
                <div class="d-flex align-end mb-3">
                  <VIcon
                    icon="tabler-map-pin"
                    class="me-1"
                  />
                  <h6 class="text-base font-weight-semibold">
                    <span>Location</span>
                  </h6>
                </div>

                <VChip
                  color="error"
                  size="small"
                >
                  High
                </VChip>
              </div>

              <!-- 👉 Content -->
              <h6 class="mb-0 text-sm font-weight-semibold">
                Find location for the company celebration.
              </h6>
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>

              <VDivider />

              <div class="d-flex justify-space-between mt-4 flex-wrap">
                <div>
                  <VBtn
                    size="x-small"
                    variant="text"
                    color="default"
                    icon
                  >
                    <VIcon
                      size="20"
                      icon="tabler-link"
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
                      icon="tabler-user"
                    />
                  </VBtn>
                </div>

                <span class="text-sm">Due date: 15th Jan</span>
              </div>
            </VCardText>
          </VCard>
        </VTimelineItem>
        <!-- !SECTION -->
      </VTimeline>
    </VCardText>
  </VCard>
</template>

<style lang="scss" scoped>
.v-timeline-avatar-wrapper {
  background-color: rgb(var(--v-theme-background));
}
</style>
