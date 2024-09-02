<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import avatar2 from '@images/avatars/avatar-2.png'
import avatar3 from '@images/avatars/avatar-3.png'
import avatar4 from '@images/avatars/avatar-4.png'
import avatar5 from '@images/avatars/avatar-5.png'
import avatar6 from '@images/avatars/avatar-6.png'
</script>

<template>
  <div class="demo-space-x">
    <VAvatar>
      <VImg :src="avatar1" />
    </VAvatar>

    <VAvatar>
      <VImg :src="avatar2" />
    </VAvatar>

    <VAvatar>
      <VImg :src="avatar3" />
    </VAvatar>
    <VAvatar>
      <VImg :src="avatar4" />
    </VAvatar>

    <VAvatar>
      <VImg :src="avatar5" />
    </VAvatar>

    <VAvatar>
      <VImg :src="avatar6" />
    </VAvatar>
  </div>
</template>
