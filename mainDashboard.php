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
        <h1 class="text-xl font-bold"><?= setGreater(); ?></h1>
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
    </div>
    <div class="flex">
        <div class="flex-initial c1 w-7/12 text-gray-700 text-center px-4 py-2 m-2" id="chart-c1">
        
        </div>
        <div class="flex-initial c2 w-4/12 text-gray-700 text-center px-4 py-2 m-2" id="chart-c2">
            
        </div>
    </div>
</div>