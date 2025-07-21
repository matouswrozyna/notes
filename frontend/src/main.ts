import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: { mdi },
  },
  display: {
    thresholds: {
      xs: 0,
      sm: 600,
      md: 1024,
      lg: 1440,
    },
    mobileBreakpoint: 'sm',
  },
})

const app = createApp(App)

app.use(router)
app.use(vuetify)

app.mount('#app')
