const bir = document.querySelector(".bir");
const iki = document.querySelector(".iki");
const uc = document.querySelector(".uc");
const dort = document.querySelector(".dort");

bir.onclick=function(){
    bir.classList.add("active",);
    iki.classList.remove("active");
    uc.classList.remove("active");
    dort.classList.remove("active");
    
    document.querySelector(".ybir").style.fontWeight = "bold";
    document.querySelector(".ybir").style.color = "#000";

    document.querySelector(".yiki").style.fontWeight = "normal";
    document.querySelector(".yiki").style.color = "#CCCCCC";

    document.querySelector(".yuc").style.fontWeight = "normal";
    document.querySelector(".yuc").style.color = "#CCCCCC";

    document.querySelector(".ydort").style.fontWeight = "normal";
    document.querySelector(".ydort").style.color = "#CCCCCC";
}
iki.onclick=function(){
    bir.classList.add("active");
    iki.classList.add("active");
    uc.classList.remove("active");
    dort.classList.remove("active");
    document.querySelector(".ybir").style.fontWeight = "bold";
    document.querySelector(".ybir").style.color = "#000";

    document.querySelector(".yiki").style.fontWeight = "bold";
    document.querySelector(".yiki").style.color = "#000";

    document.querySelector(".yuc").style.fontWeight = "normal";
    document.querySelector(".yuc").style.color = "#CCCCCC";

    document.querySelector(".ydort").style.fontWeight = "normal";
    document.querySelector(".ydort").style.color = "#CCCCCC";
}
uc.onclick=function(){
    bir.classList.add("active");
    iki.classList.add("active");
    uc.classList.add("active");
    dort.classList.remove("active");
    document.querySelector(".ybir").style.fontWeight = "bold";
    document.querySelector(".ybir").style.color = "#000";

    document.querySelector(".yiki").style.fontWeight = "bold";
    document.querySelector(".yiki").style.color = "#000";

    document.querySelector(".yuc").style.fontWeight = "bold";
    document.querySelector(".yuc").style.color = "#000";

    document.querySelector(".ydort").style.fontWeight = "normal";
    document.querySelector(".ydort").style.color = "#CCCCCC";
}
dort.onclick=function(){
    bir.classList.add("active");
    iki.classList.add("active");
    uc.classList.add("active");
    dort.classList.add("active");
    document.querySelector(".ybir").style.fontWeight = "bold";
    document.querySelector(".ybir").style.color = "#000";

    document.querySelector(".yiki").style.fontWeight = "bold";
    document.querySelector(".yiki").style.color = "#000";

    document.querySelector(".yuc").style.fontWeight = "bold";
    document.querySelector(".yuc").style.color = "#000";

    document.querySelector(".ydort").style.fontWeight = "bold";
    document.querySelector(".ydort").style.color = "#000";
}