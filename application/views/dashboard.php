<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Panneau de gestion
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?= isset($resourcesCount) ? $resourcesCount : '0' ?>
                        </h3>
                        <p>Ressources</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tasks"></i>
                    </div>
                    <a
                        href="<?php echo base_url(); ?><?= ($role != ROLE_STUDENT) ? 'resources' : 'eresource' ?>"
                        class="small-box-footer"
                    >
                        Plus d'informations
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?= isset($finishedResourcesCount) ? $finishedResourcesCount : '0' ?>
                        </h3>
                        <p>Ressources terminées</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a
                        href="<?php echo base_url(); ?><?= ($role != ROLE_STUDENT) ? 'resources' : 'eresource' ?>"
                        class="small-box-footer">
                        Plus d'informations
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?= isset($usersCount) ? $usersCount : '0' ?>
                        </h3>
                        <p>Utilisateurs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>user_list" class="small-box-footer">Plus d'informations
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?= isset($logsCount) ? $logsCount : '0' ?>
                        </h3>
                        <p>Log</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-archive"></i>
                    </div>
                    <a href="#" class="small-box-footer">Plus d'informations
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    <!--          <a href="-->
                    <?php //echo base_url(); ?><!--log-history" class="small-box-footer">Plus d'informations-->
                    <!--            <i class="fa fa-arrow-circle-right"></i>-->
                    <!--          </a>-->
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

    </section>
</div>