const searchUser = document.querySelector('#searchUser')

if (searchUser) {
  console.log('searchUser exists')
    searchUser.addEventListener('input', async function() {
    const search_by_response = document.getElementById("searchUserBy")

    const search_by = search_by_response.options[search_by_response.selectedIndex].text
    const response = await fetch('../api/api_user.php?search=' + this.value + '&search_by=' + search_by)
    const Users = await response.json()

    const section = document.querySelector('#Users')
    section.innerHTML = ''

    for (const User of Users) {
      const response = await fetch('../api/api_department.php?user_id=' + User.id)
      const departements = await response.json()
      const section1 = document.createElement('section')
      section1.id = 'User'
      const username = document.createElement('div')
      username.className = 'usernameClient'
      username.textContent = User.username
      const name = document.createElement('div')
      name.className = 'nameClient'
      name.textContent = User.name
      const type = document.createElement('div')
      type.className = 'typeClient'
      type.textContent = User.type

      section1.appendChild(username)
      section1.appendChild(name)
      section1.appendChild(type)
      const lista = document.createElement('ul')
      for(const departement of departements){
        const topico = document.createElement('li')
        topico.textContent = departement.name
        lista.appendChild(topico)
      }
      section1.appendChild(lista)
      section.appendChild(section1)
    }
  })
}