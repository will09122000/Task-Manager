function toggleTheme() {
    var body = document.body
    var newClass = body.className == 'dark' ? 'light' : 'dark'
    var name = body.className == 'dark' ? 'Dark Mode' : 'Light Mode'
    body.className = newClass
    document.cookie = 'theme=' + (newClass == 'dark' ? 'dark' : 'light')
    console.log(document.cookie)
    document.getElementById("name").innerHTML = name;
}
