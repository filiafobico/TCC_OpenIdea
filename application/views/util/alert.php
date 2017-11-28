
    <div class="page-content">
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__tittle" style="text-align: center"><?= $mensagem ?></h4>
            <div class="mdl-dialog__content">
                <p style="text-align: center"><?php if(isset($informacao)) echo $informacao ?></p>
            </div>
            <div class="mdl-dialog__actions">
                <button class="mdl-button close"><i class="material-icons mdl-list__item-icon">check</i></button>
            </div>
        </dialog>
    </div>


<script type="text/javascript">
    var dialog = document.querySelector('dialog');

    dialog.showModal();

    dialog.querySelector('.close').addEventListener('click', function () {
        dialog.close();
    });
</script>