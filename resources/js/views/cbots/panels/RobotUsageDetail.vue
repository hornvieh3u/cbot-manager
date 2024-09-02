<script setup>
import robotImg from '@/assets/images/robot/cbot.png'

const props = defineProps({
    usages: {
        type: Object,
        required: false
    }
});

const usagesForm  = [
  {
    avatarColor: 'info',
    avatarIcon: 'tabler-clock',
    title: 'Total usage time',
    key: 'total_useage_time',
    value: '0'
  },
  {
    avatarColor: 'info',
    avatarIcon: 'tabler-clock',
    title: 'Average usage duration',
    key: 'average_useage_duration',
    value: '0'
  },
  {
    avatarColor: 'primary',
    avatarIcon: 'tabler-ticket',
    title: 'Rooms disinfected count',
    key: 'rooms_disinfected_count',
    value: '0'
  },
  {
    avatarColor: 'primary',
    avatarIcon: 'tabler-ticket',
    title: 'Corridors disinfected count',
    key: 'corridor_disinfected_count',
    value: '0'
  },
  {
    avatarColor: 'success',
    avatarIcon: 'tabler-circle-check',
    title: 'Completed tasks ( % )',
    key: 'completed_tasks',
    value: '0'
  },
]

const usages = computed(() => {
  const updatedUsages = usagesForm.map(form => {
    form.value = props.usages[form.key]

    return form;
  });

  return updatedUsages
})

</script>

<template>
  <VRow
    class="mt-5"
  >
    <VCol
      cols="12"
      md="6"
      sm="6"
    >
      <VImg
        alt="cbot"
        :src="robotImg"
      />
    </VCol>
    <VCol
      cols="12"
      md="6"
      sm="6"
    >
      <VList class="card-list">
        <VListItem
          v-for="usage in usages"
          :key="usage.title"
        >
          <VListItemTitle class="font-weight-medium">
            {{ usage.title }}
          </VListItemTitle>
          <VListItemSubtitle class="opacity-100">
            {{ usage.value }}
          </VListItemSubtitle>
          <template #prepend>
            <VAvatar
              rounded
              size="34"
              :color="usage.avatarColor"
              variant="tonal"
            >
              <VIcon :icon="usage.avatarIcon" />
            </VAvatar>
          </template>
        </VListItem>
      </VList>
    </VCol>
  </VRow>
</template>

<style lang="scss" scoped>
.card-list {
  --v-card-list-gap: 18px;
}
</style>
