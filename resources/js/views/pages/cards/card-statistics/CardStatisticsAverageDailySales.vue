<script setup>
import VueApexCharts from 'vue3-apexcharts'
import { useTheme } from 'vuetify'

const vuetifyTheme = useTheme()
const currentTheme = vuetifyTheme.current.value.colors

const series = [{
  data: [
    400,
    200,
    650,
    500,
  ],
}]

const chartOptions = {
  chart: {
    type: 'area',
    toolbar: { show: false },
    sparkline: { enabled: true },
  },
  markers: {
    colors: 'transparent',
    strokeColors: 'transparent',
  },
  grid: { show: false },
  colors: [currentTheme.success],
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 0.8,
      opacityFrom: 0.6,
      opacityTo: 0.1,
    },
  },
  dataLabels: { enabled: false },
  stroke: {
    width: 2,
    curve: 'smooth',
  },
  xaxis: {
    show: true,
    lines: { show: false },
    labels: { show: false },
    stroke: { width: 0 },
    axisBorder: { show: false },
  },
  yaxis: {
    stroke: { width: 0 },
    show: false,
  },
  responsive: [
    {
      breakpoint: 1387,
      options: { chart: { height: 80 } },
    },
    {
      breakpoint: 1200,
      options: { chart: { height: 120 } },
    },
  ],
}
</script>

<template>
  <VCard>
    <VCardText>
      <h6 class="text-h6 mb-2">
        Average Daily Sales
      </h6>
      <p class="text-sm mb-0">
        Total Sales This Month
      </p>
      <h6 class="text-h6">
        $28,450
      </h6>
    </VCardText>

    <VueApexCharts
      :options="chartOptions"
      :series="series"
      :height="122"
    />
  </VCard>
</template>
