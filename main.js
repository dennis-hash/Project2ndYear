let toggleStatus = false;
//function to tell css to broaden the width of the side bar
let toggleNav = function() {
    console.log("hello");
     let getSidebar = document.querySelector(".sidebar");
     let getSidebarUl = document.querySelector(".sidebar ul");
     let getSidebarTitle = document.querySelector(".sidebar span");
     let getSidebarLinks = document.querySelectorAll(".sidebar a");

    if(toggleStatus === false){
        getSidebarUl.style.visibility = "visible";
        getSidebar.style.width = "160px";

        let arrayLength = getSidebarLinks.length;
        for(var i = 0; i < arrayLength; i++){
            getSidebarLinks[i].style.opacity = "1";
        }
        toggleStatus = true;
    }

    else {
        
        getSidebar.style.width = "60px";
        getSidebarUl.style.visibility = "hidden";

        let arrayLength = getSidebarLinks.length;
        for(var i = 0; i < arrayLength; i++){
            getSidebarLinks[i].style.opacity = "0";
        }
        toggleStatus = false;
    }
}
