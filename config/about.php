<?php
/**
 * @author Drajat Hasan
 * @email [drajathasan20@gmail.com]
 * @create date 2021-03-16 14:02:51
 * @modify date 2021-03-16 14:02:51
 * @desc [description]
 */

// set INDEX_AUTH
define('INDEX_AUTH', "1");

// require sysconfig
require '../../../../sysconfig.inc.php';

// session area
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';

// load BitLike
require __DIR__.'/../BitLike.php';

?>

<div class="menuBox">
  <div class="menuBoxInner systemIcon">
    <div class="per_title">
      <h2>Tetang BitLike</h2>
    </div>
  </div>
</div>
<div class="flex">
    <div class="w-4/12 h-full">
        <div class="p-5">
            <img src="<?= SWB . 'images/persons/person.png'?>" class="shadow-2xl w-32 h-32 block mx-auto rounded-full image-author"/>
            <small class="block font-bold text-xs text-center mt-5">Dirancang oleh</small>
            <span class="block font-bold text-lg text-gray-700 text-center mt-1"><?= BIT_AUTHOR ?></span>
            <span class="block mx-auto text-center mt-2">
                <a href="https://github.com/drajathasan" target="blank" title="Github">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg fa mx-2" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                </a>
                <a href="mailto:drajathasan20@gmail.com" title="GMail" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg fa mx-2" viewBox="0 0 16 16">
                        <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z"/>
                        <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z"/>
                    </svg>
                </a>
                <a href="https://www.youtube.com/channel/UC7qnmebB_6ckwN6DtPbCa3w" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg fa mx-2" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.122C.002 7.343.01 6.6.064 5.78l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                    </svg>
                </a>
                <a href="https://t.me/drajathasan" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg fa mx-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                    </svg>
                </a>
            </span>
        </div>
    </div>
    <div class="w-8/12 h-full">
        <ul class="text-base">
            <li><h1 class="text-lg font-bold">Informasi</h1></li>
            <li><span class="w-14 inline-block mt-2">Versi</span> : &nbsp; <b><?= BIT_VERSION ?></b></li>
            <li><span class="w-14 inline-block mt-2">Lisensi</span> : &nbsp; <b><?= BIT_LICENSE ?></b></li>
            <li><h1 class="text-lg font-bold mt-2 inline-block">Fitur</h1></li>
            <li>
                <ol class="list-decimal mt-2 ml-8">
                    <li class="p-2">Left Sidebar Menu</li>
                    <li class="p-2">Search Menu</li>
                    <li class="p-2">Self Color Picker</li>
                    <li class="p-2">Easy Menu Access</li>
                </ol>
            </li>
            <li><h1 class="text-lg font-bold mt-2">Deskripsi</h1></li>
            <li>
                <p class="leading-8 text-justify pr-5">BitLike merupakan template admin untuk SLiMS >= 9.3.1 yang terinspirasi dari template dashboard layanan Hosting Git yaitu <b>BitBucket</b>. Apa yang anda lihat bukanlah hasil <b class="italic"><i>copy-paste</i></b> template dengan mesin kloning seperti httrack melain kan rakitan dan dibuat dengan bantuan library CSS dari bootstrap dan tailwind + css bawaan SLiMS 9 dll, jadi ini tidak murni saya buat dari nol melainkan rakitan. Saya berharap anda dapat menikmati template ini dengan Bebas (Dikustom sesuai keinginan) dengan <a href="javascript:void(0)" class="notAJAX" title="Klik untuk info lebih lanjut" onclick="alert('Jangan hapus nama saya ketika anda mengcustom template ini atau mengkomersilkan nya (Kebutuhan Jasa) : (.')"><b>etika yang berlaku :).</b></a></p>
            </li>
        </ul>
    </div>
</div>

<script>
    let online = window.navigator.onLine;

    if (online) 
    {
        document.querySelector('.image-author').setAttribute('src', 'https://avatars.githubusercontent.com/u/38057222?s=460&u=05c3182538b6943a984d0ba9d5746ab20c7166b1&v=4');
    }
</script>