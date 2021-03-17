/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-16 10:56:41
 * @modify date 2021-03-16 10:56:41
 * @desc [description]
 */

'use strict';

let doc = document;

/** ================= Menu Area ================= **/
// Open Menu
function openMenu(type = '')
{
    // Attribute
    attribute('body', 'set', 'style', 'overflow: hidden');
    attribute('#mainContent,.left-sidebar', 'set', 'style', 'z-index: -2');

    // hide n show
    makeVisibility('.menuHideContent', 'add', 'slideInLeft');
    makeVisibility('.menuHideContent,.menuHide', 'remove', 'hidden');

    // set empty
    setHtml('#slideMenu', '');

    // set message
    setHtml('#slideMenuTitle', 'Tunggu sebentar');

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
                setHtml('#slideMenuTitle', type.replace('-', ' '));
                // parse template
                if (result.length > 0)
                {
                    setHtml('#slideMenu', parseModuleList(type, result));
                }
            })
        }
        else
        {
            // set from cache
            setHtml('#slideMenuTitle', type.replace('-', ' '));
            setHtml('#slideMenu', parseModuleList(type));
        }
        // set hidden
        makeVisibility('.menuHideContentInner', 'remove', 'hidden');
    }, 1000);
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

// search menu
const searchMenu = (event, obj) => {
    if (obj.value !== '')
    {
        let result = JSON.parse(localStorage.getItem('Search-Menu'));
        let html = '';

        result.forEach((item)=> {
            var search = new RegExp(obj.value, 'gi');

            if (item[0].match(search) !== null)
            {
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
            }
        })

        setHtml('#searchResult', html);
        return;
    }
    else
    {
        setHtml('#searchResult', '');
    }
}

function openModule(moduleName, href)
{
    localStorage.setItem('tempSubmenu', href);
    window.location.href = `?mod=${moduleName}`;
}

function openDefaultSubmenu()
{
    // set submenu
    setTimeout(async () => {
        if (localStorage.getItem('defaultSubmenu') === null)
        {
            await fetch('index.php?defaultSubmenu=yes')
            .then(response => response.text())
            .then(result => {
                // Make a cache
                localStorage.setItem('defaultSubmenu', result);
                // Parse JSON
                let defaultSubmenu = JSON.parse(result);
                // store html
                setHtml('.submenu', renderDefaultSubmenu(defaultSubmenu));
            });
        }
        else
        {
            // parse from cache
            let defaultSubmenu = JSON.parse(localStorage.getItem('defaultSubmenu'));
            // store html
            setHtml('.submenu', renderDefaultSubmenu(defaultSubmenu));

        }
    }, 200)
}

function renderDefaultSubmenu(defaultSubmenu)
{
    let menu = '';
    // loop for rendering
    defaultSubmenu.forEach((item,index) => {
        if (index === 0)
        {
            //  set default
            menu += `<li class="block">`;
            menu += `<span class="text-lg font-bold p-2 w-48 block text-white no-underline" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash inline-block" viewBox="0 0 16 16">
            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
            </svg>&nbsp;
            ${item[1]}            
            </span>`;
            menu += `</li>`;
        }
        else
        {
            menu += `<li class="block text-white">`;
            menu += `<span onclick="specialSimbioClick('${item[1]}')" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline text-white" title="${item[2]}" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">
            <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
            </svg>&nbsp;
            ${item[0]}            
            </span>`;
            menu += `</li>`;
        }
    })

    return menu;
}

function openBitLikeSubmenu()
{
    setTimeout(() => {
        // set submenu
        if (localStorage.getItem('bitlikeMenu') === null)
        {
            fetch('index.php?bitlikeMenu=yes')
            .then(response => response.text())
            .then(result => {
                // store cache
                localStorage.setItem('bitlikeMenu', result)
                // parsing
                let defaultSubmenu = JSON.parse(result);
                // set to view
                setHtml('.submenu', renderBitLikeSubmenu(defaultSubmenu));
                specialSimbioClick(defaultSubmenu[1][1]);
            });
        }
        else
        {
            // parsing
            let defaultSubmenu = JSON.parse(localStorage.getItem('bitlikeMenu'));
            // set to view
            setHtml('.submenu', renderBitLikeSubmenu(defaultSubmenu));
            specialSimbioClick(defaultSubmenu[1][1]);
        }
    }, 200)
}

function renderBitLikeSubmenu(defaultSubmenu)
{
    let menu = '';
    defaultSubmenu.forEach((item,index) => {
        if (index === 0)
        {
            menu += `<li class="block">`;
            menu += `<span class="text-lg font-bold p-2 w-48 block text-white no-underline" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash inline-block" viewBox="0 0 16 16">
            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
            </svg>&nbsp;
            ${item[1]}            
            </span>`;
            menu += `</li>`;
        }
        else
        {
            menu += `<li class="block text-white">`;
            menu += `<span onclick="specialSimbioClick('${item[1]}')" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline text-white" title="${item[2]}" style="text-decoration: none !important">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">
            <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
            </svg>&nbsp;
            ${item[0]}            
            </span>`;
            menu += `</li>`;
        }
    })
    return menu;
}

/** ================= End Menu Area ================= **/

// parse and caching
const parseModuleList = (type = '', inputResult = '') =>
{
    if (localStorage.getItem(type) === null)
    {
        localStorage.setItem(type, inputResult);
    }

    let result = JSON.parse(localStorage.getItem(type));
    let menu = '';

    if (type === 'General-Menu') 
    {
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
    }
    else
    {
        menu += `<input onkeyup="searchMenu(event,this)" type="text" class="form-control" placeholder="Masukan kata kunci" autofocus/>`
        menu += `<ul id="lastSearchMenu" class="my-3">`
        menu += `</ul>`
        menu += `<ul id="searchResult" class="my-3 text-gray-800"></ul>`
    }

    return menu;
}

/** Appreances Area **/

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

function setHtml(querySelector, value)
{
    doc.querySelector(querySelector).innerHTML = value;
}

// end Appreance

// Reseter
function logoutAndReset()
{
    // clear all cache
    localStorage.clear();
    // and logout
    window.location.href = "logout.php";
}

// Jquery Area
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

function simbioClick(dest)
{
    $('#mainContent').simbioAJAX(`./modules/${dest}`);
}

function specialSimbioClick(dest)
{
    $('#mainContent').simbioAJAX(`${dest}`);
}