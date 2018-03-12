<template>
  <div>
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Dashboard
        </p>
        <a @click="showDashboard = !showDashboard" class="card-header-icon" aria-label="more options">
          <pu-up v-if="showDashboard"></pu-up>
          <pu-down v-if="!showDashboard"></pu-down>
        </a>
      </header>
      <div class="card-content" v-if="showDashboard">
        <div class="content">
          <table class="table">
            <tbody>
              <pu-setting-row v-for="(setting, index) in settings" :key="setting.id"
                :setting="setting" :index="index"
                @message="handleUpdate">
              </pu-setting-row>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        settings: {},
        showDashboard: true,
      }
    },
    methods: {
      handleUpdate(payload) {
        axios.put('settings/' + payload.id, {
          value: !this.settings[payload.index].value
        })
        .then(() => this.settings[payload.index].value = !this.settings[payload.index].value)
        .catch(() => alert('Something went wrong'));
      }
    },
    mounted() {
      axios.get('/settings/edit')
        .then(response => this.settings = response.data)
        .catch(() => alert('Something went wrong'));
    }
  }
</script>
