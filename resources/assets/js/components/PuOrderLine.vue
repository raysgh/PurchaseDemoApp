<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-list-alt"></i>
        </span>
        Order Lines
      </p>
      <a @click="toggle" class="card-header-icon" aria-label="more options">
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
              <th><p class="has-text-right">Unit Price</p></th>
              <th><p class="has-text-right">Amount</p></th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="orderline in orderlinesx">
                <td>{{ orderline.quantity}}</td>
                <td>{{ orderline.description}}</td>
                <td><p class="has-text-right">&euro; {{ orderline.price.toFixed(2) }}</p></td>
                <td><p class="has-text-right">&euro; {{ subtotal(orderline.quantity, orderline.price) }}</p></td>
              </tr>
            <tr>
              <td></td>
              <td></td>
              <td><p class="has-text-right"><strong>Total:</strong></p></td>
              <td><p class="has-text-right"><strong>&euro; {{ total }}</strong></p></td>
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
            },
            subtotal(qty, value) {
              let subtotal = qty * value;
              return subtotal.toFixed(2);
            }
        }
    }
</script>
