<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-industry"></i>
        </span>
        {{ name }}
      </p>
      <a @click="toggle" class="card-header-icon" aria-label="more options">
        <pu-up v-if="visible"></pu-up>
        <pu-down v-if="!visible"></pu-down>
      </a>
    </header>
    <div class="card-content" v-if="visible">
      <div class="content">
        <a :href="'/suppliers/' + orderid">{{ name }}</a>
        <br>
        {{ address }}
        <br>
        {{ postcode }} {{ city }}
        <br>
        {{ country }}
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['orderid', 'name', 'address', 'postcode', 'city', 'country'],
        data() {
          return {
            visible: false,
          }
        },
        methods: {
          toggle() {
            this.visible = !this.visible;
          }
        },
        computed: {
          icon() {
            return this.visible ? 'fas fa-angle-up' : 'fas fa-angle-down';
          }
        }
    }
</script>
