
    var clickableElements = document.querySelectorAll(".menu-item-head");

    clickableElements.forEach((s) =>{
        s.addEventListener('click',async  ()=>{
            if(s.parentNode.querySelector('.menu-item-bottom').style.display == 'none' || s.parentNode.querySelector('.menu-item-bottom').style.display == ''){
                s.parentNode.querySelector('.menu-item-bottom').style.display = 'block'; 
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '0';
                s.parentNode.style.width = '100%';
                s.parentNode.style.fontSize = '30px';
                s.parentNode.querySelector('.menu-item-head').style.minHeight = '190px'
                s.parentNode.querySelector('.gradient').style.minHeight = '190px'
                await sleep(0.1)
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '1';
                
            }else{
                s.parentNode.querySelector('.menu-item-bottom').style.opacity = '0'; 
                s.parentNode.style.width = '45%'
                s.parentNode.style.fontSize = '10px';
                s.parentNode.querySelector('.menu-item-head').style.minHeight = '130px'
                s.parentNode.querySelector('.gradient').style.minHeight = '130px'
                s.parentNode.querySelector('.menu-item-bottom').style.display = 'none'; 
            }

        })
    })
 
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


