export default class Errors {
  constructor() {
    this.errors = {};
  }

  clear(field) {
    delete this.errors[field];
  }

  clearPos(id, field) {
    let posField = `pos.${id}.${field}`;
    delete this.errors[posField];
  }

  clearPosCurrent(id, field) {
    let posField = `posCurrent.${id}.${field}`;
    delete this.errors[posField];
  }

  get(field) {
    if (this.errors[field]) {
      return this.errors[field][0];
    }
  }

  getPos(id, field) {
    let posField = `pos.${id}.${field}`;
    if (this.errors[posField]) {
      return this.errors[posField][0];
    }
  }

  getPosCurrent(id, field) {
    let posField = `posCurrent.${id}.${field}`;
    if (this.errors[posField]) {
      return this.errors[posField][0];
    }
  }

  record(errors) {
    this.errors = errors.errors;
  }
}
