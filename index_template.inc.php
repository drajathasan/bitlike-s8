<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-13 07:58:12
 * @modify date 2021-03-13 07:58:12
 * @desc [description]
 */

//  Include Some file
include_once __DIR__ .'/BitLike.php';
include_once __DIR__ .'/helper.php';
include_once __DIR__ .'/generator.php';
include_once __DIR__ .'/app.php';

?>
<!-- 
 ____  _ _   _     _ _           
| __ )(_) |_| |   (_) | _____ 
|  _ \| | __| |   | | |/ / _ \
| |_) | | |_| |___| |   <  __/
|____/|_|\__|_____|_|_|\_\___|

Version : <?= BIT_VERSION ?>

Design by : <?= BIT_AUTHOR ?>

Email : <?= BIT_AUTHOR_EMAIL ?>


 -->
<!DOCTYPE html>
<html lang="<?= setLang($sysconf['default_lang']) ?>">
    <head>
        <title><?= libraryName($page_title) ?></title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
        <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
        
        <!-- Icon -->
        <link rel="icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />

        <!-- Default SLiMS CSS -->
        <?= defaultCSS() ?>

        <!-- BitLike Minimal Style -->
        <link href="<?= themeLink('assets/css/slims.css'); ?>" rel="stylesheet"/>
        <link href="<?= themeLink('assets/css/style.css'); ?>" rel="stylesheet"/>
        <link href="<?= themeLink('assets/css/tailwind.min.css'); ?>" rel="stylesheet"/>

        <!-- Default SLiMS JS -->
        <?= defaultJS() ?>

        <!-- Custom left sidbar color -->
        <?php
        if (file_exists(__DIR__.'/config/color-'.$_SESSION['uid'].'.json'))
        {
            $data = json_decode(file_get_contents(__DIR__.'/config/color-'.$_SESSION['uid'].'.json'), TRUE);

            if (!is_null($data) && isset($data['hex']) && !empty($data['hex']))
            {
                ?>
                <style id="customColor">.left-sidebar {background-color: <?= $data['hex'] ?> !important} </style>
                <?php
            }
        }
        ?>
    </head>
    <body class="bg-gray-100">
        <section class="flex">
            <!-- Left Sidebar -->
            <div class="h-screen left-sidebar fixed">
                <div class="flex">
                    <!-- Thin Menu -->
                    <div class="w-1/5 h-screen">
                        <!-- SLiMS Logo -->
                        <?php if (empty($sysconf['logo_image'])): ?>
                            <svg class="fill-current text-white h-10 w-10 mx-auto hover:bg-blue-500 p-1 rounded-full cursor-pointer fixed top-0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135; margin-left: 0.45em !important; margin-top: 15px" xml:space="preserve">
                                <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                                l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                                c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                                C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                                L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                                c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"></path>
                            </svg>
                        <?php else: ?>
                            <img src="<?= SWB.'images/default/' . $sysconf['logo_image'] ?>" class="fill-current text-white h-10 w-10 ml-2 mt-3 hover:bg-blue-500 p-1 rounded-full cursor-pointer fixed top-0" />
                        <?php endif; ?>

                        <!-- Menu Search -->
                        <svg onclick="openMenu('Search-Menu')" width="30" height="30" viewBox="0 0 24 24" focusable="false" role="presentation" class="mt-20 text-white fixed top-0 mx-auto hover:bg-blue-500 p-1 rounded-full cursor-pointer" style="margin-left: 10px !important">
                            <path d="M16.436 15.085l3.94 4.01a1 1 0 0 1-1.425 1.402l-3.938-4.006a7.5 7.5 0 1 1 1.423-1.406zM10.5 16a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11z" fill="currentColor" fill-rule="evenodd"></path>
                        </svg>

                        <!-- Shorcut -->
                        <svg onclick="openDefaultSubmenu()" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="fixed ml-3 text-white mx-auto block mt-32 hover:bg-blue-500 rounded-full cursor-pointer" viewBox="0 0 16 16" style="margin-left: 10px !important">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>

                        <!-- Template Configuration -->
                        <svg onclick="openBitLikeSubmenu()" title="Pengaturan BitLike" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-10 w-10 p-2 rounded-full text-white fixed bottom-0 ml-2 mb-40 hover:bg-blue-500 cursor-pointer" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                        </svg>

                        <!-- Global Menu -->
                        <svg onclick="openMenu('General-Menu')" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-10 w-10 p-2 rounded-full text-white fixed bottom-0 ml-2 mb-28 hover:bg-blue-500 cursor-pointer" viewBox="0 0 16 16">
                            <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
                        </svg>

                        <!-- User -->
                        <img onclick="simbioClick('system/app_user.php?action=detail&changecurrent=true')" src="<?= imageProfile() ?>" class="h-10 w-10 fixed bottom-0 ml-2 mb-16 rounded-full hover:bg-blue-500 p-1 cursor-pointer"/>

                        <!-- Out -->
                        <a title="<?=__('Logout')?>" href="javascript:void(0)" onclick="logoutAndReset()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 rounded-full text-white fixed bottom-0 ml-2 mb-3 hover:bg-blue-500 cursor-pointer" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1h-1z"/>
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                            </svg>
                        </a>
                    </div>
                    <!-- Big Menu -->
                    <div class="w-4/5 h-screen px-2 mt-6">
                        <!-- Label -->
                        <h1 class="text-white font-bold <?= strlen($sysconf['library_name']) > 25 ? 'text-md' : 'text-2xl' ?>"><?= $sysconf['library_name'] === 'Senayan' ? 'SLiMS' : $sysconf['library_name'] ?></h1>
                        <!-- Menu -->
                        <ul class="text-white mt-6 pb-32 h-screen overflow-y-auto submenu">
                            <?php 
                                if (isset($_GET['mod']) && !empty($_GET['mod']))
                                {
                                    echo generateSubMenu($_GET['mod'], $module);
                                }
                                else
                                {
                                    echo generateModule();
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Content Area -->
            <div class="loader"></div>
            <div class="right-content h-auto p-1" id="mainContent">
                <?php
                if (!isset($_GET['mod']))
                {
                    include __DIR__.'/mainDashboard.php';
                }
                ?>
            </div>
            <!-- Hidden Sidebar -->
            <div class="w-full menuHide h-screen absolute hidden">
                <div class="flex">
                    <div class="bg-white menuHideContent h-screen p-3 fixed">
                        <!-- Close button -->
                        <div class="menuHideContentInner hidden w-1/5 inline-block cursor-pointer">
                            <svg onclick="hideMenu()" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block mx-auto h-10 w-10 p-2 rounded-full hover:bg-gray-200" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </div>
                        <!-- Menue Hidden -->
                        <div class="menuHideContentInner hidden w-8/12 inline-block absolute mt-2 ml-3">
                            <h1 class="font-bold text-lg" id="slideMenuTitle">Content</h1>
                            <ul id="slideMenu" class="text-white mt-6 pb-32 h-screen overflow-y-auto">

                            </ul>
                        </div>
                    </div>
                    <!-- Blur area -->
                    <div class="menuHideContentBlur h-full fixed" style="z-index: -1; opacity: 0.5; background: rgba(9, 30, 66, 0.54); transition: opacity 220ms ease 0s;"></div>
                </div>
            </div>
        </section>
        <!-- Set fake iframe -->
        <iframe name="blindSubmit" class="hidden"></iframe>
        <!-- Application Javascript -->
        <script type="text/javascript" app-bitlike="true" src="<?= themeLink('assets/js/app.js'); ?>" alwaysShowTracks="true"></script>
        <script type="text/javascript" src="<?= themeLink("assets/js/tui-chart-all.min.js") ?>"></script>
        <!-- Load ui -->
        <script>
            let awb = '<?=AWB?>';
            let barchart = [<?="'".__('Latest Transactions')."', '".__('Loan')."', '".__('Return')."', '".__('Extend')."'"?>];
            let doughchart = [<?="'".__('Summary')."', '".__('Total')."', '".__('Loan')."', '".__('Return')."', '".__('Extend')."', '".__('Overdue')."'"?>];
        </script>
            <?php
                if (isset($_GET['mod']) && !empty($_GET['mod']) && isExists(MDLBS.basename($_GET['mod']).'/index.php'))
                {
                ?>
                    <script type="text/javascript">
                        if (localStorage.getItem('tempSubmenu') === null)
                        {
                            $("#mainContent").simbioAJAX("<?= MWB.basename($_GET['mod']) ?>/index.php");
                        }
                        else
                        {
                            // set temp submenu
                            $("#mainContent").simbioAJAX(localStorage.getItem('tempSubmenu'));
                            // remove temp submenu
                            localStorage.removeItem('tempSubmenu');
                        }
                    </script>
                <?php
                }
                else
                {
                ?>
                <script type="text/javascript" app-bitlike="true" src="<?= themeLink('assets/js/ui.js'); ?>"></script>
                <?php    
                }
            ?>
    </body>
</html>