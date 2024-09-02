<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import { useChat } from './useChat'
import ChatContact from '@/views/apps/chat/ChatContact.vue'
import { useChatStore } from '@/views/apps/chat/useChatStore'

const props = defineProps({
  search: {
    type: String,
    required: true,
  },
  isDrawerOpen: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'openChatOfContact',
  'showUserProfile',
  'close',
])

const { resolveAvatarBadgeVariant } = useChat()
const search = useVModel(props, 'search')
const store = useChatStore()
</script>

<template>
  <!-- 👉 Chat list header -->
  <div
    v-if="store.profileUser"
    class="chat-list-header"
  >
    <VBadge
      dot
      location="bottom right"
      offset-x="3"
      offset-y="3"
      :color="resolveAvatarBadgeVariant(store.profileUser.status)"
      bordered
    >
      <VAvatar
        size="38"
        class="cursor-pointer"
        @click="$emit('showUserProfile')"
      >
        <VImg
          :src="store.profileUser.avatar"
          alt="John Doe"
        />
      </VAvatar>
    </VBadge>

    <VTextField
      v-model="search"
      density="compact"
      placeholder="Search..."
      class="ms-4 me-1 chat-list-search"
    >
      <template #prepend-inner>
        <VIcon
          size="22"
          icon="tabler-search"
        />
      </template>
    </VTextField>

    <VBtn
      v-if="$vuetify.display.smAndDown"
      variant="text"
      color="default"
      icon
      size="small"
      @click="$emit('close')"
    >
      <VIcon
        size="24"
        icon="tabler-x"
        class="text-medium-emphasis"
      />
    </VBtn>
  </div>
  <VDivider />

  <PerfectScrollbar
    tag="ul"
    class="chat-contacts-list px-3"
    :options="{ wheelPropagation: false }"
  >
    <li>
      <span class="chat-contact-header d-block text-primary text-xl font-weight-medium">Chats</span>
    </li>
    <ChatContact
      v-for="contact in store.chatsContacts"
      :key="`chat-${contact.id}`"
      :user="contact"
      is-chat-contact
      @click="$emit('openChatOfContact', contact.id)"
    />
    <span
      v-show="!store.chatsContacts.length"
      class="no-chat-items-text text-disabled"
    >No chats found</span>
    <li>
      <span class="chat-contact-header d-block text-primary text-xl font-weight-medium">Contacts</span>
    </li>
    <ChatContact
      v-for="contact in store.contacts"
      :key="`chat-${contact.id}`"
      :user="contact"
      @click="$emit('openChatOfContact', contact.id)"
    />
    <span
      v-show="!store.contacts.length"
      class="no-chat-items-text text-disabled"
    >No contacts found</span>
  </PerfectScrollbar>
</template>

<style lang="scss">
.chat-contacts-list {
  --chat-content-spacing-x: 12px;

  padding-block-end: 0.75rem;

  .chat-contact-header {
    margin-block-end: 1rem;
    margin-block-start: 1.25rem;
  }

  .chat-contact-header,
  .no-chat-items-text {
    margin-inline: var(--chat-content-spacing-x);
  }
}
</style>
