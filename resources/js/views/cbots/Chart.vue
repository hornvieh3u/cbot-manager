<script setup>

import BarChart from '@/@core/libs/chartjs/components/BarChart'
import { useTheme } from 'vuetify'
import { getLatestBarChartConfig } from '@core/libs/chartjs/chartjsConfig'

const props = defineProps({
    data: {
      type: Array,
      required: false,
    },
    title: {
      type: String,
      required: true
    },
    type: {
      type: String,
      required: true
    }
})

const vuetifyTheme  = useTheme()
const chartOptions  = computed(() => getLatestBarChartConfig(vuetifyTheme.current.value))
const chartData     = computed(() => {
  let labels    = []
  let data      = []
  let barColors = []

  if( props.type == 'day' ) {
    barColors = ['#116af1', '#ef8314', '#8f9192', '#f5c823', '#25d0f7', '#08f93b', '#083eb7']
    labels    = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri']
  } else if ( props.type == 'unit' ) {
    barColors = ['#7367f0', '#ff9f43', '#9ca0a4', '#ff9f43', '#00cfe8']
  } else {
    // todo something later...
  }

  props.data.forEach(value => {
    if( props.type == 'unit' ) {
      labels.push(value.unit)
      data.push(value.u_cnt)
    } else {
      data.push(value.d_cnt)
    }
  });

  return {
    labels,
    datasets: [{
      maxBarThickness: 80,
      backgroundColor: barColors,
      borderColor: 'transparent',
      data: data,
    }],
  }
});

</script>

<template>
    <VCard :title="props.title">
        <VCardText>
            <BarChart
                :height="400"
                :chart-data="chartData"
                :chart-options="chartOptions"
            />
        </VCardText>
    </VCard>
</template>

<style lang="scss">
#chartjs-wrapper {
  .v-card-item__append {
    padding-inline-start: 0;
  }
}
</style>
