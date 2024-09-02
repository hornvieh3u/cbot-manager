<script setup>
import AppDateTimePicker from '@core/components/AppDateTimePicker.vue'
import { useRoute } from 'vue-router';
import { toast } from 'vue3-toastify'

const isDialogVisible = ref(false)
const dateRange = ref('')
const router = useRouter()
const route = useRoute()

const submit = () => {
    let range = dateRange.value.split(' to ');
    if( range.length != 2 )
    {
        toast.error('Please select correctly.')
        return;
    }
    isDialogVisible.value = false
    router.replace({ name: 'export-pdf', query: { range } });
}

</script>

<template>
    <VDialog
        v-model="isDialogVisible"
        persistent
        class="v-dialog-sm"
        v-if="route.name === 'home' && Object.keys(route.query).length === 0" 
    >
        <!-- Dialog Activator -->
        <template #activator="{ props }">
            <VBtn color="primary mr-5" v-bind="props">
                Export PDF
            </VBtn>
        </template>

        <!-- Dialog close btn -->
        <DialogCloseBtn @click="isDialogVisible = !isDialogVisible" />

        <!-- Dialog Content -->
        <VCard title="Select Date Range">
        <VCardText>
            <AppDateTimePicker
                v-model="dateRange"
                label="DateRange"
                :config="{ mode: 'range', dateFormat: 'Y/m/d', inline: true }"
            />
        </VCardText>

        <VCardText class="d-flex justify-end gap-3 flex-wrap">
            <VBtn
                color="secondary"
                variant="tonal"
                @click="isDialogVisible = false"
            >
                Cancel
            </VBtn>
            <VBtn @click="submit">
                Submit
            </VBtn>
        </VCardText>
        </VCard>
    </VDialog>
</template>