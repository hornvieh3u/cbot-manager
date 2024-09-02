<script setup>
import robotImg from '@/assets/images/robot/cbot.png'
import AppDateTimePicker from '@core/components/AppDateTimePicker.vue'
import RobotUsageDetail from './RobotUsageDetail.vue'

const props = defineProps({
    robotItems: {
        type: Array,
        required: false
    },
    usages: {
        type: Object,
        required: false
    }
});

const emit = defineEmits([
    'getHomeTotalInfo'
])

const selectedDate = ref(new Date());
const selectedRobotItem = ref({
    text: 'All robot',
    value: 0
});

watch([selectedDate, selectedRobotItem], () => {
    emit('getHomeTotalInfo', selectedDate.value, selectedRobotItem.value)
})

</script>

<template>
  <VCard
    title="Robot Usage Detail"
  >
    <VCardText>
      <VRow>
          <VCol
              cols="12"
              md="4"
              sm="6"
          >
              <VSelect
                  v-model="selectedRobotItem"
                  label="robot"
                  item-title="text"
                  item-value="value"
                  :items="props.robotItems"
                  return-object
              />
          </VCol>
          <VCol
              cols="12"
              md="4"
              sm="6"
          >
              <AppDateTimePicker
                v-model="selectedDate"
                label="date"
                prepend-inner-icon="tabler-calendar"
                density="compact"
                :config="{ position: 'auto right', dateFormat: 'Y/m/d' }"
              />
          </VCol>
      </VRow>
      <RobotUsageDetail :usages="props.usages" />
    </VCardText>
  </VCard>
</template>