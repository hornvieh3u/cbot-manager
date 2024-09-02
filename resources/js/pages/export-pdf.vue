<script setup>
import RobotUsageDetail     from '@/views/cbots/panels/RobotUsageDetail.vue'
import LastPerformedTasks   from '@/views/cbots/panels/LastPerformedTasks.vue'
import Chart  from '@/views/cbots/Chart.vue'
import moment from 'moment'
import axios from '@axios'
import html2pdf from 'html2pdf.js'

const route = useRoute()
const router = useRouter()

const exportData = ref([]);
const download = ref({
    state: 'Download PDF',
    loading: false
});

onMounted(async () => {
    if( !route.query.range ) return router.replace({ name: 'home' })

    const dateRange = route.query.range

    const startDate =   new Date(dateRange[0])
    const lastdate  =   new Date(dateRange[1])
    
    let firstSatday =   new Date( startDate.setDate(startDate.getDate() - startDate.getDay()) )
    let lastFriday  =   new Date( lastdate.setDate(lastdate.getDate() - lastdate.getDay() + 6) )

    firstSatday = moment(firstSatday).subtract(1, 'days')
    lastFriday  = moment(lastFriday).subtract(1, 'days')

    let tempExportData = [];
    for (let date = firstSatday; date <= lastFriday; date = date.add(7, 'days')) {
        const sat = date.format('YYYY/MM/DD')
        const fri = moment(date).add(6, 'days').format('YYYY/MM/DD')

        const requestParam = {
            robot_serial: 0,
            start_date: sat,
            end_date: fri,
        }

        const response = await getHomeTotalInfo(requestParam)

        if( response.status == true ) {
            tempExportData.push({
                tasks:              response.data.performed_task_info,
                usages:             response.data.total_info,
                chartDataByDay:     response.data.performed_task_day_info,
                chartDataByUnit:    response.data.performed_task_unit_info,
                dateRange:          `${sat} ~ ${fri}`
            });
        }
    }

    exportData.value = tempExportData
})

const getHomeTotalInfo = async params => {
    try {
        const response = await axios.post('/api/user/dashboard', params)
        return response.data
    } catch (error) {
        console.log(error)
    }
}

const generatePdf = () => {
    download.value = {
        state: 'Downloading...',
        loading: true
    }

    const pages =   document.getElementsByClassName('page')
    const opt   =   {
        margin: 1,
        filename: 'robot-report.pdf',
        image: { type: 'jpeg', quality: 0.8 },
        html2canvas: { scale: 1.3 },
        jsPDF: { unit: 'mm', format: 'a3', orientation: 'landscape' },
    }

    let worker = html2pdf().set(opt).from(pages[0]).toPdf()
    pages.forEach((page, index) => {
        if( index > 1 ) {
            worker = worker
                .get('pdf')
                .then(pdf => {
                    pdf.addPage()
                })
                .from(page)
                .toContainer()
                .toCanvas()
                .toPdf()
        }
    })
    worker = worker.save().then(() => {
        download.value = {
            state: 'DownLoad PDF',
            loading: false
        }
    })
}

</script>

<template>
    <div>
        <VBtn class="mb-5" @click="generatePdf" :disabled="download.loading">{{ download.state }}</VBtn>
        <VProgressCircular
            :width="3"
            color="primary"
            indeterminate
            class="mb-5 ml-5"
            v-if="download.loading"
        />
        <VCard v-for="data in exportData" :title="data.dateRange" class="mb-5 page">
            <VRow class="match-height">
                <!-- 👉 Robot Detail -->
                <VCol
                cols="12"
                md="6"
                >
                    <VCard
                        title="Robot Usage Detail"
                    >
                        <RobotUsageDetail
                            :usages="data.usages"
                        />
                    </VCard>
                </VCol>

                <!-- 👉 Last Performed Tasks Table -->
                <VCol
                cols="12"
                md="6"
                >
                <LastPerformedTasks
                    :tasks="data.tasks"
                />
                </VCol>
                <VCol
                cols="12"
                md="6"
                >
                <Chart
                    :data="data.chartDataByDay"
                    type="day"
                    title="Performed Tasks By Day"
                />
                </VCol>
                <VCol
                cols="12"
                md="6"
                >
                <Chart
                    :data="data.chartDataByUnit"
                    type="unit"
                    title="Performed Tasks By Unit"
                />
                </VCol>
            </VRow>
        </VCard>
    </div>
</template>