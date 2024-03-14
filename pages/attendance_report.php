<div class="page-title mb-3">Отчёт о посещаемости</div>
<hr>
<?php 
// $studentList = $actionClass->list_student();
$classList = $actionClass->list_class();
$class_id = $_GET['class_id'] ?? "";
$class_month = $_GET['class_month'] ?? "";
$studentList = $actionClass->attendanceStudentsMonthly($class_id, $class_month);
$monthLastDay = 0;
if(!empty($class_month)){
    $monthLastDay = date("d", strtotime("{$class_month}-1 -1 day -1 month")) ;
}
// echo $monthLastDay;
?>
<form action="" id="manage-attendance">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div id="msg"></div>
            <div class="card shadow mb-3">
                <div class="card-body rounded-0">
                    <div class="container-fluid">
                        <div class="row align-items-end">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="class_id" class="form-label">Класс</label>
                                <select name="class_id" id="class_id" class="form-select" required="required">
                                    <option value="" disabled <?= empty($class_id) ? "selected" : "" ?>> -- Выберите здесь -- </option>
                                    <?php if(!empty($classList) && is_array($classList)): ?>
                                    <?php foreach($classList as $row): ?>
                                        <option value="<?= $row['id'] ?>" <?= (isset($class_id) && $class_id == $row['id']) ? "selected" : "" ?>><?= $row['name'] ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="class_month" class="form-label">Дата</label>
                                <input type="month" name="class_month" id="class_month" class="form-control" value="<?= $class_month ?? '' ?>" required="required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($class_id) && !empty($class_month)): ?>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="container-fluid">
                        <fieldset>
                            <legend class="h6"><strong>Легенда:</strong></legend>
                            <div class="ps-4">
                                <div><span class="text-success fw-bold">НУ</span> <span class="ms-1">= На уроке</span></div>
                                <div><span class="text-body-emphasis fw-bold">О</span> <span class="ms-1">= Опоздал</span></div>
                                <div><span class="text-danger fw-bold">НБ</span> <span class="ms-1">= Не было</span></div>
                                <div><span class="text-primary fw-bold">П</span> <span class="ms-1">= Праздник</span></div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="px-2 py-2 text-center bg-primary text-light fw-bolder"><?= date("F", strtotime($class_month)) ?></div>
                        <div class="table-responsive position-relative">
                            <table id="attendance-rpt-tbl" class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary bg-opacity-75">
                                        <th class="text-center bg-primary text-light" style="width:300px !important">Студенты</th>
                                        <?php for($i=1; $i <= $monthLastDay; $i++): ?>
                                            <th class="text-center bg-transparent text-light" style="width:80px !important"><?= $i ?></th>
                                        <?php endfor; ?>
                                        <th class="text-center bg-primary text-light">НУ</th>
                                        <th class="text-center bg-primary text-light">О</th>
                                        <th class="text-center bg-primary text-light">НБ</th>
                                        <th class="text-center bg-primary text-light">П</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($studentList) && is_array($studentList)): ?>
                                    <?php foreach($studentList as $row): ?>
                                        <tr class="student-row">
                                            <td class="px-2 py-1 text-dark-emphasis fw-bold">
                                                <input type="hidden" name="student_id[]" value="<?= $row['id'] ?>">
                                                <?= $row['name'] ?>
                                            </td>
                                            <?php 
                                            $tp = 0;
                                            $tl = 0;
                                            $ta = 0;
                                            $th = 0;
                                            ?>
                                            <?php for($i=1; $i <= $monthLastDay; $i++): ?>
                                                <td class="text-center px-2 py-1 text-dark-emphasis">
                                                    <?php 
                                                        $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                                                        switch(($row['attendance'][$class_month."-".$i] ?? '')){
                                                            case 1:
                                                                echo "<span class='text-success fw-bold'>P</span>";
                                                                $tp += 1;
                                                                break;
                                                            case 2:
                                                                echo "<span class='text-body-emphasis fw-bold'>L</span>";
                                                                $tl += 1;
                                                                break;
                                                            case 3:
                                                                echo "<span class='text-danger fw-bold'>A</span>";
                                                                $ta += 1;
                                                                break;
                                                            case 4:
                                                                echo "<span class='text-primary fw-bold'>H</span>";
                                                                $th += 1;
                                                                break;
                                                        }
                                                    ?>
                                                </td>
                                            <?php endfor; ?>
                                            <th class="text-center bg-secondary text-light"><?= $tp ?></th>
                                            <th class="text-center bg-secondary text-light"><?= $tl ?></th>
                                            <th class="text-center bg-secondary text-light"><?= $ta ?></th>
                                            <th class="text-center bg-secondary text-light"><?= $th ?></th>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="<?= $monthLastDay + 5 ?>" class="px-2 py-1 text-center">В списке пока нет ни одного студента</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#class_id, #class_month').change(function(e){
            var class_id = $('#class_id').val()
            var class_month = $('#class_month').val()
            location.replace(`./?page=attendance_report&class_id=${class_id}&class_month=${class_month}`)
        })
    })
</script>