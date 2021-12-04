"use strict";

window.onload = function() {
    filters();
}


function filters(){

    var allFilter = document.getElementById("all")
    var openFilter = document.getElementById("openI")
    var ticketFilter = document.getElementById("ticket")
    var main_area= document.getElementById("result-div")
    var result = document.getElementById("result")

    allFilter.addEventListener("click", async function(e){
        var url = "home.php?filter=all";
        

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data
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

    openFilter.addEventListener("onclick", async function(e){
        var url = "home.php?filter=open";

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    result.innerHTML = ""+table_data;
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