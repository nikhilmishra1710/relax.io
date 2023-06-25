
const appContainer = document.querySelector('.app-container');
const clearButton = document.querySelector('.clear');
const rgbButton = document.querySelector('.rgb-color');
const eraserButton = document.querySelector('.eraser');
let rgbColor = false;
let eraser = false;
let innerDivs;


function makeDivs(gridNum = 16) {
    let totalDivs = gridNum * gridNum;
    appContainer.style.gridTemplateColumns = `repeat(${gridNum}, auto)`;
    appContainer.style.gridTemplateRows = `repeat(${gridNum}, auto)`;
    for (let i = 1; i <= totalDivs; i++) {
        let div = document.createElement('div');
        div.addEventListener('mouseover', changeBackground);
        appContainer.appendChild(div);
    }
}

function clearDivs() {
    let appContainerDivs = appContainer.querySelectorAll('div');
    appContainerDivs = Array.from(appContainerDivs);
    appContainerDivs.forEach(div => {
        appContainer.removeChild(div);
    })
}

function changeBackground(e) {

    if(rgbColor) {
        let red = Math.floor(Math.random() * 256);
        let green = Math.floor(Math.random() * 256);
        let blue = Math.floor(Math.random() * 256);
        let color = `rgb(${red}, ${green}, ${blue})`;
        e.target.style.backgroundColor = color;
        return;
    }

    if (eraser) {
        e.target.style.backgroundColor = 'white';
        return;
    }

    e.target.style.backgroundColor = 'black';
}

makeDivs();

rgbButton.addEventListener('click', () => {
    rgbColor = true;
    eraser = false;
});

eraserButton.addEventListener('click', () => {
    eraser = true;
    rgbColor = false;
})

clearButton.addEventListener('click', () => {
    const sketchDivs = appContainer.querySelectorAll('div');
    sketchDivs.forEach(sketchDiv => {
        sketchDiv.style.backgroundColor = "white";
    })
     clearDivs();  makeDivs();

});