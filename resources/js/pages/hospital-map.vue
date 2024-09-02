<script setup>
import axios from '@axios'

const hospitalMaps = ref([])

onMounted(() => {
    axios.post('/api/user/hospital_map')
        .then(r => {
            const response = r.data;
            if( response.status == true ) {
                hospitalMaps.value = response.data
            }
        })
        .catch(err => console.log(err));
});

</script>

<template>
    <VRow class="match-height">
        <VCol cols="12" md="4" sm="4" v-for="map in hospitalMaps">
            <VCard :title="map.id">
                <VDivider />
                <VTable class="text-no-wrap">
                    <tbody>
                        <tr v-for="floor in map.floor_data">
                            <td class="text-center" width="20%" :style="{fontSize:'20px',color:'#EA5455'}">
                                {{ floor.id }}
                            </td>
                            <td class="text-center" :style="{fontSize:'20px'}">
                                <VRow>
                                    <VCol cols="12" :md="12 / floor.room_data.length" v-for="room in floor.room_data">
                                        <RouterLink
                                            :to="{
                                                name:   'home',
                                                query: { unit: map.id, floor: floor.id, room: room.id }
                                            }"
                                        >
                                            {{ room.id }}
                                        </RouterLink>
                                    </VCol>
                                </VRow>
                            </td>
                        </tr>
                    </tbody>
                </VTable>
                <VDivider class="mb-5" />
            </VCard>
        </VCol>
    </VRow>
</template>