<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-16 11:12:30
 * @modify date 2021-03-16 11:12:30
 * @desc [description]
 */

// set INDEX_AUTH
define('INDEX_AUTH', "1");

// require sysconfig
require '../../../../sysconfig.inc.php';

// session area
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';

// simbio
require SIMBIO.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';

if (isset($_POST['hex']))
{
    if (!file_exists(__DIR__.'/color-'.$_SESSION['uid'].'.json'))
    {
        file_put_contents(__DIR__.'/color-'.$_SESSION['uid'].'.json', json_encode(['hex' => null]));
    }

    $save = file_put_contents(__DIR__.'/color-'.$_SESSION['uid'].'.json', json_encode($_POST));

    if ($save)
    {
        utility::jsToastr(__('System Configuration'), 'Warna berhasil diganti', 'success'); 
        echo '<script type="text/javascript">
                    setTimeout(() => {
                        top.location.href = \''.AWB.'index.php\';
                    }, 1000);
              </script>';
        exit;
    }

    utility::jsToastr(__('System Configuration'), 'Warna gagal diganti', 'error'); 
    exit;
}

if (isset($_GET['deleteconf']))
{
    if (file_exists(__DIR__.'/color-'.$_SESSION['uid'].'.json'))
    {
        if (unlink(__DIR__.'/color-'.$_SESSION['uid'].'.json'))
        {
            utility::jsToastr(__('System Configuration'), 'Warna berhasil direset', 'success'); 
            echo '<script type="text/javascript">
                        setTimeout(() => {
                            top.location.href = \''.AWB.'index.php\';
                        }, 1000);
                  </script>';
            exit;
        }
    }

    utility::jsToastr(__('System Configuration'), 'Warna gagal direset', 'success'); 
    exit;
}

if (isset($_GET['clear']))
{
    echo '<script>localStorage.clear();</script>';
    utility::jsToastr(__('System Configuration'), 'Bitlike Cache berhasil dihapus!', 'success'); 
    exit;
}

$hex = '#0747a6';
if (file_exists(__DIR__.'/color-'.$_SESSION['uid'].'.json'))
{
    $json = json_decode(file_get_contents(__DIR__.'/color-'.$_SESSION['uid'].'.json'), TRUE);
    $hex = $json['hex'];
}

$configWrite = is_writable(__DIR__);

?>
<div class="menuBox">
  <div class="menuBoxInner systemIcon">
    <div class="per_title">
      <h2>BitLike Configuration</h2>
    </div>
    <div class="infoBox">
      Ubah pengaturan.
    </div>
    <?php if (!$configWrite): ?>
    <div class="infoBox bg-red-500 text-white">
      Folder <b>"<?= __DIR__ ?>"</b> tidak dapat ditulis!
    </div>
    <?php endif; ?>
  </div>
</div>
<?php if ($configWrite): ?>
<div class="flex">
    <div class="w-full m-2 block">
        <form class="w-full" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" target="BitBlind">
            <label class="inline-block w-32">Pilih Warna</label>
            <button class="ml-5 inline-block bg-blue-500 rounded-lg p-2 text-white" id="colorPicker">Buka Pemilih Warna</button>
            <br>
            <label class="inline-block w-32">Kode Warna</label>
            <div id="colorResult" class="ml-5 inline-block w-8 h-8 mt-2" style="background-color: <?= $hex ?>"></div>
            <label id="hexResult" class="inline-block"><?= $hex ?></label>
            <br>
            <input type="hidden" name="hex" value="<?= $hex ?>"/>
            <label class="inline-block w-32">Hapus Cache</label>
            <a href="<?= $_SERVER['PHP_SELF']; ?>?clear=cache" target="BitBlind" class="notAJAX ml-5 inline-block bg-yellow-500 rounded-lg p-2 text-white" id="colorPicker">Hapus</a>
            <br>
            <button class="float-right mr-2 inline-block bg-green-500 rounded-lg p-2 text-white">Simpan</button>
            <a href="<?=$_SERVER['PHP_SELF']?>?deleteconf=true" target="BitBlind" class="float-right mr-2 inline-block bg-red-500 rounded-lg p-2 text-white">Reset</a>
        </form>
        <iframe class="hidden" name="BitBlind"></iframe>
    </div>
</div>
<script>
    // Create a new Picker instance and set the parent element.
    // By default, the color picker is a popup which appears when you click the parent.
    var parent = document.querySelector('#colorPicker');
    var picker = new Picker(parent);

    // You can do what you want with the chosen color using two callbacks: onChange and onDone.
    picker.onChange = function(color) {
        if (document.querySelector('style[id="customColor"]') !== null)
        {
            document.querySelector('style[id="customColor"]').remove();
        }
        document.querySelector('#colorResult').setAttribute('style', `background-color : ${color.hex}`);
        document.querySelector('#hexResult').innerHTML = color.hex;
        document.querySelector('input[name="hex"]').value = color.hex;
        document.querySelector('.left-sidebar').setAttribute('style', `background-color : ${color.hex}`);
    };

    // onDone is similar to onChange, but only called when you click 'Ok'.
</script>
<?php endif; ?>
