<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import avatar2 from '@images/avatars/avatar-2.png'
import pumaShoes from '@images/pages/puma-shoes.jpeg'
</script>

<template>
  <VCard title="Basic Timeline">
    <VCardText>
      <VTimeline
        side="end"
        align="start"
        truncate-line="both"
        density="compact"
        class="v-timeline-density-compact"
      >
        <!-- SECTION Timeline Item: Flight -->
        <VTimelineItem
          dot-color="error"
          size="x-small"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold me-3">
              Get on the flight
            </h6>
            <span class="text-base">3rd October</span>
          </div>
          <VDivider />

          <!-- 👉 Content -->
          <p class="mt-4 mb-1">
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
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Interview Schedule -->
        <VTimelineItem
          size="x-small"
          dot-color="primary"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold mb-1 me-3">
              Interview Schedule
            </h6>
            <span class="text-base text-no-wrap">4th October</span>
          </div>

          <p class="mb-0">
            Bonbon gummies caramels brownie topping fruitcake gingerbread jelly-o marzipan.
          </p>

          <!-- 👉 Divider -->
          <VDivider class="my-4" />

          <!-- 👉 Person -->
          <div class="d-flex justify-space-between align-center">
            <!-- 👉 Avatar & Personal Info -->
            <span class="d-flex align-bottom mt-2">
              <VAvatar
                size="40"
                class="me-2"
                :image="avatar2"
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
                color="default"
                variant="text"
                size="x-small"
              >
                <VIcon
                  size="20"
                  icon="tabler-message"
                />
              </VBtn>
              <VBtn
                icon
                size="x-small"
                variant="text"
                color="default"
              >
                <VIcon
                  size="20"
                  icon="tabler-phone"
                />
              </VBtn>
            </div>
          </div>
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Timeline Item: Puma Shoes -->
        <VTimelineItem
          size="x-small"
          dot-color="info"
        >
          <div class="d-flex align-start flex-sm-row flex-column mb-3">
            <VImg
              height="62"
              width="62"
              :src="pumaShoes"
              class="rounded me-4"
            />

            <div>
              <!-- Header -->
              <div class="d-flex justify-space-between">
                <h6 class="font-weight-semibold text-base mb-1 me-3">
                  Sold Puma POPX Blue Color
                </h6>
                <small class="text-base text-no-wrap">January, 10</small>
              </div>
              <span>PUMA presents the latest shoes from its collection. Light &amp; comfortable made with highly durable material.</span>
            </div>
          </div>

          <!-- 👉 Timeline Item: Meta Content -->
          <div class="d-flex justify-space-between flex-column flex-sm-row gap-3">
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
        </VTimelineItem>
        <!-- !SECTION -->

        <!-- SECTION Design Review -->
        <VTimelineItem
          size="x-small"
          dot-color="success"
        >
          <!-- 👉 Header -->
          <div class="d-flex justify-space-between">
            <h6 class="text-base font-weight-semibold mb-1">
              Design Review
            </h6>
            <small class="text-base text-no-wrap">September, 20</small>
          </div>

          <!-- 👉 Content -->
          <p>
            Weekly review of freshly prepared design for our new application.
          </p>
          <div class="d-flex align-center">
            <VAvatar
              size="40"
              :image="avatar1"
              class="me-2"
            />
            <h6 class="text-base font-weight-semibold">
              John Doe (Client)
            </h6>
          </div>
        </VTimelineItem>
        <!-- !SECTION -->
      </VTimeline>
    </VCardText>
  </VCard>
</template>
