var easy=['😂','🥳','👍','😊','🤣','😁']
var medium=['😱','🫡','🤔','😂','🤣','😁','😀','😅','😎','🥱','😪','😕']
var hard=['🍕','🍔','🍟','🌭','🥞','🎉','🎁','🛺','🚎','🚑','🚘','🌍','🤣','😋','🤗','🏍️','🏎️','🎡','⚾','🎳']
var temp=0

const basic={
    flip: 0,totalflip: 0,start: 0,timevar: 0,win: 0,difficulty: 0,timer: 0,array: 0
}
const selectors={

}
var sound=new Audio()
audiosrc={
    correct: "./Memory game/Audio/correct.mp3",
    win: "./Memory game/Audio/win.mp3"
}
window.onload=()=>{
    selectors.timeupdate=document.querySelector('.time')
    selectors.flipupdate=document.querySelector('.flips')
    selectors.main_display=document.querySelector('.main_display')
    selectors.play_area=document.querySelector('.gameboard')
    selectors.lower=document.getElementsByClassName('lower')[0]
}

function startgame(temp){
    console.log(basic)
    if(temp===1){
        basic.array=shuffle(easy).concat(shuffle(easy))
        selectors.lower.style="grid-template-columns:repeat(4,auto);height: 60vh;width: 40vw;"
    }else if(temp===2){
        basic.array=shuffle(medium).concat(shuffle(medium))
        selectors.lower.style="grid-template-columns:repeat(6,auto);height: 72vh;width: 55vw;"
    }else{
        basic.array=shuffle(hard).concat(shuffle(hard))
        selectors.lower.style="grid-template-columns:repeat(8,auto);height: 90vh;width: 65vw;"
    }
    basic.difficulty=temp
    var card;
    (basic.array).forEach(item=>
        card+="<div class='card'><div class='card-front'></div><div class='card-back'>"+item+"</div></div>"
    )
    selectors.lower.innerHTML=card
    selectors.lower.removeChild(selectors.lower.firstChild)
    selectors.main_display.style.display="none"
    selectors.play_area.style.display="block"
    document.addEventListener('click',event=>{
    
        const trigger=event.target;
        const final=trigger.parentElement;
    
        if(final.className.includes('card')){
            if(!basic.start){
                timer();
                basic.start=1; 
            }               
            flipcard(final);
            basic.totalflip++;
        }else{
            if(!basic.start)
            alert("Click on card to start")
        }
    })
}

function shuffle(array){
    
    let currentIndex = array.length,  randomIndex;
    
    while (currentIndex != 0) {
    
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;

        [array[currentIndex], array[randomIndex]] = [
        array[randomIndex], array[currentIndex]];
    }
    
    return array;
}

function timer(){
    basic.timer=setInterval(()=>{
        basic.timevar++
        selectors.timeupdate.innerHTML="TIME: "+basic.timevar
        selectors.flipupdate.innerHTML="TOTAL FLIPS: "+basic.totalflip
    },1000);
}



const flipcard=card=>{
    basic.flip++;
    if(basic.flip<=2){
        card.classList.add('flipped');
    }
    if(basic.flip===2){
        const selected=document.querySelectorAll('.flipped:not(.matched)');
        if(selected[0].innerHTML===selected[1].innerHTML){
            sound.src=audiosrc.correct
            sound.play()
            selected[0].classList.add('matched');
            selected[1].classList.add('matched');
            basic.win++;
        }
        if(basic.win===basic.array.length/2){
            sound.src=audiosrc.win
            sound.play()
            over();
        }
        setTimeout(()=>{
            document.querySelectorAll('.card.flipped:not(.matched)').forEach(card=>{
            card.classList.add('shake');
        },1600);
        
    })
        setTimeout(()=>{
            reflip();
        },1000);
        basic.flip=0;
    }
}

const reflip=()=>{
    document.querySelectorAll('.card:not(.matched)').forEach(card=>{
        card.classList.remove('flipped');
        card.classList.remove('shake');
    })
}

function over(){
    clearInterval(basic.timer)
    document.querySelector("#timeform").value=basic.timevar
    document.querySelector("#flipform").value=basic.totalflip
    for(var key in basic){
        basic[key]=0
    }
    document.getElementById("form").submit()
    selectors.play_area.style.display='none'
    selectors.main_display.style.display="flex"
    console.log(basic)
    
}