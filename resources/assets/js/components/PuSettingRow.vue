<template>
  <tr>
    <td>
      <a @click="toggle" class="button is-rounded" :class="value ? 'is-success' : 'is-danger'">
        <pu-on v-if="value"></pu-on>
        <pu-off v-if="!value"></pu-off>
      </a>
    </td>
    <td v-text="description"></td>
  </tr>
</template>

<script>
  export default{
    props: ['setting', 'index'],
    data() {
      return {
        value: this.setting.value,
        id: this.setting.id,
        description: this.setting.description
      }
    },
    methods: {
      toggle() {
        this.$emit('message', {index: this.index, id: this.id});
        this.value = !this.value
      }
    }
  }
</script>
