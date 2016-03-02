<?php $person = ViewData::get('person') ?>

<form class="form form-horizontal" action="action.php?method=delete&id_person=<?php echo $person->id_person ?>" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure to delete person?</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">This operation will be irreversible !</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete person</button>
    </div>
</form>

