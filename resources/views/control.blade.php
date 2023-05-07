<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style4.css') }}">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1>管理システム</h1>
    <div class="search-form-container">
      <div class="search-form">
        <form name="searchForm" method="GET" action="{{ route('control') }}">
          <div class="form-group">
            <label for="fullname" class="form-label">お名前</label>
            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ $fullname }}">
          </div>
          <div class="form-group">
            <label for="gender" class="gender-label">性別</label>
            <label class="circle-checkbox">
              <input type="radio" name="gender" value="" {{ $gender === '' ? 'checked' : '' }}>
              <span class="checkmark"></span>
              全て
            </label>
            <label class="circle-checkbox">
              <input type="radio" name="gender" value="1" {{ $gender == 1 ? 'checked' : '' }}>
              <span class="checkmark"></span>
              男性
            </label>
            <label class="circle-checkbox">
              <input type="radio" name="gender" value="2" {{ $gender == 2 ? 'checked' : '' }}>
              <span class="checkmark"></span>
              女性
            </label>
          </div>
          <div class="form-group3">
            <div>
              <label for="created_at_start" class="form-label">登録日</label>
            </div>
            <div>
              <input id="created_at_start" type="date" class="form-control" name="created_at_start" value="" placeholder="　">
            </div>
            <div>
              <span>〜</span>
            </div>
            <div>
              <input id="created_at_end" type="date" class="form-control" name="created_at_end" value="" placeholder="　">
            </div>
          </div>
          <div class="form-group4">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $email }}">
          </div>
          <button type="submit" class="search-button">検索</button>
          <a href="#" onclick="document.forms['searchForm'].reset()" class="reset-link">リセット</a>
          <script>
            const resetButton = document.querySelector('.reset-link');
            const searchForm = document.forms['searchForm'];

            resetButton.addEventListener('click', () => {
              searchForm.reset();
              window.location.href = '/control';
            });
          </script>
      </div>
    </div>
    </form>

  </div>
  <div class="pagination-container">
    <span class="pagination-numbers">全{{ $contacts->total() }}件中 {{ $contacts->firstItem() }}〜{{ $contacts->lastItem() }}件</span>
    <div class="pagination-links">
      @if ($contacts->currentPage() > 1)
      <a href="{{ $contacts->previousPageUrl() }}">&lt;</a>
      @else
      <span class="disabled">&lt;</span>
      @endif

      @for ($i = 1; $i <= $contacts->lastPage(); $i++)
        <a href="{{ $contacts->url($i) }}" class="{{ $i == $contacts->currentPage() ? 'active' : '' }}">{{ $i }}</a>
        @endfor

        @if ($contacts->currentPage() < $contacts->lastPage())
          <a href="{{ $contacts->nextPageUrl() }}">&gt;</a>
          @else
          <span class="disabled">&gt;</span>
          @endif
    </div>

  </div>
  <div class="table-container">
    <table class="table">
      <colgroup>
        <col style="width: auto;">
        <col style="width: auto;">
        <col style="width: auto;">
        <col style="width: 100px;">
        <col style="width: auto;">
      </colgroup>
      <thead>
        <tr>
          <th>ID</th>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>ご意見</th>
        </tr>
      </thead>
      <tbody>
        @if (count($contacts) > 0)
        @foreach ($contacts as $contact)
        <tr>
          <td>{{ $contact->id }}</td>
          <td>{{ $contact->fullname }}</td>
          <td>{{ $contact->gender == 1 ? '男性' : '女性' }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->opinion }}</td>
          <td>
            <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="5">該当するデータがありません。</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  </div>
  </div>
  </div>
</body>

</html>