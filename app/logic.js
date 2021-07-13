function generateUserame() {
    let result = "";
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let charactersLength = characters.length;
    result = characters.charAt(Math.floor(Math.random() *  charactersLength));
    characters = "0123456789";
    charactersLength = characters.length;
    for(let i = 0; i < 5; i++){
        result += characters.charAt(Math.floor(Math.random() *  charactersLength));
    }
    
    document.getElementById("username").textContent = result;
}

function login() {
    let username = document.getElementById("username").textContent;
    window.alert(username);
    window.open("http://127.0.0.1:5500/index.html");
    window.close();
}

// function changeColor(user) {
//     user.style.background='#000000'
// }