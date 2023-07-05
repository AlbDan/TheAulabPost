/* Realizzato da Alberto D'Antuono */

const filtSelCst = document.querySelector('.filt-sel-cst');
const containerListCst = document.querySelector('.container-list-cst');
const ArtByNewest = document.querySelector('#ArtByNewest');
const ArtByOldest = document.querySelector('#ArtByOldest');
const recoveryCodeWrapper = document.querySelector('#recoveryCodeWrapper');
const authCodeWrapper = document.querySelector('#authCodeWrapper');
const authChWrapper = document.querySelector('#authChWrapper');
const recoveryChWrapper = document.querySelector('#recoveryChWrapper');
const articlePreviewWrapper = Array.from(document.querySelectorAll('[data-artP]'));
const tagsWrapper = Array.from(document.querySelectorAll('.tagsWrapper'));
const titleWrapper = document.querySelectorAll('.titleWrapper');
const subtitleWrapper = document.querySelectorAll('.subtitleWrapper');
const tableWrapper = document.querySelectorAll('.tableWrapper');
const cardTopBg = document.querySelector('.card-top-bg');
const articleHomeWrapper = document.querySelectorAll('.articleHomeWrapper');
const newsDescWrapper = document.querySelector('.newsDescWrapper');
const headWelcome = document.querySelector('.head-welcome');
const nav = document.querySelector('nav');
const articleWrapper = document.querySelectorAll('.articleWrapper');
const articleShowWrapper = document.querySelector('.articleShowWrapper');
const formWrapper = document.querySelector('.formWrapper');
const myProfileWrapper = document.querySelector('.myprofile-wrapper');
const formWrapperArticle = document.querySelector('.formWrapper-article')
const tfaWrapper = document.querySelector('.tfaWrapper');

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
        authChWrapper.classList.remove('visible');
        authChWrapper.classList.add('invisible');
        setTimeout(() => {
            authChWrapper.classList.remove('d-block');
            authChWrapper.classList.add('d-none');
            recoveryChWrapper.classList.remove('d-none');
            recoveryChWrapper.classList.add('d-block');
        }, 400);
        setTimeout(() => {
            recoveryChWrapper.classList.remove('invisible');
            recoveryChWrapper.classList.add('visible');
        }, 800);
    })
}

if (authCodeWrapper) {
    authCodeWrapper.addEventListener('click', ()=>{
        recoveryChWrapper.classList.remove('visible');
        recoveryChWrapper.classList.add('invisible');
        setTimeout(() => {
            authChWrapper.classList.remove('d-none');
            authChWrapper.classList.add('d-block');
            recoveryChWrapper.classList.remove('d-block');
            recoveryChWrapper.classList.add('d-none');     
        }, 400);
        setTimeout(() => {
            authChWrapper.classList.remove('invisible');
            authChWrapper.classList.add('visible');
        }, 800);
    })
}

if (articlePreviewWrapper) {
    
    window.addEventListener("load", ()=>{
        stringSynth(titleWrapper, textH3, 42);
        stringSynth(subtitleWrapper, textH4, 42);
        tagsWrap ();
        reArrange()
        
    })
    window.addEventListener("resize", ()=>{
        stringSynth(titleWrapper, textH3, 42);
        stringSynth(subtitleWrapper, textH4, 42);
        tagsWrap ();
        reArrange()
    });
    
    let textH3 = [];
    for (let i = 0; i < titleWrapper.length; i++) {
        textH3[i] = titleWrapper[i].children[0].innerText;        
    }
    
    let textH4 = [];
    for (let i = 0; i < subtitleWrapper.length; i++) {
        textH4[i] = subtitleWrapper[i].children[0].innerText;        
    }
    
    for (let i = 0; i < tagsWrapper.length; i++) {
        if (tagsWrapper[i].children[0].children[tagsWrapper[i].children[0].children.length-1]) {
            tagsWrapper[i].children[0].children[tagsWrapper[i].children[0].children.length-1].remove();
        } 
    }
    
    function reArrange() {
        if (window.innerWidth<992) {
            for (let i = 0; i < articlePreviewWrapper.length; i++) {      
                if (articlePreviewWrapper[i].children[1].classList.contains("cst-art-bg")) 
                articlePreviewWrapper[i].insertBefore(articlePreviewWrapper[i].children[1], articlePreviewWrapper[i].firstChild);
                articlePreviewWrapper[i].classList.add('flex-column', 'align-items-center', 'mt-3');
                articlePreviewWrapper[i].classList.remove('justify-content-center', "my-3");
                articlePreviewWrapper[i].children[1].classList.remove("c-me");
                articlePreviewWrapper[i].children[0].classList.remove("c-ms");
                articlePreviewWrapper[i].parentElement.children[3].classList.remove("mt-3");
            }
        } else {
            for (let i = 0; i < articlePreviewWrapper.length; i++) {
                if (articlePreviewWrapper[i].children[0].classList.contains("cst-art-bg")) 
                articlePreviewWrapper[i].insertBefore(articlePreviewWrapper[i].children[1], articlePreviewWrapper[i].firstChild);
                articlePreviewWrapper[i].classList.remove('flex-column', 'align-items-center', 'mt-3');
                articlePreviewWrapper[i].classList.add('justify-content-center', "my-3");
                articlePreviewWrapper[i].children[0].classList.add("c-me");
                articlePreviewWrapper[i].children[1].classList.add("c-ms");
                articlePreviewWrapper[i].parentElement.children[3].classList.add("mt-3");
            }
        }
    }
    
    function stringSynth(stringWrapper, text, stringHeight) {
        for (let i = 0; i < stringWrapper.length; i++) {
            stringWrapper[i].children[0].innerText = text[i];
            while (stringWrapper[i].scrollHeight > stringHeight) {
                stringWrapper[i].children[0].innerText = stringWrapper[i].children[0].innerText.slice(0, -4) + "...";
            }
        }
    }
    
    function tagsWrap () {
        for (let i = 0; i < tagsWrapper.length; i++) {
            switch (true) {
                case window.innerWidth>=1400:
                tagsWrapper[i].style.width = "293px";
                break;
                case window.innerWidth<1400 && window.innerWidth>=1200:
                tagsWrapper[i].style.width = "248px";
                break;
                case window.innerWidth<1200 && window.innerWidth>=992:
                tagsWrapper[i].style.width = "203px";
                break;
                case window.innerWidth<992 && window.innerWidth>=370:
                tagsWrapper[i].style.width = "315px";
                break;
                case window.innerWidth<370:
                tagsWrapper[i].style.width = "200px";
                break;
                default:
                break;
            } 
        }
    }
}


if (cardTopBg) {
    window.addEventListener('load', ()=>{
        cardTopBg.style.height = `${cardTopBg.getBoundingClientRect().width*0.67375}px`;
    });
    window.addEventListener('resize', ()=>{
        cardTopBg.style.height = `${cardTopBg.getBoundingClientRect().width*0.67375}px`;
    });
}

if (articleHomeWrapper.length!=0) {
    nav.classList.add('navLoad','nav-loading'); 
    let addtime = 0;
    if (articleHomeWrapper.length<5) {
        for (let i = 0; i < articleHomeWrapper.length; i++) {
            articleHomeWrapper[i].classList.add(`home-art-${i}`)
        }
    }
    
    for (let i = 0; i < articleHomeWrapper.length/2; i++) {
        setTimeout(() => {
            articleHomeWrapper[i].classList.remove("article-loading");
            articleHomeWrapper[i].classList.add("article-loaded");
        }, 100+addtime);
        addtime+=100;
    }
    for (let i = articleHomeWrapper.length-1; i >= articleHomeWrapper.length/2; i--) {
        setTimeout(() => {
            articleHomeWrapper[i].classList.remove("article-loading");
            articleHomeWrapper[i].classList.add("article-loaded");
        }, 100+addtime);
        addtime+=100;
    }
    
    if (headWelcome) {
        setTimeout(() => {
            headWelcome.classList.remove("head-loading");
            headWelcome.classList.add("head-loaded");
        }, 800+addtime);
    }
    
    if (newsDescWrapper) {
        setTimeout(() => {
            newsDescWrapper.classList.remove("newsDesc-loading");
            newsDescWrapper.classList.add("newsDesc-loaded");
        }, 1600+addtime);
    }
    
    setTimeout(() => {
        nav.classList.remove("nav-loading");
        nav.classList.add("nav-loaded");
    }, 800+addtime); 
    
} else {
    
    if (headWelcome) {
        setTimeout(() => {
            headWelcome.classList.remove("head-loading");
            headWelcome.classList.add("head-loaded");
        }, 800);
    }
    
}

if (articleWrapper) {
    let addtime = 0;
    for (let i = 0; i < articleWrapper.length; i++) {
        setTimeout(() => {
            articleWrapper[i].classList.remove("article-loading");
            articleWrapper[i].classList.add("article-loaded");
        }, 100+addtime);
        addtime+=100;
    }
}

if (articleShowWrapper) {
    articleShowWrapper.classList.remove("article-loading");
    articleShowWrapper.classList.add("article-loaded");
}

if (formWrapper) {
    formWrapper.classList.remove("form-loading");
    formWrapper.classList.add("form-loaded");
}

if (myProfileWrapper) {
    myProfileWrapper.classList.remove("form-loading");
    myProfileWrapper.classList.add("form-loaded");
    window.addEventListener('load', ()=>{
        myProfileWrapperRS ();
    })
    window.addEventListener('resize', ()=>{
        myProfileWrapperRS ();
    })
    
    function myProfileWrapperRS () {
        if (window.innerWidth<=1100) {
            myProfileWrapper.style.width = "86.37%";
        } else {
            myProfileWrapper.style.width = "950px";
        }    
    }
}

if (formWrapperArticle) {
    formWrapperArticle.classList.remove("form-loading");
    formWrapperArticle.classList.add("form-loaded");
}

if (tfaWrapper) {
    if (tfaWrapper.querySelector('form').classList.contains('deactivated')) {
        tfaWrapper.classList.remove('tfa-cst');
        tfaWrapper.classList.add('tfa-d-cst');
    } else {
        tfaWrapper.classList.remove('tfa-d-cst');
        tfaWrapper.classList.add('tfa-cst');
    }
}