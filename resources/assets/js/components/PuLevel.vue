<template>
  <nav class="level">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Orders</p>
      <p class="title" v-text="level.orders"></p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Order lines</p>
      <p class="title" v-text="level.orderLines"></p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Spend</p>
      <p class="title">{{level.spend}}K</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Suppliers</p>
      <p class="title" v-text="level.suppliers"></p>
    </div>
  </div>
  </nav>
</template>

<script>
  export default{
    data() {
      return {
        level: []
      }
    },
    created() {
      axios.get('/dashboard/level')
        .then(response => this.level = response.data)
        .catch(() => altert('Something went wrong'));
    }
  }
</script>
