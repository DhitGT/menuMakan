
    var clickableElements = document.querySelectorAll(".menu-item-head");

    clickableElements.forEach((s) =>{
        s.addEventListener('click',async  ()=>{
            if(s.parentNode.querySelector('.menu-item-bottom').style.display == 'none' || s.parentNode.querySelector('.menu-item-bottom').style.display == ''){
                s.parentNode.querySelector('.menu-item-bottom').style.display = 'block'; 
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '0';
                await sleep(0.1)
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '1';
                
            }else{
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '0'; 
                await sleep(0.1)
                s.parentNode.querySelector('.menu-item-bottom').style.display = 'none'; 
            }
        })
    })
 
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function toggleOff(element){
        document.querySelector(element).style.display = 'none'
    }
    function toggleOn(element){
        document.querySelector(element).style.display = 'block'
    }
