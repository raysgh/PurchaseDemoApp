<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-list-alt"></i>
        </span>
        Order Lines
      </p>
      <a href="#" @click="toggle" class="card-header-icon" aria-label="more options">
        <pu-up v-if="visible"></pu-up>
        <pu-down v-if="!visible"></pu-down>
      </a>
    </header>
    <div v-if="visible" class="card-content">
      <div class="content">
        <table class="table is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th>Quantity</th>
              <th>Description</th>
              <th>Unit Price</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="orderline in orderlinesx">
                <td>{{ orderline.quantity}}</td>
                <td>{{ orderline.description}}</td>
                <td>&euro; {{ orderline.price / 100}}</td>
                <td>&euro; {{ orderline.quantity * orderline.price / 100}}</td>
              </tr>
            <tr>
              <td></td>
              <td></td>
              <td><strong>Total:</strong></td>
              <td><strong>&euro; {{ total }}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['orderlines', 'total'],
        data() {
          return {
            visible: true,
            orderlinesx: JSON.parse(this.orderlines),
          }
        },
        methods: {
            toggle() {
              this.visible = !this.visible;
            }
        }
    }
</script>
