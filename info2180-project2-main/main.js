"use strict";

window.onload = function() {
    test();
}


function test(){

    var home = document.getElementById("home-btn")
    var adduser = document.getElementById("add-user-btn")
    var newissue = document.getElementById("new-issue-btn")
    var resultdiv = document.getElementById("result-div")



    home.addEventListener("click", async function(e){
        e.target.preventDefault;

        var url = "home.php"

        await fetch(url)
            .then(async response =>{
                if(response.ok){
                    let page = await response.text()
                    resultdiv.innerHTML = ""+page;
                    return;
                }else{
                    return Promise.reject("Response was not 200")
                }
            })
            .catch(error => {
				console.log("An error occured with the connection. Error is : "+ error)
			})
    })

    adduser.addEventListener("click", async function(e){
        e.target.preventDefault;

        var url = "userCreation.php"

        await fetch(url)
            .then(async response =>{
                if(response.ok){
                    let page = await response.text()
                    resultdiv.innerHTML = ""+page;
                    return;
                }else{
                    return Promise.reject("Response was not 200")
                }
            })
            .catch(error => {
				console.log("An error occured with the connection. Error is : "+ error)
			})
    })

    newissue.addEventListener("click", async function(e){
        e.target.preventDefault;

        var url = "issueCreation.php?"

        await fetch(url)
            .then(async response =>{
                if(response.ok){
                    let page = await response.text()
                    resultdiv.innerHTML = ""+page;
                    return;
                }else{
                    return Promise.reject("Response was not 200")
                }
            })
            .catch(error => {
				console.log("An error occured with the connection. Error is : "+ error)
			})
    })

   







    var logout = document.getElementById("logout-btn")
    var page = document.getElementsByTagName("BODY")

    logout.addEventListener("click", function(e){
        e.target.preventDefault;

        page[0].innerHTML = "<p>You have been logged out successfully</p>";
        alert("You have been logged out successfully");
    })
}