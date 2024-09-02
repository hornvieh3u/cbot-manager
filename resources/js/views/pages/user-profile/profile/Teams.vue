<script setup>
const props = defineProps({
  teamsData: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <VCard title="Teams">
    <template #append>
      <div class="me-n2">
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
                v-for="(item, index) in ['Share connections', 'Suggest edits', 'Report Bug']"
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
          v-for="data in props.teamsData"
          :key="data.title"
        >
          <template #prepend>
            <VAvatar
              size="38"
              :image="data.avatar"
            />
          </template>

          <VListItemTitle class="font-weight-medium">
            {{ data.title }}
          </VListItemTitle>
          <VListItemSubtitle>{{ data.members }} Members</VListItemSubtitle>

          <template #append>
            <VChip
              label
              :color="data.ChipColor"
              size="small"
              class="font-weight-medium"
            >
              {{ data.chipText }}
            </VChip>
          </template>
        </VListItem>

        <VListItem>
          <VListItemTitle>
            <VBtn
              block
              variant="text"
            >
              View all teams
            </VBtn>
          </VListItemTitle>
        </VListItem>
      </VList>
    </VCardText>
  </VCard>
</template>

<style lang="scss" scoped>
.card-list {
  --v-card-list-gap: 14px;
}
</style>
