<?php if ($_GET['model'] == "person") : ?>

    <form class="form form-horizontal" action="/action.php?method=create&model=person" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create person</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" id="name" name="name" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="surname" class="col-sm-4 control-label">Surname</label>
                    <div class="col-sm-6">
                        <input type="text" id="surname" name="surname" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthDay" class="col-sm-4 control-label">Birthday</label>
                    <div class="col-sm-6">
                        <input type="date" id="birthDay" name="birthDay" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthPlace" class="col-sm-4 control-label">Birth place</label>
                    <div class="col-sm-6">
                        <input type="text" id="birthPlace" name="birthPlace" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthCountry" class="col-sm-4 control-label">Birth country</label>
                    <div class="col-sm-6">
                        <input type="text" id="birthCountry" name="birthCountry" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deathDay" class="col-sm-4 control-label">Death day</label>
                    <div class="col-sm-6">
                        <input type="date" id="deathDay" name="deathDay" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deathPlace" class="col-sm-4 control-label">Death place</label>
                    <div class="col-sm-6">
                        <input type="text" id="deathPlace" name="deathPlace" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deathCountry" class="col-sm-4 control-label">Death country</label>
                    <div class="col-sm-6">
                        <input type="text" id="deathCountry" name="deathCountry" class="form-control"
                               value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create person</button>
        </div>
    </form>

<?php endif; ?>
<?php if ($_GET['model'] == 'placement'): ?>
    <?php $ohs = ViewData::get('ohs'); ?>
    <form class="form form-horizontal" action="/action.php?method=create&model=placement" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create placement</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" name="id_person" value="<?php echo $id_person; ?>">
                <div class="form-group">
                    <label for="ID_OH" class="col-sm-4 control-label">OH</label>
                    <div class="col-sm-6">
                        <select id="ID_OH" name="ID_OH" class="form-control">
                            <?php foreach ($ohs as $oh): ?>
                                <option value="<?php echo $oh->id_OH ?>"><?php echo $oh->type . ' ' . $oh->year ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="place" class="col-sm-4 control-label">Place</label>
                    <div class="col-sm-6">
                        <input type="text" id="place" name="place" class="form-control"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="discipline" class="col-sm-4 control-label">Discipline</label>
                    <div class="col-sm-6">
                        <input type="text" id="discipline" name="discipline" class="form-control"
                               value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create placement</button>
        </div>
    </form>

<?php endif; ?>



