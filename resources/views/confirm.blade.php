<?php
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$postcode = $_POST['postcode'];
$address = $_POST['address'];
$building_name = $_POST['building_name'];
$opinion = $_POST['opinion'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}">
  <meta charset="UTF-8">
  <title>内容の確認</title>
</head>

<body>
  <h1>内容確認</h1>
  <dl class="input-info">
    <div>
      <dt>お名前</dt>
      <dd><?php echo $last_name . ' ' . $first_name; ?></dd>
    </div>
    <div>
      <dt>性別</dt>
      <dd> <?php
            if ($gender === 'male') {
              echo '男性';
            } else if ($gender === 'female') {
              echo '女性';
            }
            ?></dd>
    </div>
    <div>
      <dt>メールアドレス</dt>
      <dd><?php echo $email; ?></dd>
    </div>
    <div>
      <dt>郵便番号</dt>
      <dd><?php echo $postcode; ?></dd>
    </div>
    <div>
      <dt>住所</dt>
      <dd><?php echo $address; ?></dd>
    </div>
    <div>
      <dt>建物名</dt>
      <dd><?php echo $building_name; ?></dd>
    </div>
    <div class="clearfix">
      <dt class="comment1">ご意見</dt>
      <dd class="comment2"><?php echo $opinion; ?></dd>
    </div>
  </dl>
  <form method="POST" action="{{ route('info.complete') }}">
    @csrf
    <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
    <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="postcode" value="<?php echo $postcode; ?>">
    <input type="hidden" name="address" value="<?php echo $address; ?>">
    <input type="hidden" name="building_name" value="<?php echo $building_name; ?>">
    <input type="hidden" name="opinion" value="<?php echo $opinion; ?>">
    <button type="submit" class="btn-submit">送信</button>
  </form>
  <a href="{{ route('info.index') }}" class="modify-link">修正する</a>
</body>

</html>