'use strict';

let doc = document;

// Open Menu
function openMenu(type = '')
{
    // Attribute
    attribute('body', 'set', 'style', 'overflow: hidden');
    attribute('#mainContent,.left-sidebar', 'set', 'style', 'z-index: -2');

    // hide n show
    makeVisibility('.menuHideContent', 'add', 'slideInLeft');
    makeVisibility('.menuHideContent,.menuHide', 'remove', 'hidden');

    // Set timeout
    setTimeout(async () => {
        // Check prop
        if (type !== '' && localStorage.getItem(type) === null)
        {
            // Make request
            await fetch(`index.php?generateMenu=${type}`)
            .then(response => response.text())
            .then(result => { 
                // set up header
                doc.querySelector('#slideMenuTitle').innerHTML = type.replace('-', ' ');
                // parse template
                if (result.length > 0)
                {
                    // inject html
                    doc.querySelector('#slideMenu').innerHTML = parseModuleList(type, result);
                }
            })
        }
        else
        {
            // set from cache
            doc.querySelector('#slideMenuTitle').innerHTML = type.replace('-', ' ');
            doc.querySelector('#slideMenu').innerHTML = parseModuleList(type);
        }

        // set hidden
        makeVisibility('.menuHideContentInner', 'remove', 'hidden');
    
    }, 1000);
}

// parse and caching
const parseModuleList = (type = '', inputResult = '') =>
{
    if (localStorage.getItem(type) === null)
    {
        localStorage.setItem(type, inputResult);
    }

    let result = JSON.parse(localStorage.getItem(type));
    let menu = ``;
    result.forEach((options, index) => {
        if (index === 0)
        {
            menu += `<li class="block">`;
            menu += `<a href="${options.url}" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline ${options.class}" title="${options.title}" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
            </svg>&nbsp
            ${options.label}            
            </a>`;
            menu += `</li>`;
        }
        else
        {
            menu += `<li class="block ${options.class}">`;
            menu += `<a href="${options.url}" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline ${options.class}" title="${options.title}" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">
            <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
            </svg>&nbsp;
            ${options.label}            
            </a>`;
            menu += `</li>`;
        }
    })

    return menu;
}

// Hide Menu
function hideMenu()
{
    makeVisibility('.menuHideContent', 'remove', 'slideInLeft');
    makeVisibility('.menuHideContent', 'add', 'slideOutLeft');
    makeVisibility('.menuHideContentInner', 'remove', 'hidden');

    setTimeout(async () => {
        // make visibility
        makeVisibility('.menuHideContent', 'add', 'slideOutLeft');
        makeVisibility('.menuHideContent,.menuHide', 'add', 'hidden');
        // attribute
        attribute('#mainContent,.left-sidebar,body', 'remove', 'style');
        
    }, 200);
}

function makeVisibility(querySelectors, type, classname)
{
    if (querySelectors.split(',').length > 0)
    {
        switch (type) {
            case 'remove':
                doc.querySelectorAll(querySelectors).forEach((el) => {
                    el.classList.remove(classname);
                })
                break;
        
            default:
                doc.querySelectorAll(querySelectors).forEach((el) => {
                    el.classList.add(classname);
                })
                break;
        }
    }
    else
    {
        switch (type) {
            case 'remove':
                doc.querySelector(querySelectors).classList.remove(classname);
                break;
        
            default:
                doc.querySelector(querySelectors).classList.add(classname);
                break;
        }
    }
}

function attribute(querySelectors, type, attr, value)
{
    if (querySelectors.split(',').length > 0)
    {
        switch (type) {
            case 'remove':
                doc.querySelectorAll(querySelectors).forEach((el) => {
                    el.removeAttribute(attr, value);
                })
                break;
        
            default:
                doc.querySelectorAll(querySelectors).forEach((el) => {
                    el.setAttribute(attr, value);
                })
                break;
        }
    }
    else
    {
        switch (type) {
            case 'remove':
                doc.querySelector(querySelectors).removeAttribute(attr, value);
                break;
        
            default:
                doc.querySelector(querySelectors).setAttribute(attr, value);
                break;
        }
    }
}


function simbioClick(dest)
{
    $('#mainContent').simbioAJAX(`./modules/${dest}`);
}

const searchMenu = (event, obj) => {
    if (obj.value !== '')
    {
        fetch(`index.php?searchMenu=${obj.value}`)
        .then(response => response.json())
        .then(result => {
            if (result.status && result.menu.length > 0)
            {
                console.log(result.menu);
                let html = '';
                result.menu.forEach(item => {
                    if (item.length < 5)
                    {
                        html += `<li class="block w-full p-2 hover:bg-blue-500 hover:text-white cursor-pointer" onclick="openModule('${item[3]}', '${item[1]}')">`;
                    }
                    else
                    {
                        html += `<li class="block w-full p-2 hover:bg-blue-500 hover:text-white cursor-pointer" onclick="openModule('${item[4]}', '${item[1]}')">`;
                    }
                    html += item[0];
                    html += '</li>';
                })

                doc.querySelector('#searchResult').innerHTML = html;
                return;
            }
        })
    }
    else
    {
        doc.querySelector('#searchResult').innerHTML = '';
    }
}

function openModule(moduleName, href)
{
    localStorage.setItem('tempSubmenu', href);
    window.location.href = `?mod=${moduleName}`;
}

// Jquery App
$('.simbioMenu').click(function(e){
    e.preventDefault();
    // set href
    let href = $(this).attr('href');
    // set inactive
    $('.simbioMenu').removeClass('menu-actve');
    // set active
    $(this).addClass('menu-actve');
    // set content
    $('#mainContent').simbioAJAX(href);
})