<?php $page = 'index'; ?>
<?php require_once "function.php" ?>
<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Zadanie č.2 | Michal Čech</title>

    <!-- Bootstrap -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <h1>Zadanie č.2 - CRUD
                    <small>vypracoval Michal Čech</small>
                </h1>
            </div>
        </div>
    </div>
    <ol class="breadcrumb">
        <li class="active">Home</li>
    </ol>
    <?php
    if (MessagesList::hasMessages()):
        foreach (MessagesList::getAll() as $error): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error:</strong> <?php echo $error->getMessage(); ?>
            </div>
        <?php endforeach;
    else :
        ?>
        <div class="row">
            <div class="col-sm-2 col-sm-offset-1">
                <a class="btn btn-primary btn-block" data-toggle="modal"
                   data-target="#edit_modal"
                   href="/action.php?method=create&model=person">Create person</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <table id="table-oh" class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Year</th>
                        <th>City, Country</th>
                        <th>OH type</th>
                        <th>Discipline</th>
                        <th>Place</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (ViewData::get('persons') as $person): ?>
                        <tr>
                            <td>
                                <a href="sportovec?id=<?php echo $person->id_person ?>"><?php echo $person->surname . ' ' . $person->name; ?></a>
                            </td>
                            <td><?php echo $person->year; ?></td>
                            <td><?php echo $person->city . ', ' . $person->country; ?></td>
                            <td><?php echo $person->type; ?></td>
                            <td><?php echo $person->discipline; ?></td>
                            <td><?php echo $person->place; ?></td>
                            <td>
                                <a class="action-edit"
                                   href="action.php?method=edit&id_person=<?php echo $person->id_person ?>&id_um=<?php echo $person->id_um ?>"
                                   data-toggle="modal"
                                   data-target="#edit_modal"><span class="ion-edit"></span></a>
                                <a class="action-remove"
                                   href="action.php?method=delete&id_person=<?php echo $person->id_person ?>"
                                   data-toggle="modal"
                                   data-target="#edit_modal"><span class="ion-ios-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });

        $('#table-oh').DataTable({
            columnDefs: [{
                targets: [3],
                orderData: [3, 1]
            }]
        });
        $('#table-oh, .datatable-tools').each(function () {
            var datatable = $(this);
            // SEARCH - Add the placeholder for Search and Turn this into in-line form control
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            var dropdown_select = datatable.closest('.dataTables_wrapper').find('select');
            search_input.addClass('form-control');
            dropdown_select.addClass('form-control');
        });
    });
</script>
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="aaa"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
</body>
</html>