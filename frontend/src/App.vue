<template>
  <v-app>
    <v-app-bar :elevation="2">
      <v-app-bar-title>Notes</v-app-bar-title>

      <v-spacer />
      <v-btn
        color="primary"
        @click="dialog = true"
      >
        <v-icon start>mdi-plus</v-icon>
        Add note
      </v-btn>
    </v-app-bar>

    <v-main>
      <RouterView />
    </v-main>

    <v-dialog
      v-model="dialog"
      max-width="600"
    >
      <v-card>
        <v-card-title class="d-flex justify-space-between align-center">
          New note
          <v-btn
            icon
            @click="dialog = false"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>

        <v-card-text>
          <note-form @submitted="onNoteSubmitted" />
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script setup lang="ts">
import { ref } from 'vue'

import NoteForm from '@/components/NoteForm.vue'

const dialog = ref(false)
const viewKey = ref(0)
const onNoteSubmitted = () => {
  dialog.value = false
  viewKey.value++
}
</script>
