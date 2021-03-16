<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-16 10:55:41
 * @modify date 2021-03-16 10:56:00
 * @desc [description]
 */

(!defined('INDEX_AUTH')) ?? die('No direct include!');

function generateModule($customClass = 'text-white')
{
    $html = '';
    $html .= '<li class="block ">';
    $html .= '<a href="'. baseLink('admin/') .'" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline '.$customClass.'" title="' . __('Home') . '" style="text-decoration: none !important">';
    $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">';
    $html .= '<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>';
    $html .= '</svg>&nbsp;';
    $html .= __('Home');
    $html .= '</a>';
    $html .= '</li>';
    foreach ($_SESSION['priv'] as $key => $value) {
        // Pre setup
        $label = __(ucwords(str_replace('_', ' ', $key)));
        $sliceLabel = explode(' ', $label);
        // set html
        $html .= '<li class="block '.$customClass.'">';
        $html .= '<a href="'. baseLink('admin/?mod='.$key) .'" class="text-sm font-semibold p-2 hover:bg-blue-500 w-48 block cursor-pointer no-underline '.$customClass.'" title="' . $label . '" style="text-decoration: none !important">';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-current '.$customClass.' inline-block ml-2" viewBox="0 0 16 16">';
        $html .= '<path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>';
        $html .= '</svg>&nbsp;';
        if (count($sliceLabel) > 2)
        {
            $html .= $sliceLabel[0].' '.$sliceLabel[1].'...';
        }
        else
        {
            $html .= $label;
        }
        $html .= '</a>';
        $html .= '</li>';
    }

    return $html;
}

function generateModuleJs($customClass = 'text-white')
{
    // set menu
    $menu = [];
    // set home
    $menu[] = ['url' => baseLink('admin/'), 'label' => __('Home'), 'title' => __('Home'), 'class' => $customClass];
    foreach ($_SESSION['priv'] as $key => $value) {
        // Pre setup
        $label = __(ucwords(str_replace('_', ' ', $key)));
        $sliceLabel = explode(' ', $label);
        $menu[] = [
                    'url' => baseLink('admin/?mod='.$key), 
                    'label' => (count($sliceLabel) > 2) 
                                ? $sliceLabel[0].' '.$sliceLabel[1].'...' : $label,
                    'title' =>  $label,
                    'class' => $customClass
                  ];
    }

    return $menu;
}

function generateSearchJs()
{
    global $module;
    $menus = [];
    foreach ($_SESSION['priv'] as $moduleName => $options) {
        foreach (generateSubMenu($moduleName, $module, false) as $menu => $subMenu) {
            if ($subMenu[0] !== 'Header')
            {
                $menus[] = array_merge($subMenu, [$moduleName]);
            }
        }
    }

    return $menus;
}

function generateSubMenu($module, $objModule, $withHtml = true)
{
    global $dbs;
    $module = basename($module);
    $plugins = \SLiMS\Plugins::getInstance()->getMenus($module);

    if (isExists(SB.'admin/modules/' . $module))
    {
        // Include module submenu.php
        include isExists(SB.'admin/modules/' . $module .'/submenu.php', 'string');

        $plugins = array_merge(count($plugins) > 0 ? [['Header', 'Custom Plugins']] : [], $plugins);

        $menu = array_merge($menu ?? [], $plugins);

        // Take from module.inc.php
        if ($_SESSION['uid'] > 1) {
            $tmp_menu = [];
            if (isset($menu) && count($menu) > 0) {
                foreach ($menu as $item) {
                    if (in_array(md5($item[1]), $_SESSION['priv'][$module]['menus'])) $tmp_menu[] = $item;
                }
            }
            $menu = array_merge($menu, $plugins);
        }
    }
    else 
    {
        include 'default/submenu.php';
        foreach ($objModule->get_shortcuts_menu($dbs) as $key => $value) {
            $link = explode('|', $value);
            $menu[$link[0]] = array(__($link[0]), MWB.$link[1]);
        }
    }

    return ($withHtml) ? submenuHtml($menu) : $menu;
}

function submenuHtml($menus)
{
    $html = '<svg onclick="openMenu(\'General-Menu\')" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block h-9 w-9 p-2 rounded-full hover:bg-gray-200 cursor-pointer hover:text-gray-800" viewBox="0 0 16 16">';
    $html .= '<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>';
    $html .= '</svg>&nbsp Modul lain';
    foreach ($menus as $value) {

        // set html
        if ($value[0] === 'Header')
        {
            $html .= '<li class="block">';
            $html .= '<span class="text-lg font-bold p-2 w-48 block text-white no-underline" style="text-decoration: none !important">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash inline-block" viewBox="0 0 16 16">';
            $html .= '<path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>';
            $html .= '</svg>&nbsp;';
            $html .= $value[1];
            $html .= '</span>';
            $html .= '</li>';
        }
        else
        {
            $html .= '<li class="block">';
            $html .= '<a href="' . $value[1] . '" class="simbioMenu hover:bg-blue-500 cursor-pointer text-sm font-semibold p-2 w-48 block text-white no-underline" style="text-decoration: none !important">';
            $html .= $value[0];
            $html .= '</a>';
            $html .= '</li>';
        }
        // $html .= '<li>'.json_encode($value).'</li>';
    }

    return $html;
}