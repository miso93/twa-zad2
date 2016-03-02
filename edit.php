<?php $person = ViewData::get('person') ?>
<?php $placement = ViewData::get('placement') ?>
<?php $ohs = ViewData::get('ohs') ?>

<form class="form form-horizontal" action="action.php?method=edit&id_person=<?php echo $person->id_person ?>&id_um=<?php echo $placement->id; ?>" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit person</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $person->name; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-sm-4 control-label">Surname</label>
                <div class="col-sm-6">
                    <input type="text" id="surname" name="surname" class="form-control"
                           value="<?php echo $person->surname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="birthDay" class="col-sm-4 control-label">Birthday</label>
                <div class="col-sm-6">
                    <input type="date" id="birthDay" name="birthDay" class="form-control"
                           value="<?php echo $person->birthDay; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="birthPlace" class="col-sm-4 control-label">Birth place</label>
                <div class="col-sm-6">
                    <input type="text" id="birthPlace" name="birthPlace" class="form-control"
                           value="<?php echo $person->birthPlace; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="birthCountry" class="col-sm-4 control-label">Birth country</label>
                <div class="col-sm-6">
                    <input type="text" id="birthCountry" name="birthCountry" class="form-control"
                           value="<?php echo $person->birthCountry; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="deathDay" class="col-sm-4 control-label">Death day</label>
                <div class="col-sm-6">
                    <input type="date" id="deathDay" name="deathDay" class="form-control"
                           value="<?php echo $person->deathDay; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="deathPlace" class="col-sm-4 control-label">Death place</label>
                <div class="col-sm-6">
                    <input type="text" id="deathPlace" name="deathPlace" class="form-control"
                           value="<?php echo $person->deathPlace; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="deathCountry" class="col-sm-4 control-label">Death country</label>
                <div class="col-sm-6">
                    <input type="text" id="deathCountry" name="deathCountry" class="form-control"
                           value="<?php echo $person->deathCountry; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="ID_OH" class="col-sm-4 control-label">OH</label>
                <div class="col-sm-6">
                    <select id="ID_OH" name="ID_OH" class="form-control">
                        <?php foreach($ohs as $oh):?>
                            <option value="<?php echo $oh->id_OH?>" <?php if($oh->id_OH == $placement->ID_OH){echo 'selected';}?>><?php echo $oh->type . ' '. $oh->year?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="place" class="col-sm-4 control-label">Place</label>
                <div class="col-sm-6">
                    <input type="text" id="place" name="place" class="form-control"
                           value="<?php echo $placement->place; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="discipline" class="col-sm-4 control-label">Discipline</label>
                <div class="col-sm-6">
                    <input type="text" id="discipline" name="discipline" class="form-control"
                           value="<?php echo $placement->discipline; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>

