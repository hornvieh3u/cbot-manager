<script setup>
const props = defineProps({
  connectionsData: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <VCard title="Connection">
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
          v-for="data in props.connectionsData"
          :key="data.name"
        >
          <template #prepend>
            <VAvatar
              size="38"
              :image="data.avatar"
            />
          </template>

          <VListItemTitle class="font-weight-medium">
            {{ data.name }}
          </VListItemTitle>
          <VListItemSubtitle>{{ data.connections }} Connections</VListItemSubtitle>

          <template #append>
            <VBtn
              icon
              size="30"
              class="rounded"
              :variant="data.isFriend ? 'elevated' : 'tonal' "
            >
              <VIcon
                size="20"
                :icon="data.isFriend ? 'tabler-user-x' : 'tabler-user-check'"
              />
            </VBtn>
          </template>
        </VListItem>

        <VListItem>
          <VListItemTitle>
            <VBtn
              block
              variant="text"
            >
              View all connections
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
