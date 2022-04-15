let toggleStatus = false;
//function to tell css to broaden the width of the side bar
let toggleNav = function() {
    
     let getSidebar = document.querySelector(".sidebar");
     let getSidebarUl = document.querySelector(".sidebar ul");
     let getSidebarTitle = document.querySelector(".sidebar span");
     let getSidebarLinks = document.querySelectorAll(".sidebar a");
     let productSection = document.querySelector(".allProducts");


    if(toggleStatus === false){
        getSidebarUl.style.visibility = "visible";
        getSidebar.style.width = "160px";
        productSection.style.width = "calc(100% - 160px)";
        productSection.style.marginLeft = "160px";

        let arrayLength = getSidebarLinks.length;
        for(var i = 0; i < arrayLength; i++){
            getSidebarLinks[i].style.opacity = "1";
        }
        toggleStatus = true;
    }

    else {
        
        getSidebar.style.width = "40px";
        getSidebarUl.style.visibility = "hidden";
        productSection.style.width = "calc(100% - 40px)";
        productSection.style.marginLeft = "40px";

        let arrayLength = getSidebarLinks.length;
        for(var i = 0; i < arrayLength; i++){
            getSidebarLinks[i].style.opacity = "0";
        }
        toggleStatus = false;
    }
}

