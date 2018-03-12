<template>
  <div>
    <p v-if="settings.instructions">Dit zijn de instructies van de Purchase app</p>

    <pu-level v-if="settings.level"></pu-level>
  </div>
</template>

<script>
  export default{
    data() {
      return {
        settings: {}
      }
    },
    mounted() {
      axios.get('/settings/get')
        .then(response => this.settings = response.data)
        .catch(() => alert('Something went wrong'));
    }
  }
</script>
