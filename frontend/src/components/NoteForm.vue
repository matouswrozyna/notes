<template>
  <v-container>
    <v-form
      @submit.prevent="submitNote"
      v-model="valid"
    >
      <v-text-field
        v-model="form.name"
        label="Name"
        :rules="[(v) => !!v || 'Name is required']"
        required
      />
      <v-textarea
        v-model="form.description"
        label="Description"
        :rules="[(v) => !!v || 'Description is required']"
        required
      />
      <v-select
        label="Priority"
        v-model="form.priority"
        :items="PRIORITY_OPTIONS"
        item-title="label"
        item-value="value"
      />
      <v-btn
        :disabled="!valid"
        type="submit"
        color="primary"
      >Save Note</v-btn
      >
    </v-form>

    <v-snackbar
      v-model="snackbar"
      timeout="3000"
      color="green"
    >
      Note saved!
    </v-snackbar>
  </v-container>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { PRIORITY_OPTIONS } from '@/constants/priority'
import {API_BASE_URL} from "@/constants/api.ts";

const valid = ref(false)
const snackbar = ref(false)

const emit = defineEmits(['submitted'])

const form = ref({
  name: '',
  description: '',
  priority: 1,
})

const submitNote = async () => {
  const payload = {
    ...form.value,
    state: 1,
    created: new Date().toISOString(),
    modified: new Date().toISOString(),
  }

  const res = await fetch(`${API_BASE_URL}/notes`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(payload),
  })

  if (res.ok) {
    snackbar.value = true
    form.value = { name: '', description: '', priority: 0 }
    emit('submitted')
  } else {
    console.error('Note save failed', await res.text())
  }
}
</script>
