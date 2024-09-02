<script setup>
import RobotUsageDetailWithFilter from '@/views/cbots/panels/RobotUsageDetailWithFilter.vue'
import LastPerformedTasks         from '@/views/cbots/panels/LastPerformedTasks.vue'
import Chart  from '@/views/cbots/Chart.vue'

import axios from '@axios'
import moment from 'moment'
import { useRoute } from 'vue-router'

const route = useRoute()

const robotItems  = ref([])
const usages      = ref([])
const tasks       = ref([])

const chartDataByDay  = ref([])
const chartDataByUnit = ref([])

onMounted(() => {
  axios.post('api/user/robots_list')
      .then(r => {
          const response = r.data;
          if( response.status ) {
            robotItems.value = response.data
            getHomeTotalInfo(new Date(), response.data[0])
          }
      })
      .catch(err => {
          console.log(err)
      })
})

const getHomeTotalInfo = (selectedDate, selectedItem) => {

  const params = buildHomeTotalInfoParams(selectedDate, selectedItem);
  axios.post('/api/user/dashboard', params)
    .then(r => {
      const response = r.data;
      if( response.status ) {
        tasks.value           = response.data.performed_task_info
        usages.value          = response.data.total_info
        chartDataByDay.value  = response.data.performed_task_day_info
        chartDataByUnit.value = response.data.performed_task_unit_info
      }
    })
    .catch(err => {
      console.log(err)
    })
}

const buildHomeTotalInfoParams = (selectedDate, selectedItem) => {

  let date = new Date( selectedDate );

  const firstday  = new Date(date.setDate(date.getDate() - date.getDay()))
  const lastday   = new Date(date.setDate(date.getDate() - date.getDay() + 6))

  const startDate = moment(firstday).subtract(1, 'days').format('YYYY/MM/DD')
  const endDate   = moment(lastday).subtract(1, 'days').format('YYYY/MM/DD')

  let params = {
    start_date:   startDate,
    end_date:     endDate,
    robot_serial: selectedItem.value
  }

  if( route.query ) {
    params = {
      ...params,
      ...route.query
    }
  }

  return params
}

</script>

<template>
  <VRow class="match-height">
    <!-- 👉 Robot Detail -->
    <VCol
      cols="12"
      md="6"
    >
      <RobotUsageDetailWithFilter
        :robot-items="robotItems"
        :usages="usages"
        @get-home-total-info="getHomeTotalInfo"
      />
    </VCol>

    <!-- 👉 Last Performed Tasks Table -->
    <VCol
      cols="12"
      md="6"
    >
      <LastPerformedTasks
        :tasks="tasks"
        :pagination="true"
      />
    </VCol>
    <VCol
      cols="12"
      md="6"
    >
      <Chart
        :data="chartDataByDay"
        type="day"
        title="Performed Tasks By Day"
      />
    </VCol>
    <VCol
      cols="12"
      md="6"
    >
      <Chart
        :data="chartDataByUnit"
        type="unit"
        title="Performed Tasks By Unit"
      />
    </VCol>
  </VRow>
</template>

<style lang="scss">
@use "@core-scss/template/libs/apex-chart.scss";
</style>
