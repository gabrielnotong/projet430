<?php
    $this->load->helper('form');
    $error = $this->session->flashdata('error');
    $success = $this->session->flashdata('success');
    $noMatch = $this->session->flashdata('nomatch');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>    
            Changer le mot de passe
            <small>Définir un nouveau mot de passe</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Entrez vos informations</h3>
                    </div>
                    <form role="form" action="<?php echo base_url() ?>changePassword" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Votre ancien mot de passe</label>
                                        <input type="password" class="form-control" id="inputOldPassword"
                                               placeholder="Votre ancien mot de passe" name="oldPassword" maxlength="20"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="inputPassword1"
                                               placeholder="Nouveau mot de passe" name="newPassword" maxlength="20"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword2">Vérifiez votre nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="inputPassword2"
                                               placeholder="Vérifiez votre nouveau mot de passe" name="cNewPassword"
                                               maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Valider"/>
                            <input type="reset" class="btn btn-default" value="Annuler"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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

                <?php if ($noMatch): ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('nomatch'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>