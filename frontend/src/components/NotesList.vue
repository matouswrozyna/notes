<template>
  <v-container>
    <v-row v-if="notes.length > 0">
      <v-col
        v-for="note in notes"
        :key="note.id"
        cols="12"
        xs="6"
        lg="6"
        class="max-w-full"
      >
        <v-card class="max-w-full">
          <v-card-subtitle class="d-flex align-center">
            <v-avatar
              size="10"
              :color="getPriorityColor(note.priority)"
            ></v-avatar>
            <v-chip size="small" variant="text" :color="getPriorityColor(note.priority)">{{ getPriorityLabel(note.priority) }}</v-chip>
          </v-card-subtitle>
          <v-card-title>{{ note.name }}</v-card-title>
          <v-card-text>{{ note.description }}</v-card-text>
          <v-card-actions>
            <v-chip size="small" variant="text">Created: {{ formatDate(note.created) }}</v-chip>
            <v-spacer />
            <v-btn
              icon
              @click="openDeleteDialog(note)"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <v-row v-else>
      <v-col cols="12">
        <v-alert type="info" border="start" elevation="2">
          No notes found.
        </v-alert>
      </v-col>
    </v-row>
  </v-container>

  <v-dialog v-model="confirmDialog" max-width="400">
    <v-card>
      <v-card-title class="text-h6">Are you sure you want to delete this note?</v-card-title>
      <v-card-actions>
        <v-spacer />
        <v-btn text @click="confirmDialog = false">Cancel</v-btn>
        <v-btn color="red" text @click="deleteNote">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { PRIORITY_MAP } from '@/constants/priority'
import { API_BASE_URL } from '@/constants/api'

const getPriorityLabel = (val: number) => PRIORITY_MAP[val]?.label ?? 'Unknown'
const getPriorityColor = (val: number) => PRIORITY_MAP[val]?.color ?? 'grey'

const notes = ref([])
const confirmDialog = ref(false)
const noteToDelete = ref(null)

const openDeleteDialog = (note) => {
  noteToDelete.value = note
  confirmDialog.value = true
}

const fetchNotes = async () => {
  const res = await fetch(`${API_BASE_URL}/notes?order[priority]=desc`)
  const data = await res.json()
  notes.value = data
}

const deleteNote = async () => {
  if (!noteToDelete.value) return

  await fetch(`${API_BASE_URL}/notes/${noteToDelete.value.id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
    },
  })

  confirmDialog.value = false
  noteToDelete.value = null
  await fetchNotes()
}

const formatDate = (dateStr) => {
  const date = new Date(dateStr)
  return date.toLocaleString()
}

onMounted(fetchNotes)
</script>
