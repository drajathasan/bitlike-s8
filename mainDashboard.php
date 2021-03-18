<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-16 10:55:41
 * @modify date 2021-03-16 10:55:41
 * @desc [description]
 */

// set index auth
if (!defined('INDEX_AUTH'))
{
    die('No direct access!');
}

?>

<div class="flex flex-col mt-6">
    <div class="text-gray-700 px-4 py-2 m-2">
        <h1 class="text-xl font-bold"><?= setGreater().' '.ucfirst($_SESSION['uname']).'.';  ?></h1>
    </div>
    <!-- Alert -->
    <div class="px-4 py-2 mx-2 my-1">
        <?php 
        foreach(setWarning() as $key => $warning): 
            $color = 'red';
            if ($key === 0 && $_SESSION['uid'] === "1"):
                $color = 'blue';
            endif;
        ?>
            
            <div class="flex items-center bg-<?= $color; ?>-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                </svg>&nbsp;
                <p><?= $warning ?></p>
            </div>
        <?php 
        endforeach; 
        ?>
        <!-- Numeric Data -->
        <div class="flex mt-3">
            <div class="w-3/12 h-auto">
                <div data-src="0" class="bg-white h-auto mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-24 w-24 bg-blue-500 text-white p-4 inline-block" viewBox="0 0 16 16">
                        <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                    <div class="inline-block absolute ml-3 mt-2">
                        <h2 class="block text-lg font-semibold text-gray-700"><?= __('Total of Collections') ?></h2>
                        <h4 class="block text-4xl count" data-src="0">0</h4>
                    </div>
                </div>
            </div>
            <div class="w-3/12 h-auto">
                <div data-src="0" class="bg-white h-auto mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-24 w-24 bg-green-500 text-white p-4 inline-block" viewBox="0 0 16 16">
                        <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                    </svg>
                    <div class="inline-block absolute ml-3 mt-2">
                        <h2 class="block text-lg font-semibold text-gray-700"><?= __('Total of Items') ?></h2>
                        <h4 class="block text-4xl count" data-src="1">0</h4>
                    </div>
                </div>
            </div>
            <div class="w-3/12 h-auto">
                <div data-src="0" class="bg-white h-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-24 w-24 bg-yellow-500 text-white p-4 inline-block" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                    <div class="inline-block absolute ml-3 mt-2">
                        <h2 class="block text-lg font-semibold text-gray-700"><?= __('Lent') ?></h2>
                        <h4 class="block text-4xl count" data-src="2">0</h4>
                    </div>
                </div>
            </div>
            <div class="w-3/12 h-auto">
                <div data-src="0" class="bg-white h-auto ml-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-24 w-24 bg-pink-500 text-white p-4 inline-block" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                    <div class="inline-block absolute ml-3 mt-2">
                        <h2 class="block text-lg font-semibold text-gray-700"><?= __('Available') ?></h2>
                        <h4 class="block text-4xl count" data-src="3">0</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex bg-white mx-auto block mt-3 w-full">
            <div class="flex-initial c1 w-7/12 text-gray-700 text-center px-4 py-2 m-2 rounded-lg" id="chart-c1">
            
            </div>
            <div class="flex-initial c2 w-4/12 text-gray-700 text-center px-4 py-2 m-2 rounded-lg" id="chart-c2">
                
            </div>
        </div>
    </div>
</div>