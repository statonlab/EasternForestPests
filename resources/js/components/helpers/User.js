class User {
  constructor(user) {
    this.user          = user
  }

  get() {
    return this.user
  }
}

export default new User(window.app.user)
