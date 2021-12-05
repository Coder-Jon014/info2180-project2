"use strict";

window.onload = function() {

    fetchDashboard();
    sideBar();
}

// This is the functions for all sidebar buttons
function sideBar(){
    // getting and storing sidebar buttons inside variables to add event listeners to
    var home = document.getElementById("home-btn")
    var adduser = document.getElementById("add-user-btn")
    var newissue = document.getElementById("new-issue-btn")
    var resultdiv = document.getElementById("result-div")



    home.addEventListener("click", async function(e){
        e.target.preventDefault;

        fetchDashboard()
        
    })

    adduser.addEventListener("click", async function(e){
        e.target.preventDefault;

        var url = "userCreation.php"

        await fetch(url)
            .then(async response =>{
                if(response.ok){
                    let page = await response.text()
                    resultdiv.innerHTML = ""+page;
                    addUserFunc();
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

        var url = "issueCreation.php?context=getNames"

        await fetch(url)
            .then(async response =>{
                if(response.ok){
                    let page = await response.text()
                    resultdiv.innerHTML = " "+page;
                    createIssue();
                    return;
                }else{
                    return Promise.reject("Response was not 200")
                }
            })
            .catch(error => {
				console.log("An error occured with the connection. Error is : "+ error)
			})
    })

    
    // should be changed to reflect session destroyed and returned login screen

    var logout = document.getElementById("logout-btn")

    logout.addEventListener("click", async function(e){
        e.preventDefault();

        var url = "logoutfile.php"
        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    alert("You have been logged out successfully");
                    return
                }else{
                    console.log("Response was not 200")
                    return
                }
            })

            .catch(error=>{
                console.log("There was an error : "+error)
            })
    })
}

// This function is to add event listeners to filter buttons in dashboard in home screen so that tables
// can reflect the data based on the filters
function filters(){

    var allFilter = document.getElementById("all")
    var openFilter = document.getElementById("openI")
    var ticketFilter = document.getElementById("ticket")
    var main_area = document.getElementById("result-div")
    // console.log(allFilter)

    allFilter.addEventListener("click", async function(e){
        var url = "home.php?filter=all";

        


        // console.log("Clicked all")

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data;
                    // Functions called back to ensure events can oocur in any situation
                    // example: when all and open are clicked one after the other, sometimes create new issue btn 
                    // does not click, this fixes that by calling back the function
                    // Anywhere these function are called back below is for this very same reason
                    filters()
                    newIssueDashboard()
                    colorStatus()
                    bugDetails()
                    // allFilter.classList.add("clicked")
                    // openFilter.classList.remove("clicked")
                    // ticketFilter.classList.remove("clicked")


                    // Testing for output
                    // console.log("Table should update")
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
                    newIssueDashboard()
                    colorStatus()
                    bugDetails()

                    // allFilter.classList.remove("clicked")
                    // openFilter.classList.add("clicked")
                    // ticketFilter.classList.remove("clicked")
                    // Testing for output
                    // console.log("Table should update")
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
        var url = "home.php?filter=my-ticket";

        

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let table_data = await response.text()
                    main_area.innerHTML = ""+table_data;
                    filters()
                    newIssueDashboard()
                    colorStatus()
                    bugDetails()


                    // allFilter.classList.remove("clicked")
                    // openFilter.classList.remove("clicked")
                    // ticketFilter.classList.add("clicked")
                    // Testing for output
                    // console.log("Table should update")
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
// This function is used to give the create new issue button on the home screen dashboard an event so that
// it can automatically click and go the the new issue page
function newIssueDashboard(){
    var issue_btn = document.getElementById("issue")
    var newissue = document.getElementById("new-issue-btn")

    issue_btn.addEventListener("click", function(e){
        e.preventDefault();
        newissue.click();
        newIssueDashboard();
    })
}

// This function is used to fecth the dashboard with the table at the beginning of the program when the window is loading
// Also used as a substitube function to avoid rewriting fetch api 
async function fetchDashboard(){
    var url = "home.php"

    await fetch(url)
        .then(async response=>{
            if(response.ok){
                let table_data = await response.text()
                var result = document.getElementById("result-div")
                result.innerHTML = ""+table_data;
                // Testing
                // console.log("Table should update : FetchDashboard Function")
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
    // Calling back functions to ensure that they are working in every possible way ^^ see top of function
    // for details
    filters();
    newIssueDashboard();
    colorStatus();
    bugDetails();
    
}

function colorStatus(){
    var table = document.getElementById("ISSUES-TABLE").childElementCount
    // testing output
    // console.log(table)
    for(let x=0; x<table; x++){
        var status_row = document.getElementsByClassName("status-row")
        //testing output
        // console.log(status_row[x].firstChild.innerHTML)
        if(status_row[x].firstChild.innerHTML == "open"){
            status_row[x].firstChild.classList.add("open")
        }
        
        if(status_row[x].firstChild.innerHTML == "closed"){
            status_row[x].firstChild.classList.add("closed")
        }

        if(status_row[x].firstChild.innerHTML == "in progress"){
            status_row[x].firstChild.classList.add("in-progress")
        }
    }
}

function addUserFunc(){
    let fname = document.getElementById('fname');
    let lname = document.getElementById('lname');
    let password = document.getElementById('password');
    let email = document.getElementById('email');
    let submit = document.getElementById('searchbtn');
    let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[a-zA-Z0-9]).{8,}$/;

    submit.addEventListener('click',function(event){
        event.preventDefault();
        
        let firstname = fname.value;
        let lastname = lname.value;
        let pass = password.value;
        let mail = email.value;
        var request = new XMLHttpRequest();
        if(regex.test(pass)){  
            request.open("GET","api.php?context=newUser&fname=" + firstname + "&lname=" + lastname + "&email=" + mail + "&password=" + pass,true);
            request.send();
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    alert("User added.");
                    fname.value = '';
                    lname.value = '';
                    password.value = '';
                    email.value = '';
                }
            }
        }else{
            alert("Password must contain one letter, one number, one capital letter and consist of 8 characters");
        }
    })
}

function createIssue(){
    let container = document.getElementById("assignContainer");

    let title = document.getElementById("title");
    let description = document.getElementById("description");
    let bugs = document.getElementById("bugstuff");
    let priority = document.getElementById("prioritystuff");
    let btn = document.getElementById("searchbtn")
    let request = new XMLHttpRequest();
    let assign = document.getElementById("assignstuff");

    // request.open('GET',"./issueCreation.php?context=getNames");
    // request.send();
    // request.onreadystatechange = function (){
    //     if (request.readyState == 4 && request.status == 200) {
    //         container.innerHTML= ""+request.response;
    //     }
    // }

    
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        request.open("GET","./issueCreation.php?context=newIssue&title="+title.value+"&description="+description.value+"&assigned="+assign.value+"&type="+bugs.value+"&priority="+priority.value,true);
        request.send()
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200){
                alert("New Issue Created")
            }
        }
    });
}

var superTitle = "Not Set"


// This function is to give the links inside the table at home issues table an event listener so that they
// can fetch the details of an issue and display them on a screen
function bugDetails(){

    var bugdetails = document.getElementsByClassName("detail-issue")
    var bugdetailscount = document.getElementsByClassName("detail-issue").length
    // Testing output
    // console.log(bugdetailscount)
    // console.log(bugdetails)


    for(let x=0; x < bugdetailscount; x++){

        bugdetails[x].addEventListener("click", async function(e){
            e.preventDefault();
            var title = bugdetails[x].firstChild.textContent
    
            var url = "./bugfile.php?query="+title
    
            await fetch(url)
            .then(async response=>{
                if(response.ok){
                    let data = await response.text()
                    var result = document.getElementById("result-div")
                    result.innerHTML = ""+data;
                    superTitle = title
                    markedAs()
    
    
                    // Testing
                    // console.log("Table should update : FetchDashboard Function")
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

}

function markedAs(){
    var closed = document.getElementById("markclosed")
    var progress = document.getElementById("markinprog")

    // testing output
    // console.log(closed)
    // console.log(progress)

    closed.addEventListener("click", async function(e){
        e.preventDefault();

        var url = "./bugFile.php?update=closed&search="+superTitle

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    alert("Issue updated status to closed")
                    return
                }else{
                    console.log("Response was not 200")
                }
            })
            .catch(error=>{
                console.log("There was error : "+error)
            })
    })

    progress.addEventListener("click", async function(e){
        e.preventDefault();

        var url = "./bugFile.php?update=progress&search="+superTitle

        await fetch(url)
            .then(async response=>{
                if(response.ok){
                    alert("Issue updated status to in progress")
                    return
                }else{
                    console.log("Response was not 200")
                }
            })
            .catch(error=>{
                console.log("There was error : "+error)
            })
    })
}