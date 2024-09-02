<script setup>

const rowPerPage = ref(6)
const currentPage = ref(1)
const totalPage = ref(1)

const props = defineProps({
  tasks: {
    type: Object,
    required: false
  },
  pagination: {
    type: Boolean,
    required: false
  }
})

const tasks = ref([]);

const paginationData = computed(() => {

  if( props.pagination )
    totalPage.value = Math.ceil(props.tasks.length / rowPerPage.value)

  const firstIndex = props.tasks.length ? (currentPage.value - 1) * rowPerPage.value + 1 : 0
  const lastIndex = props.tasks.length ?
                      (
                        currentPage.value * rowPerPage.value > props.tasks.length ?
                          props.tasks.length :
                          currentPage.value * rowPerPage.value
                      ) :
                      0

  if ( props.pagination )
    tasks.value = props.tasks.slice(firstIndex - 1, lastIndex)
  
  return `Showing ${ firstIndex } to ${ lastIndex } of ${ props.tasks.length } entries`
})

onMounted(() => {
  tasks.value = props.tasks
})

</script>

<template>
  <VCard v-if="props.tasks" title="Last Performed Tasks">

    <VDivider />

    <!-- SECTION Table -->
    <VTable class="text-no-wrap">
      <!-- 👉 Table head -->
      <thead>
        <tr>
          <!-- 👉 Check/Uncheck all checkbox -->

          <th
            scope="col"
            class="font-weight-semibold"
          >
            UNIT
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            FLOOR
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            DURATION
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            DATE
          </th>
        </tr>
      </thead>

      <!-- 👉 Table Body -->
      <tbody>
        <tr
          v-for="(task, index) in tasks"
          :key="index"
          style="height: 3.5rem;"
        >
          <!-- 👉 UNIT -->
          <td>
            {{ task.unit }}
          </td>

          <!-- 👉 FLOOR -->
          <td>
            {{ task.floor }}
          </td>

          <!-- 👉 DURATION -->
          <td>
            {{ task.duration }}
          </td>

          <!-- 👉 DATE -->
          <td>
            {{ task.date }}
          </td>
        </tr>
      </tbody>

      <!-- 👉 table footer  -->
      <tfoot v-show="!props.tasks.length">
        <tr>
          <td
            colspan="8"
            class="text-center text-body-1"
          >
            No data available
          </td>
        </tr>
      </tfoot>
    </VTable>
    <!-- !SECTION -->

    <VDivider />

    <!-- SECTION Pagination -->
    <VCardText class="d-flex align-center flex-wrap justify-space-between gap-4 py-3" v-if="props.pagination">
      <!-- 👉 Pagination meta -->
      <span class="text-sm text-disabled">{{ paginationData }}</span>

      <!-- 👉 Pagination -->
      <VPagination
        v-model="currentPage"
        size="small"
        :total-visible="2"
        :length="totalPage"
      />
    </VCardText>
  <!-- !SECTION -->
  </VCard>
</template>