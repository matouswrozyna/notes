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
  </v-app>
</template>

<script setup lang="ts">
import { ref } from 'vue'

import { RouterView } from 'vue-router'

const dialog = ref(false)
</script>
