<script setup>
import { useProjectStore } from '@/views/dashboards/analytics/useProjectStore'
import { avatarText } from '@core/utils/formatters'

const projectStore = useProjectStore()
const searchQuery = ref('')
const rowPerPage = ref(5)
const currentPage = ref(1)
const totalPage = ref(1)
const totalProjects = ref(0)
const projects = ref([])
const selectedRows = ref([])
const selectAllProject = ref(false)

// 👉 Fetch Projects
watchEffect(() => {
  projectStore.fetchProjects({
    q: searchQuery.value,
    perPage: rowPerPage.value,
    currentPage: currentPage.value,
  }).then(response => {
    projects.value = response.data.projects
    totalPage.value = response.data.totalPage
    totalProjects.value = response.data.totalProjects
  }).catch(error => {
    console.log(error)
  })
})

// 👉 Fetch Projects
watchEffect(() => {
  if (currentPage.value > totalPage.value)
    currentPage.value = totalPage.value
})

// 👉 Computing pagination data
const paginationData = computed(() => {
  const firstIndex = projects.value.length ? (currentPage.value - 1) * rowPerPage.value + 1 : 0
  const lastIndex = projects.value.length + (currentPage.value - 1) * rowPerPage.value
  
  return `Showing ${ firstIndex } to ${ lastIndex } of ${ totalProjects.value } entries`
})

// 👉 Add/Remove all checkbox ids in/from array
const selectUnselectAll = () => {
  selectAllProject.value = !selectAllProject.value
  if (selectAllProject.value) {
    projects.value.forEach(project => {
      if (!selectedRows.value.includes(`check${ project.status }`))
        selectedRows.value.push(`check${ project.status }`)
    })
  } else {
    selectedRows.value = []
  }
}

// 👉 watch if checkbox array is empty all checkbox should be uncheck
watch(selectedRows, () => {
  if (!selectedRows.value.length)
    selectAllProject.value = false
}, { deep: true })

const addRemoveIndividualCheckbox = checkID => {
  if (selectedRows.value.includes(checkID)) {
    const index = selectedRows.value.indexOf(checkID)

    selectedRows.value.splice(index, 1)
  } else {
    selectedRows.value.push(checkID)
    selectAllProject.value = true
  }
}
</script>

<template>
  <VCard v-if="projects">
    <VCardItem class="project-header d-flex flex-wrap justify-space-between py-4 gap-4">
      <VCardTitle>Projects</VCardTitle>

      <template #append>
        <div
          class="d-flex align-center gap-2"
          style="width: 272px;"
        >
          <VLabel>Search:</VLabel>
          <VTextField
            v-model="searchQuery"
            placeholder="Search"
          />
        </div>
      </template>
    </VCardItem>

    <VDivider />

    <!-- SECTION Table -->
    <VTable class="text-no-wrap">
      <!-- 👉 Table head -->
      <thead>
        <tr>
          <!-- 👉 Check/Uncheck all checkbox -->
          <th
            scope="col"
            class="text-center"
          >
            <div style="width: 1rem;">
              <VCheckbox
                :model-value="selectAllProject"
                :indeterminate="(projects.length !== selectedRows.length) && !!selectedRows.length"
                @click="selectUnselectAll"
              />
            </div>
          </th>

          <th
            scope="col"
            class="font-weight-semibold"
          >
            NAME
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            LEADER
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            TEAM
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            STATUS
          </th>
          <th
            scope="col"
            class="font-weight-semibold"
          >
            <span class="ms-2">ACTIONS</span>
          </th>
        </tr>
      </thead>

      <!-- 👉 Table Body -->
      <tbody>
        <tr
          v-for="project in projects"
          :key="project.name"
          style="height: 3.5rem;"
        >
          <!-- 👉 Individual checkbox -->
          <td>
            <div style="width: 1rem;">
              <VCheckbox
                :id="`check${project.status}`"
                :model-value="selectedRows.includes(`check${project.status}`)"
                @click="addRemoveIndividualCheckbox(`check${project.status}`)"
              />
            </div>
          </td>

          <!-- 👉 Name -->
          <td>
            <div class="d-flex align-center gap-3">
              <VAvatar
                variant="tonal"
                color="primary"
                size="38"
              >
                <VImg
                  v-if="project.logo.length"
                  :src="project.logo"
                />
                <span
                  v-else
                  class="font-weight-semibold"
                >{{ avatarText(project.name) }}</span>
              </VAvatar>

              <div>
                <h6 class="text-base text-medium-emphasis font-weight-semibold">
                  {{ project.name }}
                </h6>
                <span class="text-disabled">{{ project.date }}</span>
              </div>
            </div>
          </td>

          <!-- 👉 Leader -->
          <td class="text-medium-emphasis">
            {{ project.leader }}
          </td>

          <!-- 👉 Team -->
          <td class="text-center">
            <div class="v-avatar-group">
              <VAvatar
                v-for="avatar in project.team"
                :key="avatar"
                :size="32"
                :image="avatar"
              />
            </div>
          </td>

          <!-- 👉 Progress -->
          <td class="text-center">
            <VProgressLinear
              :model-value="project.status"
              color="primary"
              height="6"
              rounded
              rounded-bar
            />
          </td>

          <!-- 👉 Actions -->
          <td
            class="text-center"
            style="width: 7.5rem;"
          >
            <VBtn
              icon
              variant="plain"
              color="default"
              size="x-small"
            >
              <VIcon
                :size="22"
                icon="tabler-dots-vertical"
              />

              <VMenu activator="parent">
                <VList density="compact">
                  <VListItem
                    href="#"
                    title="Details"
                  />
                  <VListItem
                    href="#"
                    title="Archive"
                  />
                </VList>
              </VMenu>
            </VBtn>
          </td>
        </tr>
      </tbody>

      <!-- 👉 table footer  -->
      <tfoot v-show="!projects.length">
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
    <VCardText class="d-flex align-center flex-wrap justify-space-between gap-4 py-3">
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

<style lang="scss">
.project-header .v-card-item__append {
  padding-inline-start: 0;
}
</style>
