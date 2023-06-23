const bar = document.querySelector(".fa-bars");
const cross = document.querySelector("#hdcross");
const headerbar = document.querySelector(".headerbar");

// when bar icon (tablet/mobile) clicked it will display the hidden header bar.
bar.addEventListener('click', function()
{
    setTimeout(()=>{
        cross.style.display="block";
    }, 200);
    headerbar.style.right = "0%";
})

// when cross icon (tablet/mobile) clicked it will hide the showing header bar.
cross.addEventListener('click', function(){
    cross.style.display = 'none';
    headerbar.style.right = '-100%';
})