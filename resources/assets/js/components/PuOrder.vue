<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-clipboard"></i>
        </span>
        Order #{{ orderid }}
      </p>
      <a href="#" @click="toggle" class="card-header-icon" aria-label="more options">
        <pu-up v-if="visible"></pu-up>
        <pu-down v-if="!visible"></pu-down>
      </a>
    </header>
    <div v-if="visible" class="card-content">
      <div class="content">
        {{ description }}
      </div>
    </div>
    <footer class="card-footer">
      <p class="card-footer-item">
        <pu-cart-full v-if="isOrderedBool"></pu-cart-full>
        <pu-cart-empty v-if="!isOrderedBool"></pu-cart-empty>
        &nbsp;{{ isOrderedString }}
      </p>
      <p class="card-footer-item">
        Created by&nbsp;<strong>{{ username }}</strong>
      </p>
    </footer>
  </div>
</template>

<script>
    export default {
        props: ['orderid', 'description', 'ordered', 'username'],
        data() {
          return {
            visible: true,
            isOrderedString: this.ordered == 1 ? 'Ordered' : 'Not Ordered',
            isOrderedBool: this.ordered == 1 ? true : false,
          }
        },
        methods: {
            toggle() {
              this.visible = !this.visible;
            }
        }
    }
</script>
