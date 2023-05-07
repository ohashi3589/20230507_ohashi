<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <title>お問い合わせ</title>
  <style>
  </style>
</head>

<body>
  <h1>お問い合わせ</h1>
  <form method="POST" action="{{ route('info.confirm') }}">
    @csrf

    <div>
      <label for="last_name"><span class="bold">お名前</span><span class="red">&nbsp;※</span></label>
      <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
      <input type="text" id="first_name" name="first_name" style="margin-left: 20px;" value="{{ old('first_name') }}" required>
      <span class="name1-example">例) 山田</span>
      <span class="name2-example">例) 太郎</span>
    </div>

    <div>
      <label><span class="bold">性別</span><span class="red">&nbsp;※</span></label>
      <label for="gender_male"><input type="radio" id="gender_male" name="gender" value="male" required {{ old('gender') == 'male' ? 'checked' : '' }}>男性</label>
      <label for="gender_female"><input type="radio" id="gender_female" name="gender" value="female" required {{ old('gender') == 'female' ? 'checked' : '' }}>女性</label>
    </div>

    <div>
      <label for="email"><span class="bold">メールアドレス</span><span class="red">&nbsp;※</span></label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required>
      <span class="email-example">例) test@example.com</span>
    </div>

    <div>
      <label for="postcode"><span class="bold">郵便番号</span><span class="red">&nbsp;※</span></label>
      〒<input type="text" id="postcode" name="postcode" pattern="\d{3}-\d{4}" style="margin-left: 15px;" value="{{ old('postcode') }}" required>
      <span class="postcode-example">例) 123-4567</span>
    </div>

    <div>
      <label for="address"><span class="bold">住所</span><span class="red">&nbsp;※</span></label>
      <input type="text" id="address" name="address" value="{{ old('address') }}" required>
      <span class="address-example">例) 東京都渋谷区神南1-2-3</span>
    </div>

    <div>
      <label for="building_name"><span class="bold">建物名</span></label>
      <input type="text" id="building_name" name="building_name" value="{{ old('building_name') }}">
      <span class="building_name-example">例) タワーマンション101号室</span>
    </div>
    @if($errors->has('building_name'))
    <div class="error">{{ $errors->first('building_name') }}</div>
    @endif
    @if(!empty($building_name))
    <div>
      <span>{{ $building_name }}</span>
    </div>
    @endif

    <div>
      <label for="opinion"><span class="bold">ご意見</span><span class="red">&nbsp;※</span></label>
      <textarea id="opinion" name="opinion" rows="10" cols="50" maxlength="120">{{ old('opinion') }}</textarea>
    </div>
    <button type="submit" class="btn" onclick="return validateForm()">確認</button>

    <script>
      function validateForm() {
        var opinion = document.getElementById("opinion").value;
        if (opinion == "") {
          alert("意見を入力してください");
          return false;
        }
      }
      
      const postCodeInput = document.getElementById('postcode');
      const addressInput = document.getElementById('address');

      postCodeInput.addEventListener('blur', async () => {
        const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postCodeInput.value.replace('-', '')}`);
        const result = await response.json();
        if (result.status === 200) {
          const address = result.results[0].address1 + result.results[0].address2 + result.results[0].address3;
          addressInput.value = address;
        }
      });
    </script>
  </form>
  </div>
</body>

</html>