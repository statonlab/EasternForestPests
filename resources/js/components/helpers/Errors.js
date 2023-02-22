export default class Errors {
  constructor(data) {
    this.errors = {}

    if (typeof data !== 'undefined') {
      this.set(data)
    }
  }

  get(field) {
    if (this.errors[field]) {
      if (typeof this.errors[field] === 'string') {
        return this.errors[field]
      }
      return this.errors[field][0]
    }
  }

  first(field) {
    return this.get(field)
  }

  set(errors) {
    this.errors = errors.errors
  }

  reset() {
    this.errors = {}
  }

  clear(field) {
    if (this.errors[field]) {
      delete this.errors[field]
    }
  }

  has(field) {
    return this.errors.hasOwnProperty(field)
  }

  any() {
    return Object.keys(this.errors).length > 0
  }

  all() {
    return this.errors
  }

  toArray() {
    const all = []

    Object.keys(this.errors).map(key => {
      this.errors[key].map(error => {
        all.push(error)
      })
    })

    return all
  }
}
