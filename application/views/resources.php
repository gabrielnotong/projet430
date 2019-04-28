<?php
    $this->load->helper('form');
    $error = $this->session->flashdata('error');
    $success = $this->session->flashdata('success');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>
            Toutes les Ressources
            <small>Toutes les Ressources de notre panel</small>
        </h1>
    </section>
    <section class="content">
        <div class="col-xs-12">
            <div class="text-right">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewResource">
                    <i class="fa fa-plus"></i> Ajouter une ressource</a>
            </div>
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover"
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Libellé</th>
                                <th>Description</th>
                                <th>Durumu</th>
                                <th>Catégorie</th>
                                <th>Créateur</th>
                                <th>Rôle créateur</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($taskRecords)): ?>
                                <?php foreach ($taskRecords as $record): ?>
                                    <tr>
                                        <td>
                                            <?php echo $record->id ?>
                                        </td>
                                        <td>
                                            <?php echo $record->title ?>
                                        </td>
                                        <td>
                                            <?php echo $record->comment ?>
                                        </td>
                                        <td>
                                            <div class="label label-<?php
                                            if ($record->statusId == '1')
                                                echo 'danger';
                                            else if ($record->statusId == '2')
                                                echo 'success';
                                            ?>">
                                                <?php echo $record->status ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="label label-<?php
                                            if ($record->priorityId == '1')
                                                echo 'danger';
                                            else if ($record->priorityId == '2')
                                                echo 'warning';
                                            else if ($record->priorityId == '3')
                                                echo 'info'
                                            ?>">
                                                <?php echo $record->priority ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $record->name ?>
                                        </td>
                                        <td>
                                            <?php echo $record->role ?>
                                        </td>
                                        <td>
                                            <?php echo $record->createdDtm ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info"
                                               href="<?php echo base_url() . 'edit_old_resource/' . $record->id; ?>"
                                               title="Düzenle">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger deleteUser"
                                               href="<?php echo base_url() . 'deleteResource/' . $record->id; ?>"
                                               data-userid="<?php echo $record->id; ?>"
                                               title="Sil">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>