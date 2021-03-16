<?php

(!defined('INDEX_AUTH')) ?? die('No direct include!');

// Generate Submenu
if (isset($_GET['generateMenu']) && !empty($_GET['generateMenu']))
{
    switch ($_GET['generateMenu']) {
        case 'General-Menu':
            header('Content-type: application/json');
            echo json_encode(generateModuleJs('text-gray-800 hover:text-white text-md'));
            break;
        
        case 'Search-Menu':
            // Search menu

            header('Content-type: application/json');
            echo json_encode(generateSearchJs());
            break;
        case 'Shortcut':
            break;
        default:
            # code...
            break;
    }
    exit;
}

// Search menu action
if (isset($_GET['searchMenu']) && !empty($_GET['searchMenu']))
{
    $menus = [];
    foreach ($_SESSION['priv'] as $moduleName => $options) {
        foreach (generateSubMenu($moduleName, $module, false) as $menu => $subMenu) {
            if ($subMenu[0] !== 'Header')
            {
                if (preg_match('/('.$_GET['searchMenu'].')/i', $subMenu[0])) $menus[] = array_merge($subMenu, [$moduleName]);
            }
        }
    }

    // set header
    header('Content-Type: application/json');
    echo json_encode(count($menus) > 0 ? ['status' => true, 'menu' => $menus] : ['status' => false, 'menu' => []]);
    exit;
}

// load chart in json
if (isset($_GET['chart']))
{   
    header('Content-type: application/json');
    echo json_encode(chart($_GET['chart']));
    exit;
}

// set default menu
if (isset($_GET['defaultSubmenu']))
{
    include SB.'admin/default/submenu.php';

    header('Content-type: application/json');
    echo json_encode(array_values($menu), JSON_PRETTY_PRINT);
    exit;
}