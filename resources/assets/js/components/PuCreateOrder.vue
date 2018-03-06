<template>
  <form @submit.prevent="onSubmit">
    <div class="field">
      <label class="label">General order details</label>
      <div class="field is-grouped">
        <div class="control">
          <div class="select">
            <select id="supplier" name="supplier" v-model="supplier" @click="errors.clear('supplier')">
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
              v-model="description" @keydown="errors.clear('description')">
          <p class="help is-danger" v-text="errors.get('description')"></p>
        </div>
      </div>
    </div>
    <label class="label">Order lines</label>
    <div class="field" v-for="(position, index) in pos">
      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text"
              id="quantity" name="quantity" placeholder="Quantity"
              v-model="position.quantity" @keydown="errors.clearPos(index,'quantity')">
          <p class="help is-danger" v-text="errors.getPos(index,'quantity')"></p>
        </div>
        <div class="control is-expanded">
          <input class="input" type="text"
              id="description"name="description" placeholder="Description"
              v-model="position.description" @keydown="errors.clearPos(index,'description')" >
          <p class="help is-danger" v-text="errors.getPos(index,'description')"></p>
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text"
              id="price" name="price" placeholder="0,00"
              v-model="position.price" @keydown="errors.clearPos(index,'price')">
          <p class="help is-danger" v-text="errors.getPos(index,'price')"></p>
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
    props: ['suppliers', 'previous'],
    data() {
      return {
        supplierSelection: JSON.parse(this.suppliers),
        supplier: '',
        description: '',
        pos: [],
        previousLink: this.previous,
        errors: new Errors()
      }
    },
    created() {
      this.addLine();
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
      onSubmit() {
        axios.post('/orders', {
          supplier: this.supplier,
          description: this.description,
          pos: this.pos
        })
        .then(response => window.location = `/orders/${response.data}`)
        .catch(error => this.errors.record(error.response.data));
      }
    },
  }
</script>
