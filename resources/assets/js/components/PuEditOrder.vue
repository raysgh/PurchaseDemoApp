<template>
  <form @submit.prevent="onSubmit">
    <div class="field">
      <label class="label">General order details</label>
      <div class="field is-grouped">
        <div class="control">
          <div class="select">
            <select id="supplier" name="supplier" v-model="orderCurrent.supplier_id" @click="errors.clear('supplier')">
              <option value="">Select supplier</option>
              <option v-for="supplierSelected in supplierSelection" :value="supplierSelected.id">
                {{ supplierSelected.name }}
              </option>
            </select>
          </div>
          <p class="help is-danger" v-text="errors.get('supplier')"></p>
        </div>
        <div class="control is-expanded">
          <input class="input" type="text"
              id="description" name="description" placeholder="Description"
              v-model="orderCurrent.description" @keydown="errors.clear('description')">
          <p class="help is-danger" v-text="errors.get('description')"></p>
        </div>
      </div>
    </div>
    <label class="label">Order lines</label>
    <div class="field" v-for="(position, index) in posCurrent">
      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text"
              id="quantity" name="quantity" placeholder="Quantity"
              v-model="position.quantity" @keydown="errors.clearPosCurrent(index,'quantity')">
          <p class="help is-danger" v-text="errors.getPosCurrent(index,'quantity')"></p>
        </div>
        <div class="control is-expanded">
          <input class="input" type="text"
              id="description"name="description" placeholder="Description"
              v-model="position.description" @keydown="errors.clearPosCurrent(index,'description')">
          <p class="help is-danger" v-text="errors.getPosCurrent(index,'description')"></p>
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text"
              id="price" name="price" placeholder="0.00"
              v-model="position.price" @keydown="errors.clearPosCurrent(index,'price')">
          <p class="help is-danger" v-text="errors.getPosCurrent(index,'price')"></p>
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
        <div class="control">
          <button class="button is-danger is-small" @click.prevent="removeCurrentLine(index, position.id)">
            <span class="icon">
              <i class="fas fa-minus"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="field" v-for="(position, index) in pos">
      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text"
              id="quantity" name="quantity" placeholder="Quantity"
              v-model="position.quantity" @keydown="errors.clearPos(index,'quantity')">
          <p class="help is-danger" v-text="errors.getPos(index,'quantity')">></p>
        </div>
        <div class="control is-expanded">
          <input class="input" type="text"
              id="description"name="description" placeholder="Description"
              v-model="position.description" @keydown="errors.clearPos(index,'description')">
          <p class="help is-danger" v-text="errors.getPos(index,'description')">></p>
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text"
              id="price" name="price" placeholder="0.00"
              v-model="position.price" @keydown="errors.clearPos(index,'price')">
          <p class="help is-danger" v-text="errors.getPos(index,'price')">></p>
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
        <div class="control">
          <button class="button is-danger is-small" @click.prevent="removeLine(index)">
            <span class="icon">
              <i class="fas fa-minus"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <button class="button is-success is-small is-pulled-right" @click.prevent="addLine">
          <span class="icon">
            <i class="fas fa-plus"></i>
          </span>
        </button>
      </div>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link" type="submit">
          <span class="icon">
            <i class="fas fa-save"></i>
          </span>
          <span>Save</span>
        </button>
      </div>
      <div class="control">
        <a :href="previousLink" class="button is-text">Cancel</a>
      </div>
    </div>
  </form>
</template>

<script>
  import Errors from './Errors';

  export default{
    props: ['suppliers', 'order', 'orderLines', 'previous'],
    data() {
      return {
        supplierSelection: JSON.parse(this.suppliers),
        orderCurrent: JSON.parse(this.order),
        posCurrent: JSON.parse(this.orderLines),
        pos: [],
        previousLink: this.previous,
        errors: new Errors()
      }
    },
    methods: {
      addLine() {
        this.pos.push({
          quantity: null,
          description: '',
          price: null,
        });
      },
      removeLine(index) {
        this.pos.splice(index, 1);
      },
      removeCurrentLine(index, id) {
        axios.delete(`/order-lines/${id}`, {
          id: id
        })
        .then(response => this.posCurrent.splice(index, 1))
        .catch(error => console.log('Whoops, something went worng'));
      },
      onSubmit() {
        axios.put(`/orders/${this.orderCurrent.id}`, {
          supplier: this.orderCurrent.supplier_id,
          description: this.orderCurrent.description,
          pos: this.pos,
          posCurrent: this.posCurrent
        })
        .then(response => window.location = `/orders/${response.data}`)
        .catch(error => this.errors.record(error.response.data));
      }
    }
  }
</script>
