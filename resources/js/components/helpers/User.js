class User {
  constructor(user) {
    this.user          = user
  }

  get() {
    return this.user
  }

  isSuperUser() {
    return !!this.user.isSuperUser
  }
}

export default new User(window.app.user)
