<script setup>
import figma from '@images/icons/project-icons/figma.png'
import html5 from '@images/icons/project-icons/html5.png'
import python from '@images/icons/project-icons/python.png'
import react from '@images/icons/project-icons/react.png'
import sketch from '@images/icons/project-icons/sketch.png'
import vue from '@images/icons/project-icons/vue.png'
import xamarin from '@images/icons/project-icons/xamarin.png'

const projects = [
  {
    logo: react,
    name: 'BGC eCommerce App',
    project: 'React Project',
    leader: 'Eileen',
    progress: 78,
    hours: '18:42',
  },
  {
    logo: figma,
    name: 'Falcon Logo Design',
    project: 'Figma Project',
    leader: 'Owen',
    progress: 25,
    hours: '20:42',
  },
  {
    logo: vue,
    name: 'Dashboard Design',
    project: 'Vuejs Project',
    leader: 'Keith',
    progress: 62,
    hours: '120:87',
  },
  {
    logo: xamarin,
    name: 'Foodista mobile app',
    project: 'Xamarin Project',
    leader: 'Merline',
    progress: 8,
    hours: '120:87',
  },
  {
    logo: python,
    name: 'Dojo Email App',
    project: 'Python Project',
    leader: 'Harmonia',
    progress: 51,
    hours: '230:10',
  },
  {
    logo: sketch,
    name: 'Blockchain Website',
    project: 'Sketch Project',
    leader: 'Allyson',
    progress: 92,
    hours: '342:41',
  },
  {
    logo: html5,
    name: 'Hoffman Website',
    project: 'HTML Project',
    leader: 'Georgie',
    progress: 80,
    hours: '12:45',
  },
]

const resolveUserProgressVariant = progress => {
  if (progress <= 25)
    return 'error'
  if (progress > 25 && progress <= 50)
    return 'warning'
  if (progress > 50 && progress <= 75)
    return 'primary'
  if (progress > 75 && progress <= 100)
    return 'success'
  
  return 'secondary'
}
</script>

<template>
  <VCard title="Project List">
    <VDivider />
    <VTable class="text-no-wrap">
      <thead>
        <tr>
          <th scope="col">
            PROJECT
          </th>
          <th scope="col">
            LEADER
          </th>
          <th scope="col">
            PROGRESS
          </th>
          <th scope="col">
            ACTION
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="project in projects"
          :key="project.name"
        >
          <td class="d-flex align-center">
            <VAvatar
              :size="34"
              class="me-3"
              :image="project.logo"
            />
            <div>
              <h6 class="text-sm font-weight-medium">
                {{ project.name }}
              </h6>
              <p class="text-xs text-medium-emphasis mb-0">
                {{ project.project }}
              </p>
            </div>
          </td>

          <td> {{ project.leader }} </td>

          <td style="min-width: 8rem;">
            <div class="d-flex align-center gap-3">
              <VProgressLinear
                :height="6"
                :model-value="project.progress"
                rounded
                :color="resolveUserProgressVariant(project.progress)"
              />
              <span>
                {{ project.progress }}%
              </span>
            </div>
          </td>

          <td class="text-medium-emphasis">
            <VBtn
              icon
              size="small"
              variant="text"
              color="default"
            >
              <VIcon
                size="22"
                icon="tabler-dots-vertical"
              />

              <VMenu activator="parent">
                <VList density="compact">
                  <VListItem
                    v-for="(item, index) in ['Download', 'Delete', 'View']"
                    :key="index"
                    :value="index"
                  >
                    <VListItemTitle>{{ item }}</VListItemTitle>
                  </VListItem>
                </VList>
              </VMenu>
            </VBtn>
          </td>
        </tr>
      </tbody>
    </VTable>
  </VCard>
</template>
