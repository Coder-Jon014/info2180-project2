"use strict";

window.onload = function() {
    fetchDashboard();
    sideBar();
}


function sideBar(){

    var home = document.getElementById("home-btn")
    var adduser = document.getElementById("add-user-btn")
    var newissue = document.getElementById("new-issue-btn")
    var resultdiv = document.getElementById("result-div")



    home.addEventListener("click", async function(e){
        e.target.preventDefault;

        fetchDashboard()



        // var url = "home.php"

        // await fetch(url)
        //     .then(async response =>{
        //         if(response.ok){
        //             let page = await response.text()
        //             resultdiv.innerHTML = " "+page;
        //             // filters();

        //             return;
        //         }else{
        //             return Promise.reject("Response was not 200")
        //         }
        //     })
        //     .catch(error => {
		// 		console.log("An error occured with the connection. Error is : "+ error)
		// 	})
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


function filters(){

    var allFilter = document.getElementById("all")
    var openFilter = document.getElementById("openI")
    var ticketFilter = document.getElementById("ticket")
    var main_area = document.getElementById("result-div")
    console.log(allFilter)

    allFilter.addEventListener("click", async function(e){
        var url = "home.php?filter=all";


        console.log("Clicked all")

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data;
                    filters()
                    // Testing for output
                    console.log("Table should update")
                    return
                }else{
                    console.log("The response was not ok: code !200")
                    return
                }
            })
            .catch(error=>{
                console.log("An error occured : "+error)
                return
            })
    })

    openFilter.addEventListener("click", async function(e){
        var url = "home.php?filter=open";

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data;
                    filters()
                    // Testing for output
                    console.log("Table should update")
                    return
                }else{
                    console.log("The response was not ok: code !200")
                    return
                }
            })
            .catch(error=>{
                console.log("An error occured : "+error)
                return
            })
    })

    ticketFilter.addEventListener("click", async function(e){
        var url = "home.php?filter=myticket";

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data;
                    filters()

                    // Testing for output
                    console.log("Table should update")
                    return
                }else{
                    console.log("The response was not ok: code !200")
                    return
                }
            })
            .catch(error=>{
                console.log("An error occured : "+error)
                return
            })
    })

}

async function fetchDashboard(){
    var url = "home.php"

    await fetch(url)
        .then(async response=>{
            if(response.ok){
                let table_data = await response.text()
                var result = document.getElementById("result-div")
                result.innerHTML = ""+table_data;
                console.log("Table should update : FetchDashboard Function")
                return
            }else{
                console.log("The response was not ok: code !200")
                return
            }
        })
        .catch(error=>{
            console.log("An error occured : "+error)
            return
        })

    filters();
}