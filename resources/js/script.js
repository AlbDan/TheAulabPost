const filtSelCst = document.querySelector('.filt-sel-cst');
const containerListCst = document.querySelector('.container-list-cst');
const ArtByNewest = document.querySelector('#ArtByNewest');
const ArtByOldest = document.querySelector('#ArtByOldest');
const recoveryCodeWrapper = document.querySelector('#recoveryCodeWrapper');
const authCodeWrapper = document.querySelector('#authCodeWrapper');
const authChWrapper = document.querySelector('#authChWrapper');
const recoveryChWrapper = document.querySelector('#recoveryChWrapper');
//containerListCst.style.height = `${containerListCst.querySelector("ul").getBoundingClientRect().height+20}px`;

if (filtSelCst && containerListCst) {
    filtSelCst.addEventListener('click', ()=>{
        containerListCst.style.top = "80px";
        containerListCst.style.opacity = "1";
        filtSelCst.style.opacity = .5;
    })
}

if (filtSelCst && containerListCst) {
    document.addEventListener('click', (e)=>{
        if (!e.target.closest(".container-list-cst") && e.target!=filtSelCst) {
            containerListCst.style.top = "0px";
            containerListCst.style.opacity = "0";
            filtSelCst.style.opacity = 1;
        }
    }) 
}

switch (true) {
    case window.location.href.includes('by-newest'):
    filtSelCst.innerText = ArtByNewest.innerText;
    break;
    case window.location.href.includes('by-oldest'):
    filtSelCst.innerText = ArtByOldest.innerText;
    break;
    default:
    break;
}

if (recoveryCodeWrapper) {
    recoveryCodeWrapper.addEventListener('click', ()=>{
        authChWrapper.classList.remove('d-block');
        authChWrapper.classList.add('d-none');
        recoveryChWrapper.classList.remove('d-none');
        recoveryChWrapper.classList.add('d-block');
    })
}

if (authCodeWrapper) {
    authCodeWrapper.addEventListener('click', ()=>{
        authChWrapper.classList.remove('d-none');
        authChWrapper.classList.add('d-block');
        recoveryChWrapper.classList.remove('d-block');
        recoveryChWrapper.classList.add('d-none');
    })
}