var carousel=document.querySelector(".carousel");
var cells=document.querySelectorAll(".carousel_cell")

var selectedindex=0;
var selectedindex2=0;

const rotatefn='rotateY'
const rotatefn2='rotateX'
const theta2=60;


function rotatecarousel(){
    var angle=theta2* selectedindex* -1;
    carousel.style.transform='translateZ(-288px) ' + 
    rotatefn + '(' + angle + 'deg)';
}

 const prevbutton=document.getElementById("previous_button");

 prevbutton.addEventListener('click',function(){
    selectedindex--;
    rotatecarousel();
    selectedindex2--;
    rotatecarousel2();

 })

 const nextbutton=document.getElementById("next_button");

 nextbutton.addEventListener('click',function(){
    selectedindex++;
    rotatecarousel();
    selectedindex2++;
    rotatecarousel2();
 })

var carousel2=document.querySelector(".carousel2");
carousel2.addEventListener('wheel',function(e){
    if(e.deltaY>0){
    selectedindex2++;
    rotatecarousel2();
    selectedindex++;
    rotatecarousel()}

    else if(e.deltaY<0){
    selectedindex2--;
    rotatecarousel2();
    selectedindex--;
    rotatecarousel()
}
})

function rotatecarousel2(){
    var angle=theta2* selectedindex2* -1;
    carousel2.style.transform='translateZ(-288px) ' + 
    rotatefn2 + '(' + angle + 'deg)';
}

var startbutton=document.querySelectorAll('.startbutton');

startbutton.forEach(element => {
    element.addEventListener('click',(e)=>{
        e.preventDefault();
        element.classList.add("animate");
    
        setTimeout(() => {
            element.classList.remove("animate");
        }, 600);
    })
});




