const nav = document.querySelector('.navbar');

console.log('on test');
console.log(nav);

window.addEventListener('scroll', () =>{
    if (window.scrollY > 250)
    {
        nav.classList.remove('dark-mode');
        nav.classList.add('light-mode');
    }
    if (window.scrollY < 249)
    {
        nav.classList.remove('light-mode');
        nav.classList.add('dark-mode');
    }
})