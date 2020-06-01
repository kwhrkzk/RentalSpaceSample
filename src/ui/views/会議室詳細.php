<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>会議室詳細画面</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php if (isset($エラーメッセージ, $this)): ?>
  <h1><?= $エラーメッセージ ?></h1>
<?php endif;?>
<div class="d-flex">
  <div class="d-inline-flex flex-column align-items-start">
    <h1>会議室情報</h1>
    <div class="d-inline-flex"><div>会議室名　　: </div><div><?= $会議室->名称 ?></div></div>
    <div class="d-inline-flex"><div>住所　　　　: </div><div><?= $会議室->住所 ?></div></div>
    <div class="d-inline-flex"><div>収容人数　　: </div><div><?= $会議室->人数 ?></div></div>
    <div class="d-inline-flex"><div>貸与可能期間: </div><div><?= $会議室->貸与可能期間一覧文字列カンマ区切り ?></div></div>
    </div>
    <div class="d-inline-flex flex-column align-items-start">
    <div class="container">
      <form action="/space" method="post" accept-charset="UTF-8">
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="datetimepicker1" class="pt-2 pr-2">貸与期間自:日付</label>
              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                <input type="text" name="貸与期間自日付" class="form-control datetimepicker-input" data-target="#datetimepicker1">
                <div class="input-group-prepend" data-target="#datetimepicker1" data-toggle="datetimepicker">
                  <div class="input-group-text">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="datetimepicker2" class="pt-2 pr-2">時間</label>
              <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                <input type="text" name="貸与期間自時間" class="form-control datetimepicker-input" data-target="#datetimepicker2">
                <div class="input-group-prepend" data-target="#datetimepicker2" data-toggle="datetimepicker">
                  <div class="input-group-text">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="datetimepicker3" class="pt-2 pr-2">貸与期間至:日付</label>
              <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                <input type="text" name="貸与期間至日付" class="form-control datetimepicker-input" data-target="#datetimepicker3">
                <div class="input-group-prepend" data-target="#datetimepicker3" data-toggle="datetimepicker">
                  <div class="input-group-text">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="datetimepicker4" class="pt-2 pr-2">時間</label>
              <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input type="text" name="貸与期間至時間" class="form-control datetimepicker-input" data-target="#datetimepicker4">
                <div class="input-group-prepend" data-target="#datetimepicker4" data-toggle="datetimepicker">
                  <div class="input-group-text">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="会議室ID" value="<?= $会議室->ID文字列 ?>" />
        <button type="submit" class="btn btn-primary">予約</button>
        <a href="/list" class="btn btn-secondary">戻る</a>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1, #datetimepicker3').datetimepicker({
            dayViewHeaderFormat: 'YYYY年 M月',
            tooltips: {
                close: '閉じる',
                selectMonth: '月を選択',
                prevMonth: '前月',
                nextMonth: '次月',
                selectYear: '年を選択',
                prevYear: '前年',
                nextYear: '次年',
                selectTime: '時間を選択',
                selectDate: '日付を選択',
                prevDecade: '前期間',
                nextDecade: '次期間',
                selectDecade: '期間を選択',
                prevCentury: '前世紀',
                nextCentury: '次世紀'
            },
            format: 'YYYY年MM月DD日',
            locale: moment.locale('ja', {
                week: { dow: 0 }
            }),
            viewMode: 'days',
            buttons: {
                showClose: true
            },
            daysOfWeekDisabled: [0, 6],
            minDate: moment().format('L'),
        });
        $('#datetimepicker2, #datetimepicker4').datetimepicker({
            tooltips: {
                close: '閉じる',
                pickHour: '時間を取得',
                incrementHour: '時間を増加',
                decrementHour: '時間を減少',
                pickMinute: '分を取得',
                incrementMinute: '分を増加',
                decrementMinute: '分を減少',
                pickSecond: '秒を取得',
                incrementSecond: '秒を増加',
                decrementSecond: '秒を減少',
                togglePeriod: '午前/午後切替',
                selectTime: '時間を選択'
            },
            format: 'HH:00',
            locale: 'ja',
            buttons: {
                showClose: true
            },
            defaultDate: moment().format('YYYY-MM-DD HH:00'),
        });

        <?php if (isset($貸与期間自日付)): ?>
        $("input[name='貸与期間自日付']").val("<?= $貸与期間自日付 ?>");
        <?php endif;?>

        <?php if (isset($貸与期間自時間)): ?>
        $("input[name='貸与期間自時間']").val("<?= $貸与期間自時間 ?>");
        <?php endif;?>

        <?php if (isset($貸与期間至日付)): ?>
        $("input[name='貸与期間至日付']").val("<?= $貸与期間至日付 ?>");
        <?php endif;?>

        <?php if (isset($貸与期間至時間)): ?>
        $("input[name='貸与期間至時間']").val("<?= $貸与期間至時間 ?>");
        <?php endif;?>
    });
</script>
</body>
</html>