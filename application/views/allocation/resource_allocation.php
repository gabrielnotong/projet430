<?= $isAffectation = isset($action) && $action == 1; ?>
<?= $isReservation = isset($action) && $action == 2; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-md-3">
                <h3 class="text-primary text-bold">
                    Affectation des ressources
                    <small>IN430</small>
                </h3>
            </div>
            <div class="col-md-9">
                <form name="search" id="search" action="<?= base_url() ?>resource_allocation" method="post">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="globalLevel">Choisir la classe à visualiser</label>
                            <select name="globalLevel" id="globalLevel" class="form-control">
                                <option value="">Sélectionnez la filière</option>
                                <?php foreach ($levels as $level): ?>
                                    <option value="<?= $level->id ?>" <?php if (isset($levelId) && $level->id == $levelId) {
                                        echo 'selected=selected';
                                    } ?>>
                                        <?= $level->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="action">Que voulez-vous effectuer ?</label>
                            <select name="action" id="action" class="form-control">
                                <option value="">Réservation ou affectation de ressources</option>
                                <?php foreach ($actions as $key => $actionLabel): ?>
                                    <option value="<?= $key ?>" <?php if (isset($action) && $key == $action) {
                                        echo 'selected=selected';
                                    } ?>>
                                        <?= $actionLabel ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-1" style="margin-top: 23px;">
                            <button class="btn btn-success" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-yellow text-bold">
                                    <?php if($isAffectation or !$isReservation): ?>
                                        Effectuer une affectation
                                    <?php endif; ?>
                                    <?php if($isReservation): ?>
                                        Effectuer une réservation
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>

                        <hr>

                        <!-- SELECT CLASS CALENDAR -->
                        <form id="search" name="search" method="post" action="<?= base_url() ?>resource_allocation">

                            <div class="form-group">
                                <label for="color">Etiquettes</label>
                                <select name="color" class="form-control" id="color">
                                    <option value="">Choisir une étiquette</option>
                                    <?php foreach ($colors as $label => $colorValue): ?>
                                        <option style="color:<?= $colorValue ?>;"
                                                value="<?= $colorValue ?>"
                                            <?= isset($color) && $color == $colorValue ? 'selected=selected' : '' ?>
                                        ><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="level">Niveau d'études</label>
                                <select class="form-control searchForm required" id="level" name="level">
                                    <option value="0">Sélectionnez le niveau d'études</option>
                                    <?php foreach ($levels as $level): ?>
                                        <option value="<?= $level->id ?>" <?php if (isset($levelId) && $level->id == $levelId) {
                                            echo 'selected=selected';
                                        } ?>>
                                            <?= $level->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group hiddenField lesson">
                                <label for="lesson">Unité d'enseignement</label>
                                <select class="form-control searchForm required" id="lesson" name="lesson"></select>
                            </div>

                            <div class="form-group hiddenField teacher">
                                <label for="teacher">Enseignant</label>
                                <select class="form-control required" id="teacher" name="teacher"></select>
                            </div>

                            <?php if($isAffectation or !$isReservation): ?>
                                <div class="form-group hiddenField semester">
                                    <label for="semester">Semestre</label>
                                    <select class="form-control required" id="semester" name="semester">
                                        <option value="0">Choisir le semestre</option>
                                        <?php foreach ($semesters as $key => $semester): ?>
                                            <option value="<?= $semester->id ?>">
                                                <?= $semester->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type='hidden' id="dateStart" name="dateStart"/>
                                    <input type='hidden' id="dateEnd" name="dateEnd"/>
                                </div>

                                <div class="form-group hiddenField day">
                                    <label for="day">Jour de la semaine</label>
                                    <select class="form-control required" id="day" name="day">
                                        <option value="0">Choisir le jour</option>
                                        <?php foreach ($days as $key => $day): ?>
                                            <option value="<?= $day['id']; ?>">
                                                <?= $day['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group hiddenField dates">
                                    <label for="start">Heure de début</label>
                                    <div class="datetimepicker input-group input-append">
                                        <span class="add-on input-group-addon">
                                           <i class="fa fa-calendar-times-o text-primary"></i>
                                        </span>
                                        <input data-format="hh:mm" type="text"  class="form-control" id="start" name="start"/>
                                    </div>
                                </div>

                                <div class="form-group hiddenField dates">
                                    <label for="end">Heure de fin</label>
                                    <div class="datetimepicker input-group input-append">
                                        <span class="add-on input-group-addon">
                                           <i class="fa fa-calendar-times-o text-primary"></i>
                                        </span>
                                        <input data-format="hh:mm" type="text"  class="form-control" id="end" name="end"/>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($isReservation): ?>
                                <div class="form-group">
                                    <label for="periodDate">Date</label>
                                    <div class="datepickerDate input-group input-append">
                                        <span class="add-on input-group-addon">
                                           <i class="fa fa-calendar-times-o text-primary"></i>
                                        </span>
                                        <input type="text"  class="form-control" id="periodDate" name="periodDate"/>
                                        <input type='hidden' id="isReservation" name="isReservation" value="1"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="startPeriod">Heure de début</label>
                                    <div class="datepickerHour input-group input-append">
                                        <span class="add-on input-group-addon">
                                           <i class="fa fa-calendar-times-o text-primary"></i>
                                        </span>
                                        <input data-format="hh:mm" type="text"  class="form-control" id="startPeriod" name="startPeriod"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endPeriod">Heure de début</label>
                                    <div class="datepickerHour input-group input-append">
                                        <span class="add-on input-group-addon">
                                           <i class="fa fa-calendar-times-o text-primary"></i>
                                        </span>
                                        <input data-format="hh:mm" type="text"  class="form-control" id="endPeriod" name="endPeriod"/>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group hiddenField room">
                                <label for="room">Salles</label>
                                <select class="form-control required" id="room" name="room"></select>
                            </div>

                            <hr>

                            <div class="input-group-btn hiddenField submitBtn">
                                <input type='hidden' id="eventId" name="eventId"/>
                                <button id="add-new-event" type="button" class="btn btn-primary btn-flat">
                                    Ajouter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
    var $allocations = <?= $allocations ?>;
    var baseUrl = '<?= base_url(); ?>';
    var $levelId = '<?= isset($levelId) ? $levelId : 0; ?>';
</script>
<script>
    $(function () {

        /** DATETIME PICKER Affectation **/
        $('.datetimepicker, .datepickerHour').datetimepicker({
            pickDate: false,
            pickSeconds: false
        });

        /** Reservation **/
        $('.datepickerDate').datetimepicker({
            format: 'yyyy-MM-dd'
        });

        /** THE CALENDAR **/
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jours'
            },
            events: $allocations,
            editable: true,
            eventLimit: true,
            selectHelper: true,
            eventRender: function (event, element) {
                element.find(".fc-title").remove();
                element.find(".fc-time").remove();
                let eventDetail =
                    moment(event.start).format("HH:mm") + '-'
                    + moment(event.end).format("HH:mm") + '<br/>'
                    + '<strong>' + event.title + '</strong><br/>';

                if (event.semesterName) {
                    eventDetail += '<strong>' + event.semesterName + '</strong><br/>';
                }

                eventDetail += '<i>' + event.teacherName + '</i><br/>'
                    + '<i>' + event.levelName + '</i><br/>'
                    + '<i>' + event.lessonName + '</i><br/>'
                ;
                element.append(eventDetail);
            },
            eventClick: function (calEvent, jsEvent, view) {
                swal.fire({
                    title: '<strong><i>Que voulez-vous réaliser comme action ?</i></strong>',
                    type: 'info',
                    html: '<span class="text-danger">Cliquez sur bouton rouge pour supprimer</span> <b>ET</b> ' +
                        '<span class="text-success">sur le bouton vert pour éditer</span>',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Supprimer',
                    confirmButtonColor: '#d62522',
                    cancelButtonText: 'Editer',
                    cancelButtonColor: '#2b803a',
                    preConfirm: function (e) {
                        let $url = baseUrl + "delete_allocation/" + calEvent.eventId;
                        deleteEvent($url, calEvent)
                    }
                }).then((result) => {
                    if (result.value) {
                        $('#calendar').fullCalendar('removeEvents', calEvent._id);
                        Swal.fire(
                            'Supprimé!',
                            'Affectation enlevée du calendrier.',
                            'success'
                        )
                    } else {
                        calEvent.isReservation = $('#isReservation').val();
                        hydrateEditForm(calEvent);
                    }
                });
            },
            eventDrop: function ($calEvent, delta, revertFunc) {
                let $url = baseUrl + "add_allocation";
                $calEvent.isReservation = $('#isReservation').val();
                addUpdateEvents($url, $calEvent, $calEvent.eventId);
            },
        });

        /** ADD SELECTED COLOR TO THE ADD BUTTON **/
        let defaultColor = '#3c8dbc';

        $('#color').change(function (e) {
            e.preventDefault();
            let color = $(this).val();
            if (!color) {
                color = defaultColor;
            }
            $('#add-new-event').css({'background-color': color, 'border-color': color})
        });

        /** ADD NEW ALLOCATION TO THE CALENDAR **/
        $('#add-new-event').click(function (e) {
            e.preventDefault();

            let resourceId = $('#room').val();
            let resourceName = $('#room option:selected').text();
            let teacherId = $('#teacher').val();
            let teacherName = $('#teacher option:selected').text();
            let levelId = $('#level').val();
            let levelName = $('#level option:selected').text();
            let lessonId = $('#lesson').val();
            let lessonName = $('#lesson option:selected').text();
            let semesterId = $('#semester').val();
            let semesterName = $('#semester option:selected').text();
            let eventId = $('#eventId').val();
            let dayOfTheWeekNumber = parseInt($('#day').val());
            let isReservation = $('#isReservation').val();
            let hourStart = null;
            let hourEnd = null;
            let $dates = [];
            let saveButton = $(this);

            let $url = baseUrl + "add_allocation";

            if (isReservation ){
                let periodDate = $("#periodDate").val();
                hourStart = $("#startPeriod").val() ? $('#startPeriod').val().split(':') : [];
                hourEnd = $("#endPeriod").val() ? $('#endPeriod').val().split(':') : [];

                if (resourceId == 0 || teacherId == 0 || levelId == 0
                    || lessonId == 0 || hourStart.length < 1 || hourEnd.length < 1
                ) {
                    fireDialog('error', 'Erreur', 'Tous les champs sont obligatoires');
                    return
                }

                $dates.push(new Date(periodDate));

            } else {
                let dateStart = $('#dateStart').val();
                let dateEnd = $('#dateEnd').val();
                hourStart = $('#start').val() ? $('#start').val().split(':') : [];
                hourEnd = $('#end').val() ? $('#end').val().split(':') : [];

                if (resourceId == 0 || teacherId == 0 || levelId == 0
                    || lessonId == 0 || hourStart.length < 1 || hourEnd.length < 1
                    || !dayOfTheWeekNumber || !semesterId
                ) {
                    fireDialog('error', 'Erreur', 'Tous les champs sont obligatoires');
                    return
                }

                $dates = getDaysBetweenDates(new Date(dateStart), new Date(dateEnd), dayOfTheWeekNumber);
            }

            $.each($dates, function ($key, $date) {
                let originalEventObject = {};

                let $rowStart = new Date($date.setHours(hourStart[0], hourStart[1]));
                let $rowEnd = new Date($date.setHours(hourEnd[0], hourEnd[1]));

                originalEventObject.rowStart = moment($rowStart).format('YYYY-MM-DD HH:mm');
                originalEventObject.rowEnd = moment($rowEnd).format('YYYY-MM-DD HH:mm');
                originalEventObject.start = $rowStart;
                originalEventObject.end = $rowEnd;
                originalEventObject.title = resourceName.trim();
                originalEventObject.resourceId = resourceId;
                originalEventObject.allDay = false;
                originalEventObject.backgroundColor = saveButton.css('background-color');
                originalEventObject.borderColor = saveButton.css('border-color');
                originalEventObject.levelName = levelName.trim();
                originalEventObject.levelId = levelId;
                originalEventObject.teacherName = teacherName.trim();
                originalEventObject.teacherId = teacherId;
                originalEventObject.lessonName = lessonName.trim();
                originalEventObject.lessonId = lessonId;
                originalEventObject.eventId = eventId;
                originalEventObject.semesterName = semesterName;
                originalEventObject.semesterId = semesterId;
                originalEventObject.isReservation = isReservation;

                addUpdateEvents($url, originalEventObject, eventId);

                /** IN THE EDITION, WE ONLY UPDATE THE SELECTED EVENT **/
                if (eventId) {
                    return false;
                }
            });

        });

        /**
         * LOAD THE CALENDAR WE WANT TO SEE WHEN CHOOSING STUDY LEVEL AT THE TOP OF THE PAGE and
         * ACTIVATES SOME FIELDS NEEDED TO CREATE EVENTS
         */
        if ($levelId) {
            activateLessonsField($levelId);
        }

        $("#level").change(function () {
            let $level = $(this).val();
            activateLessonsField($level);
        });

        /**
         * WE SEEK FOR SEMESTER PERIODS (START and END)
         */
        $("#semester").change(function () {
            let $semester = $(this).val();

            if (parseInt($semester) === 0) {
                showHideFields(['.day', '.dates', '.room'], 0);
                return;
            }

            let $url = baseUrl + 'data_semester/' + $semester;

            $.ajax({
                url: $url,
                method: "POST",
                dataType: 'json'
            })
                .done(function (data) {
                    $('#dateStart').val(data.json.start);
                    $('#dateEnd').val(data.json.end);

                    buildSelectOptions(
                        getUrl('days_of_week'),
                        $('#day'),
                        ['.day']
                    );
                })
                .fail(function (xhr) {
                    fireDialog('info', 'Information', xhr.responseText);
                });
        });

        $("#lesson").change(function () {
            let $lesson = $(this).val();
            let $classes = parseInt($lesson) !== 0 ? ['.teacher', '.semester'] : ['.teacher', '.semester', '.room', '.day', '.dates', '.submitBtn'];

            buildSelectOptions(
                getUrl('load_user_ajax', $lesson),
                $('#teacher'),
                $classes,
                $lesson
            );

            buildSelectOptions(
                getUrl('data_semesters'),
                $('#semester'),
                ['.semester']
            );
        });

        $("#day").change(function () {
            let $day = parseInt($(this).val());
            if ($day !== 0) {
                $(".dates").removeClass('hiddenField');
                return;
            }
            $(".dates").addClass('hiddenField');
            showHideFields(['.dates', '.room', '.submitBtn'], 0);
        });

        $("#end, #start").focusout(function () {
            checkHours(false);
            getAvailableRooms(false);
        });

        $("#endPeriod, #startPeriod").focusout(function () {
            checkHours(true);
            getAvailableRooms(true);
        });
    });

    /**
     * CHECKS IF WE CAN GET ROOMS
     */
    function getRoomRequestParameters(isReservation) {

        let params = {};

        if (isReservation) {
            params.dateStart = $("#periodDate").val();
            params.hourStart = $("#startPeriod").val() ? $('#startPeriod').val().split(':') : [];
            params.hourEnd = $("#endPeriod").val() ? $('#endPeriod').val().split(':') : [];
            params.isReservation = 1;

            if (params.hourEnd.length && params.hourStart.length && params.dateStart) {
                return params;
            }
        } else {
            params.dateStart = $('#dateStart').val();
            params.dateEnd = $('#dateEnd').val();
            params.dayOfTheWeekNumber = parseInt($('#day').val());
            params.semesterId = parseInt($('#semester').val());
            params.hourStart = $('#start').val() ? $('#start').val().split(':') : [];
            params.hourEnd = $('#end').val() ? $('#end').val().split(':') : [];

            if (params.hourStart.length && params.hourEnd.length && params.semesterId !== 0 && params.dayOfTheWeekNumber !== 0 && params.dateStart && params.dateEnd) {
                return params;
            }
        }

        return {};
    }

    /**
     * CHECKS IF START < END
     */
    function checkHours(isReservation) {

        let $start = '';
        let $end = '';

        if (isReservation) {
            $start = $('#startPeriod');
            $end = $('#endPeriod');
        } else {
            $start = $('#start');
            $end = $('#end');
        }

        let hourStart = $start.val() ? $start.val().split(':') : [];
        let hourEnd = $end.val() ? $end.val().split(':') : [];

        if (!hourStart.length || !hourEnd.length) {
            return;
        }

        if (hourEnd[0] < hourStart[0]) {
            $start.val(hourEnd[0] + ':' + hourEnd[1]);
            $end.val(hourStart[0] + ':' + hourStart[1]);
        }
    }

    /**
     * GETS ALL AVAILABLE ROOMS WITHIN A PERIOD and BUILD CLASS SELECT
     * IF and ONLY IF, ALL PARAMETERS ARE CORRECTLY SET
     * IN EDIT, NO AVAILABLE ROOMS ARE FETCHED
     */
    function getAvailableRooms(isReservation) {

        let eventId = $('#eventId').val();

        if (eventId) {
            return;
        }

        let $params = getRoomRequestParameters(isReservation);

        if ($.isEmptyObject($params)) {
            return;
        }

        let $url = baseUrl + 'check_resource';
        let postDates = [];

        if (isReservation) {
            let theDate = new Date($params.dateStart);
            let dateStart = theDate.setHours($params.hourStart[0], $params.hourStart[1]);
            let dateEnd = theDate.setHours($params.hourEnd[0], $params.hourEnd[1]);
            postDates.push({
                'start': moment(dateStart).format('YYYY-MM-DD HH:mm'),
                'end': moment(dateEnd).format('YYYY-MM-DD HH:mm')
            });
        } else {

            let $dates = getDaysBetweenDates(new Date($params.dateStart), new Date($params.dateEnd), $params.dayOfTheWeekNumber);

            $.each($dates, function ($key, $date) {
                let $rowStart = new Date($date.setHours($params.hourStart[0], $params.hourStart[1]));
                let $rowEnd = new Date($date.setHours($params.hourEnd[0], $params.hourEnd[1]));
                postDates.push({
                    'start': moment($rowStart).format('YYYY-MM-DD HH:mm'),
                    'end': moment($rowEnd).format('YYYY-MM-DD HH:mm')
                });
            });
        }

        let $data = {
            dates: postDates,
            semester: $params.semesterId,
            isReservation: isReservation
        };

        buildSelectOptions($url, $("#room"), ['.submitBtn', '.room'], 1, $data);
    }

    /** ADD NEW ALLOCATION TO THE CALENDAR AND SAVE IT TO THE DATABASE **/
    function addUpdateEvents($url, $calEvent, $isEdit) {

        /**
         * Date needs to be stringify in order to be sent to the database
         * $calEvent.rowStart => date come from add form
         * $calEvent.start => date come from event drop = update
         */
        let start = $calEvent.rowStart ? $calEvent.rowStart : $calEvent.start.format('YYYY-MM-DD HH:mm');
        let end = $calEvent.rowEnd ? $calEvent.rowEnd : $calEvent.end.format('YYYY-MM-DD HH:mm');

        $.ajax({
            url: $url,
            method: "POST",
            dataType: 'json',
            data: {
                eventId: $calEvent.eventId,
                resource: $calEvent.resourceId,
                start: start,
                end: end,
                allDay: $calEvent.allDay,
                backgroundColor: $calEvent.backgroundColor,
                borderColor: $calEvent.borderColor,
                level: $calEvent.levelId,
                lesson: $calEvent.lessonId,
                teacher: $calEvent.teacherId,
                semester: $calEvent.semesterId,
                isReservation: $calEvent.isReservation
            }
        })
            .done(function (data) {

                if (data.eventId) {
                    fireDialog('success', 'Success', data.result);
                }

                $calEvent.eventId = data.eventId;

                /**
                 * Date needs to be a Moment date in order to be added the the calendar
                 */
                $calEvent.start = new Date(start);
                $calEvent.end = new Date(end);

                $('#calendar').fullCalendar($isEdit ? 'updateEvent' : 'renderEvent', $calEvent, true);
            })
            .fail(function (xhr) {
                fireDialog('error', 'Erreur', xhr.responseText);
            });
    }

    /** DELETE ALLOCATION FROM THE CALENDAR AND FROM THE DATABASE **/
    function deleteEvent($url, $calEvent) {
        $.ajax({
            url: $url,
            method: "POST",
            dataType: 'json',
            data: {
                event: $calEvent.eventId
            }
        });
    }

    /**
     * Clear all the hidden select and hides the divs that contain them => if option is null
     * Show all fields => if option is not null
     * @param $classes
     * @param $value
     * @param $dataFound
     */
    function showHideFields($classes, $value = null, $dataFound = null) {
        if ($classes && ($value == 0 || !$dataFound)) {
            $.each($classes, function (index, $class) {
                $($class).each(function () {
                    $(this).addClass('hiddenField');
                    $(this).find('select').empty();
                });
            });
            $(".dates").find('input').val('');
            return;
        }

        $.each($classes, function (index, $class) {
            $($class).each(function () {
                $(this).removeClass('hiddenField');
            });
        });
    }

    /**
     * Build and return the url used to get data
     * @param $id
     * @param $uri
     * @returns {string}
     */
    function getUrl($uri, $id) {
        if ($id) {
            return baseUrl + $uri + '/' + $id;
        }
        return baseUrl + $uri;
    }

    /**
     *
     * @param $url
     * @param $select
     * @param $classes
     * @param $selectedValue
     * @param $data
     */
    function buildSelectOptions($url, $select, $classes, $selectedValue = null, $data = null) {

        $.ajax({
            url: $url,
            method: "POST",
            dataType: 'json',
            data: $data
        })
            .done(function (data) {

                $select.empty();

                if (data.placeholder) {
                    $select.append('<option value="0">' + data.placeholder + '</option>');
                }

                showHideFields($classes, $selectedValue, data.json);

                if (data.json) {
                    $.each(data.json, function (index, table) {
                        $select.append($("<option></option>").attr("value", table.id).text(table.name));
                    });
                }
            })
            .fail(function (xhr) {
                // Error dialog shows only if no data found and user have selected a value
                if ($selectedValue != 0) {
                    fireDialog('error', 'Information', xhr.responseText);
                }

                showHideFields($classes, $selectedValue, false);
            });
    }

    /**
     * POPS UP A DIALOG
     */
    function fireDialog($type, $title, $msg) {
        let isError = $type === 'error';
        let $class = isError ? 'text-danger' : 'text-success';
        Swal.fire({
            type: $type,
            title: $title,
            html: '<h4 class="'+$class+' text-center">' + $msg + '</h4>',
        }).then((result) => {
            if (result.value && !isError) {
               location.reload()
            }
        });
    }

    function activateLessonsField($level) {

        let $classes = parseInt($level) !== 0 ? ['.lesson'] : ['.lesson', '.teacher', '.semester', '.room', '.day', '.dates', '.submitBtn'];

        buildSelectOptions(
            getUrl('load_lesson_ajax', $level),
            $('#lesson'),
            $classes,
            $level
        );
    }

    /**
     * REBUILDS THE FORM WHEN EDITING ALLOCATION
     */
    function hydrateEditForm($calEvent) {

        let $data = {
            level: $calEvent.levelId,
            lesson: $calEvent.lessonId,
            event: $calEvent.eventId,
            isReservation: $calEvent.isReservation,
        };

        $.ajax({
            url: baseUrl + 'edit_allocation',
            method: "POST",
            dataType: 'json',
            data: $data
        })
            .done(function (data) {

                let $teacher = $("#teacher");
                let $data = data.result;
                let $dayOfTheWeekDigit = (new Date($data.event.start)).getDay();
                let $hourStart = moment($data.event.start).format('H:mm');
                let $hourEnd = moment($data.event.end).format('H:mm');
                let $dateStart = $calEvent.start.format('YYYY-MM-DD HH:mm');
                let $dateEnd = $calEvent.end.format('YYYY-MM-DD HH:mm');

                buildEditFormOptions($("#level"), $data.levels, $calEvent.levelId, 'Sélectionnez le niveau d\'études');

                buildEditFormOptions($("#lesson"), $data.lessons, $calEvent.lessonId, 'Sélectionnez l\'unité d\'enseignement');

                if ($calEvent.isReservation) {
                    $("#periodDate").val($calEvent.start.format('YYYY-MM-DD'));
                    $("#startPeriod").val($hourStart);
                    $("#endPeriod").val($hourEnd);
                    $('#isReservation').val(1);
                } else {
                    buildEditFormOptions($("#day"), $data.daysOfTheWeek, $dayOfTheWeekDigit, 'Choisir le jour');

                    $("#start").val($hourStart);
                    $("#end").val($hourEnd);
                    $('#dateStart').val($dateStart);
                    $('#dateEnd').val($dateEnd);
                    $('#add-new-event').css({
                        'background-color': $calEvent.backgroundColor,
                        'border-color': $calEvent.borderColor
                    });

                    buildEditFormOptions($("#semester"), $data.semesters, $calEvent.semesterId, 'Choisir le semestre');
                }

                $("#eventId").val($calEvent.eventId);

                $teacher.empty();
                if ($calEvent.teacherId === $data.teacher.id) {
                    $teacher.append($("<option></option>").attr({
                        "value": $data.teacher.id,
                        'selected': true
                    }).text($data.teacher.name));
                } else {
                    $teacher.append($("<option></option>").attr("value", $data.teacher.id).text($data.teacher.name));
                }

                buildEditFormOptions($("#room"), $data.rooms, $calEvent.roomId, 'Sélectionnez la salle');

                $.each(['.teacher', '.dates', '.submitBtn', '.room', '.lesson', '.day', '.semester'], function (index, $class) {
                    $($class).removeClass('hiddenField');
                });

            });
    }

    /**
     * Builds form options of the resources allocation on edit mode
     * @param $select
     * @param $data
     * @param $idToFind
     * @param $placeholder
     */
    function buildEditFormOptions($select, $data, $idToFind, $placeholder) {
        $select.empty();
        $select.append('<option value="0">' + $placeholder + '</option>');
        $.each($data, function (index, $object) {
            if ($idToFind === $object.id) {
                $select.append($("<option></option>").attr({"value": $object.id, 'selected': true}).text($object.name));
            } else {
                $select.append($("<option></option>").attr("value", $object.id).text($object.name));
            }
        });
    }


    /** Given a start date, end date and day name, return
     ** an array of dates between the two dates for the
     ** given day inclusive
     ** @param {Date} start - date to start from
     ** @param {Date} end - date to end on
     ** @param {number} dayNumber - number of day
     * @returns {Array} array of Dates
     */
    function getDaysBetweenDates(start, end, dayNumber) {
        var result = [];
        var day = parseInt(dayNumber);
        // Copy start date
        var current = new Date(start);
        // Shift to next of required days
        current.setDate(current.getDate() + (day - current.getDay() + 7) % 7);
        // While less than end date, add dates to result array
        while (current < end) {
            result.push(new Date(+current));
            current.setDate(current.getDate() + 7);
        }
        return result;
    }
</script>