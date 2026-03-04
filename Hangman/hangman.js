
const basic={
    donechar: " "
};
let selectors={
    
};

let audiosrc={
    start_game:"./Hangman/Audio/game-start.mp3",
    correct: "./Hangman/Audio/correct-choice.mp3",
    win: "./Hangman/Audio/win.mp3",
    wrong: "./Hangman/Audio/wrong-choice.mp3",
    loss: "./Hangman/Audio/loss.mp3"
}

let imagesrc={
    start:"",
}

var character,score=0;
let current_audio=new Audio()

function startgame(){
    selectors.score=document.querySelector(".score")
    selectors.main_display= document.querySelector('.main-display')
    selectors.win_display= document.querySelector(".win-display")
    selectors.loss_display= document.querySelector(".loss-display")
    selectors.create=document.querySelector('.play_area')
    selectors.hangman=document.querySelector('#hangman')
    selectors.form=document.querySelector('#form_score')
    reset(false)
    selectors.win_display.style.display="none"
    selectors.main_display.style.display="flex"
    start()

}

function start(){
    
    basic.right=0;basic.wrong=0
    var words=["paleontology","vase","nebulous","entomolgy","onomatopoia","selenocentric","smilingbuddha","vaticancity","madurai"]
    var hint=["STUDY OF FOSSIL","HOUSEHOLD ITEMS","ADJ: UNCLEAR,HAZY","STUDY OF INSECTS","LITERARY DEVICE","PERSPECTIVE CENTERED ON MOON","FIRST POKHRAN TEST","SMALLEST COUNTRY",
"ATHENS OF EAST"]
    var pos=(Math.floor(Math.random()*100)+1)%words.length
    basic.word=words[pos]
    basic.len=basic.word.length
    console.log(words)
    console.log(hint)
    console.log(basic)
    console.log(selectors)
    for(var i=0;i<basic.len;i++){
        var field=document.createElement('input');
        field.type="text"
        field.class="field1"
        field.disabled="true"
        field.value=" "
        selectors.create.appendChild(field)
    }
    document.querySelector('.desc').innerHTML=hint[pos]
    current_audio.src=audiosrc.start_game
    current_audio.play() 
    
}

function check(character){
    
    if((basic.donechar).indexOf(character)===-1){
        basic.donechar+=character
        if((basic.word).indexOf(character)===-1)
            wrong(character)
        else
            right(character)
    }
    console.log(basic)
}

function right(character){
    current_audio.src=audiosrc.correct
    current_audio.play()
    for(let i=0;i<basic.len;i++){      
        console.log(i) 
        if(basic.word[i]===character){
            basic.right++;
            selectors.create.childNodes[i].value=character.toUpperCase();
        }
    }
    
    if(basic.right===basic.len){
        setTimeout(()=>{
            current_audio.src=audiosrc.win
            current_audio.play()
            score+=50
            console.log(score)
            setTimeout(()=>{reset(false)},3100)
        },1000)        
    }
    
}

function wrong(character){
    basic.wrong++
    console.log("Wrong: "+basic.wrong)
    current_audio.src=audiosrc.wrong
    current_audio.play()
    var change_img="#img_"+character
    var img=document.querySelector(change_img)
    img.src="./Hangman/Images/wrong.svg"
    var button=document.querySelector('#'+character)
    button.style.display="none"
    img.style.display="block"
    selectors.hangman.src="./Hangman/Images/hangman"+basic.wrong+".png"
    if(basic.wrong===6){
        current_audio.src=audiosrc.loss
        current_audio.play()
        setTimeout(reset(true),3000)
    }
    
}

let loss
function reset(loss){
    var create=document.getElementsByClassName('play_area')[0]
    while(create.hasChildNodes()){
        create.removeChild(create.firstChild)
    }
    for(let character of basic.donechar){
        if(basic.donechar===" ") break
        var change_img="#img_"+character
        var img=document.querySelector(change_img)
        img.src=""
        var button=document.querySelector('#'+character)
        button.style.display="block"
        img.style.display="none"
    }
    basic.donechar=""
    if(loss){
        score=0
    }
    selectors.score.innerHTML="SCORE: "+score
    selectors.form.value=Math.max(score,selectors.form.value)
    selectors.hangman.src="./Hangman/Images/hangman0.png"
    selectors.main_display.style.display="none"
    selectors.win_display.style.display="flex"

}

document.addEventListener('keydown',(event)=>{
    if(event.key>='a' && event.key<='z')
        check(event.key);
});

